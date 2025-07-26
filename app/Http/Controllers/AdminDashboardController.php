<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * Controller untuk Dashboard Admin
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * Menampilkan statistik utama pada halaman dashboard admin:
 * - Jumlah Pelanggan
 * - Jumlah Penggunaan
 * - Jumlah Tagihan yang Belum Dibayar
 * - Jumlah Pembayaran
 * 
 * Catatan:
 * - Hanya admin yang dapat mengakses controller ini.
 */
class AdminDashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin dengan statistik data
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $judul = "Beranda";
        return view('admin.v_beranda.index', [
            'judul' => 'Dashboard Admin',
            'jumlah_pelanggan' => Pelanggan::count(),
            'jumlah_penggunaan' => Penggunaan::count(),
            'jumlah_tagihan' => Tagihan::where('status', 'belum bayar')->count(),
            'jumlah_pembayaran' => Pembayaran::count(),
        ]);
    }
}