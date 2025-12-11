@extends('layouts.app')
@section('content')

<title>Selection Page</title>

<p>Choose your role:</p>
<ul>
    <li><a href="{{ route('login-adm') }}">Admin</a><br></li>
    <li><a href="{{ route('login-mhs') }}">Mahasiswa</a><br></li>
    <li><a href="{{ route('login-dosen') }}">Dosen</a><br></li>
</ul>

@endsection