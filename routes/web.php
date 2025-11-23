<?php

use App\Http\Controllers\AspirationController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('main.home');
})->name('home');

Route::get('/about', function () {
    return view('main.about');
})->name('about');

Route::get('/activity', [AspirationController::class, 'index'])->name('activity');
Route::get('/activity/category/{kategori}', [AspirationController::class, 'index'])->name('activity.filter');
Route::post('/activity/{id}/vote', [AspirationController::class, 'vote'])->middleware('mahasiswa.only')->name('aspiration.vote');

Route::get('/visitors', function () {
    return view('main.graphic');
})->name('visitors');

Route::get('/aspiration', [AspirationController::class, 'create'])
    ->middleware('mahasiswa.only')
    ->name('aspiration.create');
Route::post('/aspiration', [AspirationController::class, 'store'])
    ->middleware(['throttle:30,1', 'mahasiswa.only'])
    ->name('aspiration.store'); 

Route::get('/profile', [ProfileController::class, 'show'])
    ->name('profile');
Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
    ->name('profile.password.update');

Route::get('/logins', function () {
    return view('main.loginpage');
})->name('login');

Route::get('/login-adm', function () {
    return view('login-role.login-admin');
})->name('login-adm');
Route::post('/login-adm', [AuthController::class, 'login']);

Route::get('/login-mhs', function () {
    return view('login-role.login-mhs');
})->name('login-mhs');
Route::post('/login-mhs', [AuthController::class, 'login']);

Route::get('/login-dosen', function () {
    return view('login-role.login-dosen');
})->name('login-dosen');
Route::post('/login-dosen', [AuthController::class, 'login']);

// Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('admin')->get('/admin/dashboard', function () {
    return view('users.admin');
})->name('adm.dashboard');

Route::middleware('dosen')->get('/dosen/dashboard', function () {
    return "Halo Dosen!";
})->name('dosen.dashboard');

Route::middleware('mahasiswa')->get('/mhs/dashboard', function () {
    return "Halo Mahasiswa!";
})->name('mhs.dashboard');

Route::post('/logout', function () {
    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
    } elseif (Auth::guard('dosen')->check()) {
        Auth::guard('dosen')->logout();
    } elseif (Auth::guard('mahasiswa')->check()) {
        Auth::guard('mahasiswa')->logout();
    }

    return redirect()->route('login');
})->name('logout');

Route::delete('/aspirasi/{id}', [AspirationController::class, 'destroy'])->middleware('admin.only')->name('aspiration.destroy');
Route::delete('/aspirasi', [AspirationController::class, 'destroyAll'])->middleware('admin.only')->name('aspiration.destroyAll');

Route::middleware('admin.only')->group(function () {
    // Tambahkan rute yang hanya dapat diakses oleh admin di sini
    Route::get('/aspirasi/{id}/reply', [AspirationController::class, 'showReplyForm'])->name('aspiration.reply.form');
    Route::post('/aspirasi/{id}/reply', [AspirationController::class, 'storeReply'])->name('aspiration.reply.store');
});

Route::middleware('admin.only')->get('/admin/aspirations', [AspirationController::class, 'adminIndex'])->name('admin.index');

// Mahasiswa report aspirasi
Route::post('/aspirasi/{id}/report', [AspirationController::class, 'report'])
    ->middleware('mahasiswa.only')
    ->name('aspiration.report');

    // Admin lihar report
Route::middleware('admin.only')->get('/admin/reports', [AspirationController::class, 'adminReports'])
    ->name('admin.reports.index');