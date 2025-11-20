@extends('layouts.app')
@section('content')

<title>Admin Login</title>
<h4>Login Sekarang</h4>

<form method="POST" action="{{ route('login-adm') }}">
    @csrf

    <label>username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

</form>

<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
</div>

@endsection