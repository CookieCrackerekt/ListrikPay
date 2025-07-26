@extends('admin.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('penggunaan.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Pelanggan -->
                                    <div class="form-group">
                                        <label>Pelanggan</label>
                                        <select name="id_pelanggan"
                                            class="form-control @error('id_pelanggan') is-invalid @enderror">
                                            <option value="">- Pilih Pelanggan -</option>
                                            @foreach ($pelanggan as $p)
                                                <option value="{{ $p->id_pelanggan }}" {{ old('id_pelanggan') == $p->id_pelanggan ? 'selected' : '' }}>
                                                    {{ $p->nama_pelanggan }} - {{ $p->nomor_kwh }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_pelanggan')
                                            <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Tahun -->
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <input type="number" name="tahun" value="{{ old('tahun') }}"
                                            class="form-control @error('tahun') is-invalid @enderror"
                                            placeholder="Masukan Tahun">
                                        @error('tahun')
                                            <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Bulan -->
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select name="bulan" class="form-control @error('bulan') is-invalid @enderror">
                                            <option value="">- Pilih Bulan -</option>
                                            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bln)
                                                <option value="{{ $bln }}" {{ old('bulan') == $bln ? 'selected' : '' }}>{{ $bln }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('bulan')
                                            <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Meter Awal -->
                                    <div class="form-group">
                                        <label>Meter Awal</label>
                                        <input type="number" name="meter_awal" value="0" readonly
                                            class="form-control @error('meter_awal') is-invalid @enderror">
                                        @error('meter_awal')
                                            <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Meter Akhir -->
                                    <div class="form-group">
                                        <label>Meter Akhir</label>
                                        <input type="number" name="meter_akhir" value="{{ old('meter_akhir') }}"
                                            class="form-control @error('meter_akhir') is-invalid @enderror"
                                            placeholder="Masukkan angka meter akhir">
                                        @error('meter_akhir')
                                            <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('penggunaan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection