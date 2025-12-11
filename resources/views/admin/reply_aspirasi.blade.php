@extends('layouts.app')
@section('content')

<title>Reply Page - Admin</title>

<h1>Balas Aspirasi</h1>

    <h3> {{ $aspirasi->title}} </h3>
    <p><strong> Kategori: </strong> {{ ucfirst($aspirasi->category) }} </p>
    <p> {{ $aspirasi->content }} </p>

    <hr>

    <form action="{{ route('aspiration.reply.store', $aspirasi->id) }}" method="POST">
        @csrf
        <label for="reply">Balasan Admin:</label><br>
        <textarea name="reply" rows="6" required maxlength="2000">{{ old('reply', $aspirasi->reply) }}</textarea>

        <br><br>

        <button type="submit">Kirim balasan</button>
        
    </form>
@endsection