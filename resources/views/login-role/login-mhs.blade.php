@extends('layouts.app')
@section('content')

<title>Admin Login</title>
<h4>Login Sekarang</h4>

<form method="POST" action="{{ route('login-mhs') }}">
    @csrf

    <label>NIM:</label><br>
    <input type="text" name="nim" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

</form>

<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
</div>

@endsection