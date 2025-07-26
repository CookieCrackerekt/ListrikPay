<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PelangganDashboardController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\PelangganPembayaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;

/**
 * ---------------------------------------------
 * Web Routes for Aplikasi Pembayaran Listrik
 * ---------------------------------------------
 * 
 * File ini mendefinisikan seluruh rute HTTP untuk aplikasi berbasis Laravel,
 * termasuk otentikasi, halaman pelanggan, dan halaman admin.
 * 
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 */

// ====================
// AUTH (LOGIN/REGISTER)
// ====================

/**
 * Halaman utama - redirect ke dashboard sesuai role login
 * - Admin diarahkan ke admin.dashboard
 * - Pelanggan diarahkan ke pelanggan.dashboard
 * - Jika belum login, diarahkan ke login
 */
Route::get('/', function () {
    if (Auth::guard('web')->check()) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::guard('pelanggan')->check()) {
        return redirect()->route('pelanggan.dashboard');
    } else {
        return redirect()->route('login');
    }
});

/**
 * Menampilkan form login
 */
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

/**
 * Proses login pelanggan
 */
Route::post('/login/pelanggan', [AuthController::class, 'loginPelanggan'])->name('login.pelanggan');

/**
 * Proses login admin
 */
Route::post('/login/admin', [AuthController::class, 'loginAdmin'])->name('login.admin');

/**
 * Proses register pelanggan
 */
Route::post('/register', [AuthController::class, 'registerPelanggan'])->name('register.process');

/**
 * Logout untuk semua jenis user
 */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ====================
// PELANGGAN
// ====================

/**
 * Rute khusus untuk pelanggan
 * Middleware: auth:pelanggan
 * Prefix URL: /pelanggan
 */
Route::middleware('auth:pelanggan')->prefix('pelanggan')->group(function () {

    /** Dashboard pelanggan */
    Route::get('/dashboard', [PelangganDashboardController::class, 'index'])->name('pelanggan.dashboard');

    /** Halaman profil pelanggan */
    Route::get('/profil', [PelangganDashboardController::class, 'profil'])->name('pelanggan.profil');

    /** Daftar tagihan pelanggan */
    Route::get('/tagihan', [PelangganDashboardController::class, 'tagihan'])->name('pelanggan.tagihan');

    /**
     * Form pembayaran untuk pelanggan berdasarkan ID tagihan
     * 
     * @param int $id_tagihan
     */
    Route::get('/pembayaran/{id_tagihan}', [PelangganPembayaranController::class, 'index'])->name('pelanggan.pembayaran.form');

    /**
     * Proses pembayaran pelanggan
     */
    Route::post('/pembayaran', [PelangganPembayaranController::class, 'store'])->name('pelanggan.pembayaran.store');
});


// ====================
// ADMIN
// ====================

/**
 * Rute khusus untuk admin
 * Middleware: auth:web
 * Prefix URL: /admin
 */
Route::middleware('auth:web')->prefix('admin')->group(function () {

    /** Dashboard admin */
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    /** Cetak laporan pembayaran */
    Route::get('/pembayaran/cetak', [PembayaranController::class, 'cetak'])->name('pembayaran.cetak');

    /** CRUD data penggunaan listrik */
    Route::resource('penggunaan', PenggunaanController::class);

    /** CRUD data pelanggan */
    Route::resource('pelanggan', PelangganController::class);

    /** CRUD data tarif */
    Route::resource('tarif', TarifController::class);

    /** CRUD data tagihan */
    Route::resource('tagihan', TagihanController::class);

    /** CRUD data pembayaran */
    Route::resource('pembayaran', PembayaranController::class);

    /** CRUD data user admin */
    Route::resource('user', UserController::class);
});
