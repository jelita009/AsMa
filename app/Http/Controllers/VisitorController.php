<?php

namespace App\Http\Controllers;

use App\Models\Visit;

class VisitorController extends Controller
{
    public function home()
    {
        Visit::create([
            'path' => request()->path(), 
        ]);

        return view('main.home');
    }

    public function graphic()
    {
        $daily = Visit::selectRaw('DATE(created_at) as label, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('label')
            ->orderBy('label')
            ->get();

        $weekly = Visit::selectRaw('YEARWEEK(created_at, 1) as week_key, COUNT(*) as total')
            ->where('created_at', '>=', now()->subWeeks(7)->startOfWeek())
            ->groupBy('week_key')
            ->orderBy('week_key')
            ->get();

        $monthly = Visit::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('label')
            ->orderBy('label')
            ->get();

        $yearly = Visit::selectRaw('YEAR(created_at) as label, COUNT(*) as total')
            ->groupBy('label')
            ->orderBy('label')
            ->get();

        return view('main.graphic', compact('daily', 'weekly', 'monthly', 'yearly'));
    }
}
