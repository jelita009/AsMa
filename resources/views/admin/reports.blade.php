@extends('layouts.app')
@section('content')

<title>Reports Page</title>

<h1>Daftar Laporan</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Aspirasi</th>
            <th>Kategori</th>
            <th>Pengirim Aspirasi</th>
            <th>Pelapor</th>
            <th>Alasan</th>
            <th>Waktu Laporan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($reports as $index => $report)
        <tr>
            <td> {{ $index + 1 }} </td>
            <td> {{ $report->aspiration->title ?? '-' }} </td>
            <td> {{ isset($report->aspiration) ? ucfirst($report->aspiration->category) : '-'}} </td>
            <td>
                @if($report->aspiration && $report->aspiration->mahasiswa)
                NIM: {{ $report->aspiration->mahasiswa->nim }}
                @else
                -
                @endif
            </td>
            <td>
                @if($report->mahasiswa)
                NIM: {{ $report->mahasiswa->nim }}
                @else
                -
                @endif
            </td>
            <td> {{ $report->reason ?? '-' }} </td>
            <td> {{ $report->created_at->format('d M Y, H:i') }} </td>
        </tr>
    @empty
        <tr>
            <td colspan="7">Belum ada laporan.</td>
        </tr>
    @endforelse
    </tbody>
</table>

@endsection