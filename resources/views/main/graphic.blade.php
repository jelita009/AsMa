@extends('layouts.app')
@section('content')

<title>Visitors</title>

<div class="max-w-5xl mx-auto mt-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Statistik Pengunjung</h1>

    <p class="mb-6 text-sm text-gray-600">
        Grafik ini menampilkan jumlah kunjungan ke website berdasarkan data yang tersimpan.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Daily nie -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="font-semibold mb-2">Perh Hari (7 Hari terakhir)</h2>
            <canvas id="chartDaily" height="150"></canvas>
        </div>

        <!-- Weekly nie -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="font-semibold mb-2"></h2>
            <canvas id="chartWeekly" height="150"></canvas>
        </div>

        <!-- Monthly nie -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="font-semibold mb-2">Per Bulan</h2>
            <canvas id="chartMonthly" height="150"></canvas>
        </div>

        <!-- Yearly nie -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="font-semibold mb-2">Per Tahun</h2>
            <canvas id="chartYearly" height="150"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dailyLabels = @json($daily->pluck('label'));
    const dailyData = @json($daily->pluck('total'));

    const weeklyLabels = @json($weekly->pluck('week_key'));
    const weeklyData = @json($weekly->pluck('total'));

    const monthlyLabels = @json($monthly->pluck('label'));
    const monthlyData = @json($monthly->pluck('total'));

    const yearlyLabels = @json($yearly->pluck('label'));
    const yearlyData = @json($yearly->pluck('total'));

    function makeChart(ctxId, labels, data, label) {
        const ctx = document.getElementById(ctxId);
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                }]
            },
            options: {
                scales: {
                    y: {beginAtZero: true}
                }
            }
        });
    }

    makeChart('chartDaily', dailyLabels, dailyData, 'Kunjungan / Hari');
    makeChart('chartWeekly', weeklyLabels, weeklyData, 'Kunjungan / Minggu');
    makeChart('chartMonthly', monthlyLabels, monthlyData, 'Kunjungan / Bulan');
    makeChart('chartYearly', yearlyLabels, yearlyData, 'Kunjungan / Tahun');
</script>

@endsection