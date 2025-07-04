<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\Admin\AdminUserRegistrationController;
use App\Http\Controllers\Admin\MakananController;
use App\Http\Controllers\Admin\AdminUserController; 
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUlasanController;
use App\Http\Controllers\Admin\AdminRiwayatController;

// =============================
// HALAMAN UTAMA
// =============================
Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard berdasarkan role login
Route::get('/dashboard', [HomeController::class, 'redirect'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// =============================
// ROUTE UMUM (semua user login)
// =============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =============================
// ROUTE PELANGGAN
// =============================
Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganController::class, 'dashboard'])->name('dashboard');
    Route::get('/pesan', [PelangganController::class, 'pesan'])->name('pesan');
    Route::post('/pesan', [PelangganController::class, 'simpanPesanan'])->name('simpan');
    Route::get('/lacak', [PelangganController::class, 'lacak'])->name('lacak');
    Route::get('/riwayat', [PelangganController::class, 'riwayat'])->name('riwayat');
    Route::delete('/batal/{id}', [PelangganController::class, 'batal'])->name('batal');
    Route::get('/pesanan/{pesanan_id}/ulasan', [PelangganController::class, 'beriUlasan'])->name('beri-ulasan');
    Route::post('/pesanan/{pesanan_id}/ulasan', [PelangganController::class, 'simpanUlasan'])->name('simpan-ulasan');
});

// =============================
// ROUTE PEGAWAI
// =============================
Route::middleware(['auth', 'role:pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
    Route::get('/dashboard', fn() => view('pegawai.dashboard'))->name('dashboard');
    Route::get('/pesanan', [PegawaiController::class, 'index'])->name('pesanan');
    Route::get('/pesanan/{id}', [PegawaiController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan/{id}/verifikasi', [PegawaiController::class, 'verifikasi'])->name('verifikasi');
});

// =============================
// ROUTE KURIR
// =============================
Route::middleware(['auth', 'role:kurir'])->prefix('kurir')->name('kurir.')->group(function () {
    Route::get('/dashboard', fn() => view('kurir.dashboard'))->name('dashboard');
    Route::get('/pesanan', [KurirController::class, 'index'])->name('pesanan');
    Route::post('/pesanan/{id}/kirim', [KurirController::class, 'kirim'])->name('kirim');
    Route::post('/pesanan/{id}/selesai', [KurirController::class, 'selesai'])->name('selesai');
});

// =============================
// ROUTE ADMIN
// =============================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Kelola makanan
    Route::resource('makanan', MakananController::class)->names('makanan');

    // Kelola user
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Lihat ulasan
    Route::get('ulasan', [AdminUlasanController::class, 'index'])->name('ulasan.index');

    // Riwayat pembelian
    Route::get('riwayat', [AdminRiwayatController::class, 'index'])->name('riwayat.index');

    // Form registrasi akun baru (admin/pegawai/kurir)
    Route::get('register-user', [AdminUserRegistrationController::class, 'create'])->name('register-user');
    Route::post('register-user', [AdminUserRegistrationController::class, 'store'])->name('register-user.store');
});




// =============================
// ROUTE AUTH
// =============================
require __DIR__.'/auth.php';
