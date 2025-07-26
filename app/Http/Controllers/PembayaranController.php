<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\User;

/**
 * Controller untuk mengelola pembayaran tagihan oleh admin.
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * Fitur yang tersedia:
 * - Menampilkan semua data pembayaran.
 * - Mencetak laporan pembayaran.
 * - Menyimpan data pembayaran baru.
 * - Menghapus data pembayaran.
 *
 * Catatan:
 * - Hanya admin yang dapat mengakses controller ini.
 * - Validasi nominal pembayaran terhadap jumlah tagihan dan status lunas.
 */
class PembayaranController extends Controller
{
    /**
     * Menampilkan daftar semua data pembayaran.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $judul = 'Data Pembayaran';
        $data = Pembayaran::with(['tagihan.penggunaan.pelanggan', 'user'])->get();
        return view('admin.v_pembayaran.index', compact('data', 'judul'));
    }

    /**
     * Menampilkan halaman cetak laporan pembayaran.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function cetak(Request $request)
    {
        $judul = 'Laporan Pembayaran';
        $cetak = Pembayaran::with('tagihan.penggunaan.pelanggan', 'user')->get();

        return view('admin.v_pembayaran.cetak', compact('judul', 'cetak'));
    }

    /**
     * Menyimpan data pembayaran baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $id_tagihan = $request->input('id_tagihan');
        $request->validate([
            'id_tagihan' => 'required|exists:tagihan,id_tagihan',
            'nominal_bayar' => 'required|numeric|min:0',
        ]);

        $tagihan = Tagihan::with('penggunaan.pelanggan.tarif')
            ->where('id_tagihan', $id_tagihan)
            ->firstOrFail();

        $tarifperkwh = $tagihan->penggunaan->pelanggan->tarif->tarifperkwh ?? 0;
        $biaya_admin = 2500;
        $total_bayar = ($tagihan->jumlah_meter * $tarifperkwh) + $biaya_admin;

        if ($request->nominal_bayar < $total_bayar) {
            return back()->withErrors([
                'nominal_bayar' => 'Nominal bayar kurang dari total tagihan.'
            ])->withInput();
        }

        if ($tagihan->status === 'lunas') {
            return back()->withErrors([
                'nominal_bayar' => 'Tagihan ini sudah lunas.'
            ]);
        }

        Pembayaran::create([
            'id_tagihan' => $tagihan->id_tagihan,
            'id_pelanggan' => $tagihan->penggunaan->id_pelanggan,
            'user_id' => Auth::guard('web')->id(),
            'tanggal_pembayaran' => now()->format('Y-m-d'),
            'bulan_bayar' => $tagihan->bulan,
            'biaya_admin' => $biaya_admin,
            'total_bayar' => $total_bayar,
        ]);

        $tagihan->update(['status' => 'lunas']);

        return redirect()->route('tagihan.index')->with('success', 'Pembayaran berhasil disimpan.');
    }

    /**
     * Menghapus data pembayaran dan mengubah status tagihan menjadi belum bayar.
     *
     * @param int $id ID pembayaran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        Tagihan::where('id_tagihan', $pembayaran->id_tagihan)->update([
            'status' => 'belum bayar'
        ]);

        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }

    /**
     * Placeholder untuk menampilkan form create (belum digunakan).
     */
    public function create()
    {
        //
    }

    /**
     * Placeholder untuk update data pembayaran (belum digunakan).
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id ID pembayaran
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Placeholder untuk menampilkan form edit (belum digunakan).
     *
     * @param int $id ID pembayaran
     */
    public function edit($id)
    {
        //
    }
}
