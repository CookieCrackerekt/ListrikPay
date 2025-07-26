@extends('pelanggan.v_layouts.app')
@section('content')
    @include('pelanggan.v_layouts.navbar')
    @include('pelanggan.v_layouts.sidebar')
    <div class="app">
        <div class="content">
            <div class="container mt-4">
                <h4>{{ $judul }}</h4>
                @php
                    $tarifperkwh = $tagihan->penggunaan->pelanggan->tarif->tarifperkwh ?? 0;
                    $biaya_admin = 2500;
                    $total_bayar = ($tagihan->jumlah_meter * $tarifperkwh) + $biaya_admin;
                @endphp
                <div class="pembayaran-box">
                    <h4>Tagihan Bulan {{ $tagihan->bulan }} Tahun {{ $tagihan->tahun }}</h4>
                    <div class="pembayaran-item"><span class="label">Nama Pelanggan:</span>
                        <span>{{ $tagihan->penggunaan->pelanggan->nama_pelanggan }}</span>
                    </div>
                    <div class="pembayaran-item"><span class="label">Jumlah Meter:</span> <span>{{ $tagihan->jumlah_meter }}
                            kWh</span></div>
                    <div class="pembayaran-item"><span class="label">Tarif per kWh:</span>
                        <span>Rp{{ number_format($tarifperkwh, 0, ',', '.') }}</span>
                    </div>
                    <div class="pembayaran-item"><span class="label">Biaya Admin:</span>
                        <span>Rp{{ number_format($biaya_admin, 0, ',', '.') }}</span>
                    </div>
                    <div class="pembayaran-item"><span class="label">Total Bayar:</span>
                        <span>Rp{{ number_format($total_bayar, 0, ',', '.') }}</span>
                    </div>
                    <form action="{{ route('pelanggan.pembayaran.store') }}" method="POST"
                        style="margin-top: 20px;">
                        @csrf
                        <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}">
                        <div class="form-group">
                            <label for="nominal_bayar">Nominal Bayar</label>
                            <input type="number" name="nominal_bayar" class="form-control" required
                                min="{{ $total_bayar }}">
                        </div>
                        </br>
                        <button type="submit" class="btn-bayar">Bayar</button>
                        <a href="{{ route('pelanggan.tagihan') }}" class="btn-kembali">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection