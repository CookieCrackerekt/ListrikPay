@extends('admin.v_layouts.app') 
@section('content') 
<!-- contentAwal -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <h5 class="card-title">{{ $judul }}</h5>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Selamat Datang, {{ Auth::user()->nama_admin }}</h4>
                    Anda login sebagai 
                    <b>
                        @if (Auth::user()->id_level == 1) Admin
                        @elseif(Auth::user()->id_level == 2) Petugas
                        @endif
                    </b> dalam Aplikasi Listik Pay.
                    <hr>
                    <p class="mb-0">
                        Akses fitur seperti <strong>Data Pelanggan</strong>, <strong>Penggunaan Listrik</strong>, <strong>Tagihan</strong>, dan <strong>Pembayaran</strong> dari menu navigasi.
                    </p>
                </div>

                <!-- Info Ringkasan -->
                <div class="row text-center mt-4">
                    <div class="col-md-3">
                        <div class="alert alert-primary">
                            <h4>{{ $jumlah_pelanggan ?? '0' }}</h4>
                            <p>Pelanggan</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert alert-info">
                            <h4>{{ $jumlah_penggunaan ?? '0' }}</h4>
                            <p>Data Penggunaan</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert alert-warning">
                            <h4>{{ $jumlah_tagihan ?? '0' }}</h4>
                            <p>Tagihan Aktif</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert alert-success">
                            <h4>{{ $jumlah_pembayaran ?? '0' }}</h4>
                            <p>Pembayaran</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> 
<!-- contentAkhir -->
@endsection
