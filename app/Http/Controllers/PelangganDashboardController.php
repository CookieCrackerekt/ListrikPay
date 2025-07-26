<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tagihan;
use App\Models\Pelanggan;
use App\Models\Penggunaan;

/**
 * Controller untuk Dashboard Pelanggan
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * Menangani logika tampilan halaman dashboard pelanggan, termasuk:
 * - Menampilkan halaman beranda pelanggan
 * - Menampilkan profil lengkap pelanggan dan data penggunaan terakhir
 * - Menampilkan daftar tagihan listrik pelanggan
 *
 * @package App\Http\Controllers
 */
class PelangganDashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dashboard pelanggan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pelanggan.v_beranda.index');
    }

    /**
     * Menampilkan data profil pelanggan yang sedang login, termasuk informasi tarif dan penggunaan terakhir.
     *
     * @return \Illuminate\View\View
     */
    public function profil()
    {
        $pelanggan = Pelanggan::with('tarif')
            ->where('id_pelanggan', Auth::guard('pelanggan')->user()->id_pelanggan)
            ->first();

        $penggunaan = Penggunaan::where('id_pelanggan', $pelanggan->id_pelanggan)
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();

        return view('pelanggan.v_profil.index', compact('pelanggan', 'penggunaan'));
    }

    /**
     * Menampilkan daftar tagihan pelanggan yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function tagihan()
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $tagihan = Tagihan::with(['penggunaan.pelanggan'])
            ->where('id_pelanggan', $pelanggan->id_pelanggan)
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('pelanggan.v_tagihan.index', compact('tagihan'));
    }
}
