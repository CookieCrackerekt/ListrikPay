@extends('pelanggan.v_layouts.app')
@section('content')
    @include('pelanggan.v_layouts.navbar')
    @include('pelanggan.v_layouts.sidebar')

    <div class="login-bg">
        <div class="form-box">
            <br><br>
            <h1>LISTRIK PAY</h1>
            <div class="logreg-box">
                <button type="button" class="logreg-toggle-btn" onclick="showLoginPelanggan()">Login Pelanggan</button>
                <button type="button" class="logreg-toggle-btn" onclick="showRegisterPelanggan()">Register
                    Pelanggan</button>
                <button type="button" class="logreg-toggle-btn" onclick="showLoginAdmin()">Login Admin</button>
            </div>

            {{-- Form Login Pelanggan --}}
            <form method="POST" action="{{ route('login.pelanggan') }}" id="form-login-pelanggan" class="input-group">
                @csrf
                <input type="text" name="username" class="input-field" placeholder="Username Pelanggan" required>
                <input type="password" name="password" class="input-field" placeholder="Password" required>
                <br>
                <button type="submit" class="submit-btn">Login Pelanggan</button>
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </form>

            {{-- Form Register Pelanggan --}}
            <form method="POST" action="{{ route('register.process') }}" id="form-register-pelanggan" class="input-group"
                style="display:none;">
                @csrf
                <input type="text" name="username" class="input-field" placeholder="Username" required>
                <input type="password" name="password" class="input-field" placeholder="Password" required>
                <input type="password" name="password_confirmation" class="input-field" placeholder="Konfirmasi Password"
                    required>
                <input type="text" name="nomor_kwh" class="input-field" placeholder="Nomor KWH" required>
                <select name="id_tarif" class="input-field" required>
                    <option value="">-- Pilih Daya / Tarif --</option>
                    @foreach($tarif as $trf)
                        <option value="{{ $trf->id_tarif }}">
                            {{ $trf->daya }} VA - Rp.{{ number_format($trf->tarifperkwh, 0, ',', '.') }}/KWH
                        </option>
                    @endforeach
                </select>
                <input type="text" name="nama_pelanggan" class="input-field" placeholder="Nama Anda" required>
                <input type="text" name="alamat" class="input-field" placeholder="Alamat" required>
                <br>
                <button type="submit" class="submit-btn">Register Pelanggan</button>
                @if (session('status'))
                    <div class="success-message">{{ session('status') }}</div>
                @endif
            </form>

            {{-- Form Login Admin --}}
            <form method="POST" action="{{ route('login.admin') }}" id="form-login-admin" class="input-group"
                style="display:none;">
                @csrf
                <input type="text" name="username" class="input-field" placeholder="Username Admin" required>
                <input type="password" name="password" class="input-field" placeholder="Password" required>
                <br>
                <button type="submit" class="submit-btn">Login Admin</button>
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </div>

    <script>
        function showLoginPelanggan() {
            document.getElementById("form-login-pelanggan").style.display = "block";
            document.getElementById("form-register-pelanggan").style.display = "none";
            document.getElementById("form-login-admin").style.display = "none";
        }

        function showRegisterPelanggan() {
            document.getElementById("form-login-pelanggan").style.display = "none";
            document.getElementById("form-register-pelanggan").style.display = "block";
            document.getElementById("form-login-admin").style.display = "none";
        }

        function showLoginAdmin() {
            document.getElementById("form-login-pelanggan").style.display = "none";
            document.getElementById("form-register-pelanggan").style.display = "none";
            document.getElementById("form-login-admin").style.display = "block";
        }

        // Default tampilkan login pelanggan
        window.onload = function () {
            showLoginPelanggan();
        };
    </script>
@endsection