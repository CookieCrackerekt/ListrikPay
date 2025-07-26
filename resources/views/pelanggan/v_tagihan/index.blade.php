@extends('pelanggan.v_layouts.app')
@section('content')
    @include('pelanggan.v_layouts.navbar')
    @include('pelanggan.v_layouts.sidebar')

    <div class="app">
        <div class="content">
            <h3 class="mb-4 text-center">Daftar Tagihan</h3></br>
            @foreach ($tagihan as $data)
                <div class="tagihan-box">
                    <h4>Tagihan #{{ $data->id_tagihan }}</h4>

                    <div class="tagihan-item">
                        <span class="label">Nomor KWH:</span>
                        <span>{{ $data->penggunaan->pelanggan->nomor_kwh }}</span>
                    </div>

                    <div class="tagihan-item">
                        <span class="label">Nama Pelanggan:</span>
                        <span>{{ $data->penggunaan->pelanggan->nama_pelanggan }}</span>
                    </div>

                    <div class="tagihan-item">
                        <span class="label">Bulan:</span>
                        <span>{{ $data->bulan }}</span>
                    </div>

                    <div class="tagihan-item">
                        <span class="label">Jumlah Meter:</span>
                        <span>{{ $data->jumlah_meter }}</span>
                    </div>

                    <div class="tagihan-item">
                        <span class="label">Status:</span>
                        @if($data->status == 'belum bayar')
                            <span class="status-belum">Belum Dibayar</span>
                        @else
                            <span class="status-sudah">Lunas</span>
                        @endif
                    </div>
                    </br>
                    <div class="text-end">
                        @if($data->status == 'belum bayar')
                            <a href="{{ route('pelanggan.pembayaran.form', ['id_tagihan' => $data->id_tagihan]) }}"
                                class="btn-prosespembayaran">Proses Pembayaran</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection