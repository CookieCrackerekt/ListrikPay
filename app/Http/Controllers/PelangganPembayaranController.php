<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk menangani proses pembayaran oleh pelanggan.
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * Fitur yang disediakan:
 * - Menampilkan form pembayaran berdasarkan tagihan pelanggan.
 * - Menyimpan data pembayaran setelah validasi.
 * - Memastikan nominal cukup dan tagihan belum lunas.
 * - Mengubah status tagihan menjadi lunas setelah pembayaran berhasil.
 */
class PelangganPembayaranController extends Controller
{
    /**
     * Menampilkan form pembayaran untuk tagihan tertentu milik pelanggan yang sedang login.
     *
     * @param int $id_tagihan ID tagihan yang akan dibayar
     * @return \Illuminate\View\View
     */
    public function index($id_tagihan)
    {
        $judul = 'Form Pembayaran';

        // Ambil ID pelanggan yang sedang login
        $id_pelanggan = Auth::guard('pelanggan')->user()->id_pelanggan;

        // Ambil tagihan yang dimiliki pelanggan dan belum dibayar
        $tagihan = Tagihan::with('penggunaan.pelanggan.tarif')
            ->where('id_tagihan', $id_tagihan)
            ->where('id_pelanggan', $id_pelanggan)
            ->where('status', 'belum bayar')
            ->firstOrFail();

        return view('pelanggan.v_pembayaran.index', compact('tagihan', 'judul'));
    }

    /**
     * Memproses dan menyimpan pembayaran tagihan oleh pelanggan.
     *
     * @param \Illuminate\Http\Request $request Objek request berisi data pembayaran
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman tagihan dengan pesan sukses/gagal
     */
    public function store(Request $request)
    {
        // Ambil id_tagihan dari form
        $id_tagihan = $request->input('id_tagihan');

        // Validasi input
        $request->validate([
            'id_tagihan' => 'required|exists:tagihan,id_tagihan',
            'nominal_bayar' => 'required|numeric|min:0',
        ]);

        // Ambil ID pelanggan dari yang sedang login
        $id_pelanggan = Auth::guard('pelanggan')->user()->id_pelanggan;

        // Ambil data tagihan milik pelanggan yang login
        $tagihan = Tagihan::with('penggunaan.pelanggan.tarif')
            ->where('id_tagihan', $id_tagihan)
            ->where('id_pelanggan', $id_pelanggan)
            ->firstOrFail();

        // Hitung total pembayaran
        $tarifperkwh = $tagihan->penggunaan->pelanggan->tarif->tarifperkwh ?? 0;
        $biaya_admin = 2500;
        $total_bayar = ($tagihan->jumlah_meter * $tarifperkwh) + $biaya_admin;

        // Cek apakah nominal yang dibayar cukup
        if ($request->nominal_bayar < $total_bayar) {
            return back()->withErrors([
                'nominal_bayar' => 'Nominal bayar kurang dari total tagihan.'
            ])->withInput();
        }

        // Cek apakah tagihan sudah lunas
        if ($tagihan->status === 'lunas') {
            return back()->withErrors([
                'nominal_bayar' => 'Tagihan ini sudah lunas.'
            ]);
        }

        // Simpan pembayaran
        Pembayaran::create([
            'id_tagihan' => $tagihan->id_tagihan,
            'id_pelanggan' => $id_pelanggan,
            'user_id' => null, // karena yang bayar adalah pelanggan
            'tanggal_pembayaran' => now()->format('Y-m-d'),
            'bulan_bayar' => $tagihan->bulan,
            'biaya_admin' => $biaya_admin,
            'total_bayar' => $total_bayar,
        ]);

        // Perbarui status tagihan
        $tagihan->update(['status' => 'lunas']);

        return redirect()->route('pelanggan.tagihan')->with('success', 'Pembayaran berhasil disimpan.');
    }
}
