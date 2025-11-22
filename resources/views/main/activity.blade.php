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
<div class="box-aspirasi">

    @if($index === 0)
    <span class="badge">⭐ Paling Populer ⭐</span>
    @endif

    <p><strong>Kategori: </strong> {{ ucfirst($asp->category) }}</p>
    <h3> {{ $asp->title }} </h3>
    <p> {{ $asp->content }} </p>

    <p>Votes: {{ $asp->votes }} </p>

    @if(auth()->guard('mahasiswa')->check())
    <form action="{{ route('aspiration.vote', $asp->id) }}" method="POST">
        @csrf
        <button type="submit">Vote</button>
    </form>
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
</div>
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