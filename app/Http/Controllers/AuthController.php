<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Controller untuk menangani proses autentikasi pelanggan dan admin.
 * @package Listrik Pay
 * @author Muhammad Hammam Afif
 * @version 1.0
 * Fitur yang didukung:
 * - Login Pelanggan dan Admin
 * - Register Pelanggan
 * - Logout (baik pelanggan maupun admin)
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login dan register pelanggan.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('pelanggan.v_login.loginregister');
    }

    /**
     * Memproses login pelanggan.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginPelanggan(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('pelanggan')->attempt($credentials)) {
            $request->session()->regenerate(); // Hindari session fixation
            return redirect()->route('pelanggan.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
    }

    /**
     * Memproses login admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
    }

    /**
     * Logout pengguna (baik pelanggan maupun admin).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        if (Auth::guard('pelanggan')->check()) {
            Auth::guard('pelanggan')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
