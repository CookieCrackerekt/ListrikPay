<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penggunaan;
use App\Models\Pelanggan;
use App\Models\Tagihan;

/**
 * Controller untuk mengelola data penggunaan listrik oleh pelanggan.
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * Fitur utama:
 * - Menampilkan data penggunaan
 * - Menambah penggunaan baru
 * - Mengedit dan memperbarui penggunaan
 * - Menghapus penggunaan dan tagihan terkait
 * 
 * Catatan:
 * - Hanya admin yang dapat mengakses controller ini.
 */
class PenggunaanController extends Controller
{
    /**
     * Menampilkan daftar semua data penggunaan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $judul = "Data Penggunaan";
        $data = Penggunaan::with('pelanggan')->get();
        return view('admin.v_penggunaan.index', compact('data', 'judul'));
    }

    /**
     * Menampilkan form untuk menambah data penggunaan baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $judul = "Tambah Data Penggunaan";
        $pelanggan = Pelanggan::all();
        return view('admin.v_penggunaan.create', compact('pelanggan', 'judul'));
    }

    /**
     * Menyimpan data penggunaan baru dan membuat tagihan otomatis.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'bulan' => 'required|string',
            'tahun' => 'required|numeric|min:2000|max:2100',
            'meter_akhir' => 'required|numeric|min:1',
        ]);

        $meter_awal = 0;

        $penggunaan = Penggunaan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'meter_awal' => $meter_awal,
            'meter_akhir' => $request->meter_akhir,
        ]);

        $jumlah_meter = $request->meter_akhir - $meter_awal;

        Tagihan::create([
            'id_penggunaan' => $penggunaan->id_penggunaan,
            'id_pelanggan' => $penggunaan->id_pelanggan,
            'jumlah_meter' => $jumlah_meter,
            'bulan' => $penggunaan->bulan,
            'tahun' => $penggunaan->tahun,
            'status' => 'belum bayar',
        ]);

        return redirect()->route('penggunaan.index')->with('success', 'Data penggunaan berhasil disimpan');
    }

    /**
     * Menampilkan form edit data penggunaan berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $penggunaan = Penggunaan::findOrFail($id);
        $penggunaan->meter_awal = $penggunaan->meter_akhir;

        $pelanggan = Pelanggan::all();
        $judul = 'Edit Data Penggunaan';

        return view('admin.v_penggunaan.edit', compact('penggunaan', 'pelanggan', 'judul'));
    }

    /**
     * Memperbarui data penggunaan dan menambahkan tagihan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $penggunaan = Penggunaan::findOrFail($id);
        $meter_awal = $penggunaan->meter_akhir;

        $request->validate([
            'meter_akhir' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($penggunaan) {
                    if ($value <= $penggunaan->meter_akhir) {
                        $fail('Meter akhir harus lebih besar dari meter sebelumnya.');
                    }
                },
            ],
        ]);

        $penggunaan->update([
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'meter_awal' => $meter_awal,
            'meter_akhir' => $request->meter_akhir,
        ]);

        $jumlah_meter = $request->meter_akhir - $meter_awal;

        Tagihan::create([
            'id_penggunaan' => $penggunaan->id_penggunaan,
            'id_pelanggan' => $penggunaan->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'jumlah_meter' => $jumlah_meter,
            'status' => 'belum bayar',
        ]);
        
        return redirect()->route('penggunaan.index')->with('success', 'Data Penggunaan berhasil diperbaharui dan Data Tagihan ditambahkan');
    }

    /**
     * Menghapus data penggunaan dan tagihan yang terkait.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $penggunaan = Penggunaan::findOrFail($id);

        if ($penggunaan->tagihan) {
            $penggunaan->tagihan->delete();
        }

        $penggunaan->delete();

        return redirect()->route('penggunaan.index')->with('success', 'Data penggunaan berhasil dihapus');
    }
}
