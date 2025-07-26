<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;
use App\Models\Tarif;

/**
 * Controller untuk manajemen data pelanggan
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * Mengelola proses CRUD data pelanggan
 * Fitur utama:
 * - Menampilkan daftar pelanggan
 * - Menambahkan pelanggan baru
 * - Mengedit data pelanggan
 * - Menghapus pelanggan
 * 
 * Catatan:
 * - Hanya admin yang dapat mengakses controller ini.
 */
class PelangganController extends Controller
{
    /**
     * Menampilkan daftar semua pelanggan
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = Pelanggan::with('tarif')->get();
        return view('admin.v_pelanggan.index', [
            'data' => $data,
            'judul' => 'Data Pelanggan'
        ]);
    }

    /**
     * Menampilkan form untuk menambah data pelanggan baru
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tarif = Tarif::all();
        return view('admin.v_pelanggan.create', [
            'tarif' => $tarif,
            'judul' => 'Tambah Data Pelanggan'
        ]);
    }

    /**
     * Menyimpan data pelanggan baru ke database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:pelanggan',
            'password' => 'required|min:6',
            'nomor_kwh' => 'required|digits:20|unique:pelanggan',
            'id_tarif' => 'required|exists:tarif,id_tarif',
            'nama_pelanggan' => 'required|string|max:100',
            'alamat' => 'required|string',
        ]);

        Pelanggan::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nomor_kwh' => $request->nomor_kwh,
            'id_tarif' => $request->id_tarif,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit data pelanggan
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $edit = Pelanggan::findOrFail($id);
        $tarif = Tarif::all();
        $judul = 'Edit Data Pelanggan';
        return view('admin.v_pelanggan.edit', compact('edit', 'tarif', 'judul'));
    }

    /**
     * Memperbarui data pelanggan
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:pelanggan,username,' . $id . ',id_pelanggan',
            'nomor_kwh' => 'required|numeric|unique:pelanggan,nomor_kwh,' . $id . ',id_pelanggan',
            'nama_pelanggan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'id_tarif' => 'required|exists:tarif,id_tarif',
        ]);

        $pelanggan->update([
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $pelanggan->password,
            'nomor_kwh' => $request->nomor_kwh,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil diperbarui');
    }

    /**
     * Menghapus data pelanggan
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Pelanggan::destroy($id);
        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil dihapus');
    }

    /**
     * Menampilkan detail data pelanggan
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $show = Pelanggan::with('tarif')->findOrFail($id);
        $tarif = Tarif::all();

        return view('admin.v_pelanggan.show', [
            'show' => $show,
            'tarif' => $tarif,
            'judul' => 'Detail Pelanggan'
        ]);
    }
}
