@extends('admin.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('pelanggan.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Nomor KWH</label>
                                        <input type="text" name="nomor_kwh" value="{{ old('nomor_kwh') }}"
                                            class="form-control @error('nomor_kwh') is-invalid @enderror"
                                            placeholder="Masukkan Nomor KWH">
                                        @error('nomor_kwh')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Pelanggan</label>
                                        <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}"
                                            class="form-control @error('nama_pelanggan') is-invalid @enderror"
                                            placeholder="Masukkan Nama Pelanggan">
                                        @error('nama_pelanggan')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                            placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" value="{{ old('username') }}"
                                            class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Masukkan Username">
                                        @error('username')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Masukkan Password">
                                        @error('password')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Tarif</label>
                                        <select name="id_tarif"
                                            class="form-control @error('id_tarif') is-invalid @enderror">
                                            <option value="">-- Pilih Daya / Tarif --</option>
                                            @foreach ($tarif as $trf)
                                                <option value="{{ $trf->id_tarif }}">
                                                    {{ $trf->daya }} VA - Rp.{{ number_format($trf->tarifperkwh, 0, ',', '.') }}/kWh
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_tarif')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection