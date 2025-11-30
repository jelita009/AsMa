<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    // Homepage: catat kunjungan
    public function home()
    {
        Visit::create([
            'path' => request()->path(), // biasanya '/'
        ]);

        return view('main.home');
    }

    // Halaman grafik
    public function graphic()
    {
        // Per hari (7 hari terakhir)
        $daily = Visit::selectRaw('DATE(created_at) as label, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('label')
            ->orderBy('label')
            ->get();

        // Per minggu (8 minggu terakhir) — pake YEARWEEK (MySQL)
        $weekly = Visit::selectRaw('YEARWEEK(created_at, 1) as week_key, COUNT(*) as total')
            ->where('created_at', '>=', now()->subWeeks(7)->startOfWeek())
            ->groupBy('week_key')
            ->orderBy('week_key')
            ->get();

        // Per bulan (12 bulan terakhir)
        $monthly = Visit::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('label')
            ->orderBy('label')
            ->get();

        // Per tahun (semua data)
        $yearly = Visit::selectRaw('YEAR(created_at) as label, COUNT(*) as total')
            ->groupBy('label')
            ->orderBy('label')
            ->get();

        return view('main.graphic', compact('daily', 'weekly', 'monthly', 'yearly'));
    }
}
