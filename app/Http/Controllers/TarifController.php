<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarif;

/**
 * Controller untuk mengelola data Tarif Listrik.
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * Fitur yang tersedia:
 * - Menampilkan daftar tarif listrik
 * - Menambahkan tarif baru
 * - Mengedit tarif yang sudah ada
 * - Menghapus tarif listrik
 * 
 * Catatan:
 * - Hanya admin yang dapat mengakses controller ini.
 */
class TarifController extends Controller
{
    /**
     * Menampilkan semua data tarif listrik.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = Tarif::all();
        $judul = 'Data Tarif Listrik';

        return view('admin.v_tarif.index', compact('data', 'judul'));
    }

    /**
     * Menampilkan form untuk menambah data tarif baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.v_tarif.create', [
            'judul' => 'Tambah Data Tarif'
        ]);
    }

    /**
     * Menyimpan data tarif baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'daya' => 'required|numeric',
            'tarifperkwh' => 'required|numeric'
        ]);

        Tarif::create($request->all());

        return redirect()->route('tarif.index')->with('success', 'Data tarif berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit tarif berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.v_tarif.edit', [
            'edit' => Tarif::findOrFail($id),
            'judul' => 'Edit Data Tarif'
        ]);
    }

    /**
     * Memperbarui data tarif berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $tarif = Tarif::findOrFail($id);
        $tarif->update($request->all());

        return redirect()->route('tarif.index')->with('success', 'Data tarif berhasil diperbarui');
    }

    /**
     * Menghapus data tarif berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Tarif::destroy($id);

        return redirect()->route('tarif.index')->with('success', 'Data tarif berhasil dihapus');
    }
}
