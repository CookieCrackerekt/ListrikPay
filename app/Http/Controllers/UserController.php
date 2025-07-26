<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Controller untuk manajemen data User Admin dan Petugas
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * Fitur utama:
 * - Menampilkan daftar user admin & petugas
 * - Menambahkan user baru
 * - Mengedit data user
 * - Menghapus user
 * 
 * Catatan:
 * - Hanya admin yang dapat mengakses controller ini.
 */
class UserController extends Controller
{
    /**
     * Menampilkan semua data user admin & petugas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = User::with('level')->get();
        $judul = 'Data Admin & Petugas';

        return view('admin.v_user.index', compact('data', 'judul'));
    }

    /**
     * Menampilkan form tambah user baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $levels = Level::all();
        $judul = 'Tambah User Admin';
        return view('admin.v_user.create', compact('levels', 'judul'));
    }

    /**
     * Menyimpan data user baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user',
            'password' => 'required|min:6',
            'nama_admin' => 'required',
            'id_level' => 'required|exists:level,id_level',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $filename = null;
        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('img-user', $filename, 'public');
        }

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_admin' => $request->nama_admin,
            'id_level' => $request->id_level,
            'foto' => $filename,
        ]);

        return redirect()->route('user.index')->with('success', 'Data User berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit user berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $edit = User::findOrFail($id);
        $levels = Level::all();
        $judul = 'Edit User Admin';
        return view('admin.v_user.edit', compact('edit', 'levels', 'judul'));
    }

    /**
     * Memperbarui data user berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:user,username,' . $id . ',user_id',
            'nama_admin' => 'required',
            'id_level' => 'required|exists:level,id_level',
            'password' => 'nullable|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['username', 'nama_admin', 'id_level']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists('img-user/' . $user->foto)) {
                Storage::disk('public')->delete('img-user/' . $user->foto);
            }

            $filename = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('img-user', $filename, 'public');
            $data['foto'] = $filename;
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success', 'Data User berhasil diperbarui');
    }

    /**
     * Menghapus data user berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index')->with('success', 'Data User berhasil dihapus');
    }
}
