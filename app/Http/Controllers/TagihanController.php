<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Penggunaan;
use App\Models\Pelanggan;

/**
 * Controller untuk mengelola data Tagihan Listrik.
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * Fitur-fitur yang disediakan:
 * - Menampilkan daftar tagihan listrik pelanggan
 * - Menyimpan data tagihan baru ke database
 * - Menampilkan form edit tagihan
 * - Menghapus data tagihan
 *
 * Setiap tagihan terhubung dengan:
 * - Data penggunaan listrik
 * - Data pelanggan
 * - Data tarif pelanggan
 * 
 * Catatan:
 * - Hanya admin yang dapat mengakses controller ini.
 */
class TagihanController extends Controller
{
    /**
     * Menampilkan semua data tagihan listrik beserta data pelanggan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = Tagihan::with(['pelanggan'])->get();
        $judul = 'Data Tagihan Listrik';
        return view('admin.v_tagihan.index', compact('data', 'judul'));
    }

    /**
     * Menampilkan form edit tagihan berdasarkan ID.
     * Sekaligus memuat data relasi penggunaan, pelanggan, dan tarif.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tagihan = Tagihan::with('penggunaan.pelanggan.tarif')->findOrFail($id);
        $judul = "Form Pembayaran";
        return view('admin.v_tagihan.edit', compact('tagihan', 'judul'));
    }

    /**
     * Menghapus data tagihan berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Tagihan::destroy($id);
        return redirect()->route('tagihan.index');
    }
}
