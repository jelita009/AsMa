<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function login(Request $request)
    {
        $id = $request->identifier;
        $password = $request->password;

        // Admin
        $admin = Admin::where('username', $id)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('home');
        }

        // Dosen
        $dosen = Dosen::where('npsn', $id)->first();
        if ($dosen && Hash::check($password, $dosen->password)) {
            Auth::guard('dosen')->login($dosen);
            return redirect()->route('home');
        }

        // Mahasiswa
        $mhs = Mahasiswa::where('nim', $id)->first();
        if ($mhs && Hash::check($password, $mhs->password)) {
            Auth::guard('mahasiswa')->login($mhs);
            return redirect()->route('home');
        }

        return back()->with('error', 'Login gagal, periksa ulang.');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
