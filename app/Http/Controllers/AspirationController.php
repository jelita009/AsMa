<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AspirationVote;
use App\Models\Admin;
use App\Models\AspirationReport;

class AspirationController extends Controller
{
    public function vote($id){
        $aspirasi = Aspiration::findOrFail($id);
        
        $mahasiswa = Auth::guard('mahasiswa')->user();
        if (!$mahasiswa) {
            abort(403, 'Hanya mahasiswa yang bisa vote.');
        }

        // Cek vote nyah perna atau blomm
        $vote = AspirationVote::firstOrCreate([
            'aspiration_id' => $aspirasi->id,
            'mahasiswa_id' => $mahasiswa->id,
        ]);

        // kalo pertama, tambahin votenya
        if ($vote->wasRecentlyCreated) {
            $aspirasi->increment('votes');
            return redirect()->back()->with('success', 'Berhasil vote, arigato!');
        }
        return redirect()->back()->with('error', 'Cuma bisa sekali vote loh ya!');
    }

    public function index($kategori = null) {
        if($kategori) {
            $aspirasi = Aspiration::where('category', $kategori)
            ->orderBy('votes', 'desc')
            ->get();
        } else {
            // ambil semyua aspirasi + urutin dri yg paling banya
            $aspirasi = Aspiration::orderBy('votes', 'desc')->get();
        }

        $voteIds = [];
        $reportedIds = [];

        if (Auth::guard('mahasiswa')->check()) {
            $mahasiswaId = Auth::guard('mahasiswa')->id();

            $voteIds = AspirationVote::where('mahasiswa_id', $mahasiswaId)
                ->pluck('aspiration_id')
                ->toArray();

            $reportedIds = AspirationReport::where('mahasiswa_id', $mahasiswaId)
                ->pluck('aspiration_id')
                ->toArray();
        }

        return view('main.activity', compact('aspirasi', 'voteIds', 'reportedIds'));
    }

    public function create() {
        return view('main.aspiration');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string|max:2000',
            'category' => 'required|string|in:fasilitas,curhatan,kampus,akademik',
        ]);

        $data['is_anonymous'] = $request->has('is_anonymous');
        
        if(Auth::guard('mahasiswa')->check()) {
            $data['user_id'] = Auth::guard('mahasiswa')->id();
            $data['role'] = 'mahasiswa';
        }

        Aspiration::create($data);

        return redirect()->route('aspiration.create')->with('success', 'Aspirasi berhasil dikirim! Terima kasih 😊');
        
    }

    public function destroy($id) {
        Aspiration::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Aspirasi berhasil dihapus.');
    }

    public function destroyAll() {
        Aspiration::truncate();
        return redirect()->back()->with('success', 'Semua aspirasi berhasil dihapus.');
    }

    public function showReplyForm($id) {
        $aspirasi = Aspiration::findOrFail($id);
        return view('admin.reply_aspirasi', compact('aspirasi'));
    }

    public function storeReply(Request $request, $id) {
        $aspirasi = Aspiration::findOrFail($id);

        $data = $request->validate([
            'reply' => 'required|string|max:5000',
        ]);

        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            abort(403, 'Hanya admin yang dapat membalas aspirasi.');
        }
        $aspirasi->reply = $data['reply'];
        $aspirasi->replied_by_admin_id = $admin->id;
        $aspirasi->save();

        return redirect()->route('admin.index')
        ->with('success', 'Balasan tersimpan.');
    }

    public function adminIndex() {
        $aspirasi = Aspiration::with('mahasiswa')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.index', compact('aspirasi'));
    }

    public function report($id, Request $request) {
        $aspirasi = Aspiration::findOrFail($id);

        $mahasiswa = Auth::guard('mahasiswa')->user();
        if (!$mahasiswa) {
            abort(403, 'Hanya mahasiswa yang dapat melaporkan.');
        }

        $data = $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $report = AspirationReport::firstOrCreate([
                'aspiration_id' => $aspirasi->id,
                'mahasiswa_id' => $mahasiswa->id,
            ],
            [
                'reason' => $data['reason'],
            ]
        );

        if ($report->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Aspirasi berhasil dilaporkan!');
        }

        return redirect()->back()->with('error', 'Kamu sudah melaporkan aspirasi ini.');
    }

    public function adminReports() {
        $reports = AspirationReport::with(['aspiration', 'mahasiswa'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reports', compact('reports'));
    }
}
