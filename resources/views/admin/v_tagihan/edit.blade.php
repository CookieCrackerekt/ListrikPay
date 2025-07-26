@extends('admin.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @php
                        $tarifperkwh = $tagihan->penggunaan->pelanggan->tarif->tarifperkwh ?? 0;
                        $biaya_admin = 2500;
                        $total_bayar = ($tagihan->jumlah_meter * $tarifperkwh) + $biaya_admin;
                    @endphp
                    <form action="{{ route('pembayaran.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}">
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Nama Pelanggan -->
                                    <div class="form-group">
                                        <label>Nama Pelanggan</label>
                                        <input type="text" class="form-control" readonly
                                            value="{{ $tagihan->penggunaan->pelanggan->nama_pelanggan }}">
                                    </div>
                                    <!-- Bulan & Tahun -->
                                    <div class="form-group">
                                        <label>Bulan / Tahun</label>
                                        <input type="text" class="form-control" readonly
                                            value="{{ $tagihan->bulan }} / {{ $tagihan->tahun }}">
                                    </div>
                                    <!-- Jumlah Meter -->
                                    <div class="form-group">
                                        <label>Jumlah Meter (kWh)</label>
                                        <input type="text" class="form-control" readonly
                                            value="{{ $tagihan->jumlah_meter }}">
                                    </div>
                                    <!-- Tarif per kWh -->
                                    <div class="form-group">
                                        <label>Tarif per kWh</label>
                                        <input type="text" class="form-control" readonly
                                            value="Rp{{ number_format($tarifperkwh, 0, ',', '.') }}">
                                    </div>
                                    <!-- Biaya Admin -->
                                    <div class="form-group">
                                        <label>Biaya Admin</label>
                                        <input type="text" class="form-control" readonly
                                            value="Rp{{ number_format($biaya_admin, 0, ',', '.') }}">
                                    </div>
                                    <!-- Total Bayar -->
                                    <div class="form-group">
                                        <label>Total Bayar</label>
                                        <input type="text" class="form-control" readonly
                                            value="Rp{{ number_format($total_bayar, 0, ',', '.') }}">
                                    </div>
                                    <!-- Nominal Bayar -->
                                    <div class="form-group">
                                        <label>Nominal Bayar</label>
                                        <input type="number" name="nominal_bayar" class="form-control" required
                                            min="{{ $total_bayar }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tombol Submit -->
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success">Bayar</button>
                                <a href="{{ route('tagihan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection