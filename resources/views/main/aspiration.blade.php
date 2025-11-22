@extends('layouts.app')
@section('content')

<title>Aspirasi</title>

<center>
    <h1>Kirim Aspirasi</h1>
</center>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(auth()->guard('mahasiswa')->check())
    <form action=" {{ route('aspiration.store') }} " method="POST">
        @csrf

        <label for="category">Kategori Aspirasi</label><br>
        <select name="category" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="fasilitas">Fasilitas</option>
            <option value="curhat">Curhatan</option>
            <option value="kampus">Kampus</option>
            <option value="akademik">Akademik</option>
        </select>
        <br><br>

        <label for="title">Judul</label>
        <input type="text" name="title" value="{{ old('title') }}" required maxlength="150">

        <br><br>

        <label for="content">Isi Aspirasi</label><br>
        <textarea name="content" rows="6" required maxlength="2000">{{ old('content') }}</textarea>

        <br><br>

        <button type="submit">Kirim Aspirasi</button>
    </form>
@endif

<hr>


@endsection