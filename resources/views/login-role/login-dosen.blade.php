@extends('layouts.app')
@section('content')

<title>Dosen Login</title>
<h4>Login Sekarang</h4>

@if(session('error'))
<p style="color: red;">{{ session('error') }}</p>
@endif

<form method="POST" action="{{ route('login-dosen') }}">
    @csrf

    <label>NPSN:</label><br>
    <input type="text" name="identifier" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>

</form>

@endsection