@extends('layouts.app')
@section('content')

<div class="max-w-xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Profil Saya</h1>

    {{-- Flash message sukses --}}
    @if(session('success'))
    <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- Error --}}
    @if($errors->any())
    <div class="mb-4 p-3 rounded bg-red-100 text-red-800 text-sm">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Data diri --}}
    <div class="mb-6 space-y-1">
        <p><span class="font-semibold">Role:</span> {{ ucfirst($role) }}</p>

        @if($role === 'mahasiswa')
        <p><span class="font-semibold">NIM:</span> {{ $user->nim ?? '-' }}</p>
        @endif

        <p><span class="font-semibold">Nama:</span> {{ $user->nama ?? $user->name ?? '-' }}</p>
        @if(isset($user->email))
        <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
        @endif
    </div>

    <hr class="my-4">

    {{-- Form ganti password --}}
    <h2 class="text-xl font-semibold mb-3">Ganti Password</h2>

    <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Password Lama</label>
            <input type="password" name="current_password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-300"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Password Baru</label>
            <input type="password" name="password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-300"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-300"
                required>
        </div>

        <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
            Simpan Password
        </button>
    </form>
</div>

@endsection