<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirationController extends Controller
{
    public function vote($id){
        $aspirasi = Aspiration::findOrFail($id);
        $aspirasi->increment('votes');

        return redirect()->back();
    }

    public function index($kategori = null) {
        if($kategori) {
            $aspirasi = Aspiration::where('category', $kategori)
            ->orderBy('votes', 'desc')->get();
        } else {
            // ambil semyua aspirasi + urutin dri yg paling banya
            $aspirasi = Aspiration::orderBy('votes', 'desc')->get();
        }

        return view('main.activity', compact('aspirasi'));
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

        if(Auth::guard('mahasiswa')->check()) {
            $data['user_id'] = Auth::guard('mahasiswa')->id();
        }

        Aspiration::create($data);

        return redirect()->route('aspiration.create')->with('success', 'Aspirasi berhasil dikirim! Terima kasih 😊');
        
    }

    public function destroy($id) {
        Aspiration::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Aspirasi berhasil dihapus.');
    }

    public function detroyAll() {
        Aspiration::truncate();
        return redirect()->back()->with('success', 'Semua aspirasi berhasil dihapus.');
    }
}
