<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Tampilkan halaman profile
    public function show()
    {
        $user = null;
        $role = null;

        if (Auth::guard('mahasiswa')->check()) {
            $user = Auth::guard('mahasiswa')->user();
            $role = 'mahasiswa';
        } elseif (Auth::guard('dosen')->check()) {
            $user = Auth::guard('dosen')->user();
            $role = 'dosen';
        } elseif (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            $role = 'admin';
        } else {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        return view('main.profile', compact('user', 'role'));
    }

    // Ganti password
    public function updatePassword(Request $request)
    {
        // Cari user & role yg lagi login
        if (Auth::guard('mahasiswa')->check()) {
            $guard = 'mahasiswa';
        } elseif (Auth::guard('dosen')->check()) {
            $guard = 'dosen';
        } elseif (Auth::guard('admin')->check()) {
            $guard = 'admin';
        } else {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        $user = Auth::guard($guard)->user();

        // Validasi input
        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|min:8|confirmed',
        ]);

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.'])->withInput();
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
