@extends('layouts.app')
@section('content')

<title>Activity</title>

<center>
    <h1>Activity Page</h1>
</center>

<div class="filter-box">
    <a href="{{ route('activity') }}">Semua</a>
    <a href="{{ route('activity.filter', 'fasilitas') }}">Fasilitas</a>
    <a href="{{ route('activity.filter', 'curhatan') }}">Curhatan</a>
    <a href="{{ route('activity.filter', 'kampus') }}">Kampus</a>
    <a href="{{ route('activity.filter', 'akademik') }}">Akademik</a>
</div>

<hr>

@foreach ($aspirasi as $index => $asp)

    @if($index === 0)
    <span class="badge">⭐ Paling Populer ⭐</span>
    @endif

    <p><strong>Kategori: </strong> {{ ucfirst($asp->category) }}</p>
    <h3> {{ $asp->title }} </h3>
    <p> {{ $asp->content }} </p>

    <p>
        <strong>Pengirim:</strong>
        @if($asp->is_anonymous)
            Anonim
        @elseif($asp->mahasiswa)
            {{ $asp->mahasiswa->nim }}
        @else
            -
        @endif
    </p>
    
    @if($asp->reply)
        <div class="reply-box" style="margin-top: 10px; padding: 10px; border: 1px solid #ccc; ">
            <strong>Balasan Admin: </strong>
            <p> {{ $asp->reply }} </p>
        </div>
    @endif

    @if(auth()->guard('admin')->check())
        <form action="{{ route('aspiration.destroy', $asp->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Yakin ingin menghapus balasan?')">
                Hapus balasan
            </button>
        </form>

        <a href="{{ route('aspiration.reply.form', $asp->id) }}">
            <button type="button">Balas</button>
        </a>
    @endif

    <p>Votes: {{ $asp->votes }} </p>

    @if(auth()->guard('mahasiswa')->check())
    @php
        $alreadyVoted = isset($votedIds) && in_array($asp->id, $votedIds);
        $alreadyReported = isset($reportedIds) && in_array($asp->id, $reportedIds);
    @endphp

    @if(!$alreadyVoted)
    <form action="{{ route('aspiration.vote', $asp->id) }}" method="POST">
        @csrf
        <button type="submit">Vote</button>
    </form>
        @else
            <p><em>Kamu sudah vote aspirasi ini.</em></p>
        @endif
    
    @if(!$alreadyReported)
        <form action="{{ route('aspiration.report', $asp->id) }}" method="POST">
            @csrf

            <input type="text" name="reason" placeholder="Alasan laporan" style="width: 200px;" required>
            <button type="submit" onclick="return confirm('Laporkan aspirasi ini ke admin?')">
                Report
            </button>
        </form>
    @else 
        <p><em>Aspirasi ini sudah kamu laporkan.</em></p>
        @endif
    @endif

    @if(auth()->guard('admin')->check())
    <form action="{{ route('aspiration.destroy', $asp->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">
            Delete
        </button>
    </form>
    @endif
@endforeach

@if(auth()->guard('admin')->check())
    <form action="{{ route('aspiration.destroyAll') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Hapus SEMUA aspirasi?')">
            Delete All
        </button>
    </form>
@endif

@endsection