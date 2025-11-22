@extends('layouts.app')
@section('content')

<title>My Profile</title>
<center>
    @if(Auth::guard('admin')->check())
    <h2>Profile Admin</h2>
    @elseif(Auth::guard('dosen')->check())
    <h2>Profile Dosen</h2>
    @elseif(Auth::guard('mahasiswa')->check())
    <h2>Profile Mahasiswa</h2>
    @endif
</center>

@endsection