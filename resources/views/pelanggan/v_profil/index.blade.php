@extends('pelanggan.v_layouts.app')
@section('content')
    @include('pelanggan.v_layouts.navbar')
    @include('pelanggan.v_layouts.sidebar')
    <div class="app">
        <div class="content">
            <div class="profile-box">
                <h4>Profil Pelanggan</h4>
                <div class="profile-item">
                    <span class="label">Nomor KWH:</span>
                    <span>{{ $pelanggan->nomor_kwh }}</span>
                </div>
                <div class="profile-item">
                    <span class="label">Nama Pelanggan:</span>
                    <span>{{ $pelanggan->nama_pelanggan }}</span>
                </div>
                <div class="profile-item">
                    <span class="label">Alamat:</span>
                    <span>{{ $pelanggan->alamat }}</span>
                </div>
                <div class="profile-item">
                    <span class="label">Tarif:</span>
                    <span>{{ $pelanggan->tarif->daya }} VA -
                        Rp{{ number_format($pelanggan->tarif->tarifperkwh, 0, ',', '.') }}/kWh</span>
                </div>
            </div>
            @if($penggunaan)
                <div class="penggunaan-box">
                    <h4>Data Penggunaan</h4>
                    <div class="penggunaan-item">
                        <span class="label">Bulan:</span>
                        <span>{{ $penggunaan->bulan }}</span>
                    </div>
                    <div class="penggunaan-item">
                        <span class="label">Tahun:</span>
                        <span>{{ $penggunaan->tahun }}</span>
                    </div>
                    <div class="penggunaan-item">
                        <span class="label">Meter Awal:</span>
                        <span>{{ $penggunaan->meter_awal }} kWh</span>
                    </div>
                    <div class="penggunaan-item">
                        <span class="label">Meter Akhir:</span>
                        <span>{{ $penggunaan->meter_akhir }} kWh</span>
                    </div>
                    <div class="penggunaan-item">
                        <span class="label">Jumlah Meter:</span>
                        <span>{{ $penggunaan->jumlah_meter }} kWh</span>
                    </div>
                </div>
            @else
                <div class="penggunaan-box">
                    <h4>Data Penggunaan</h4>
                    <p class="text-muted">Belum ada data penggunaan tersedia.</p>
                </div>
            @endif
        </div>
    </div>
@endsection