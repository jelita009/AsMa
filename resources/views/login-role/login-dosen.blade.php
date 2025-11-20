@extends('layouts.app')
@section('content')

<title>Dosen Login</title>
<h4>Login Sekarang</h4>

<form method="POST" action="{{ route('login-dosen') }}">
    @csrf

    <label>NPSN:</label><br>
    <input type="text" name="npsn" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

</form>

<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
</div>

@endsection