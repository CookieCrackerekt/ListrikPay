@extends('pelanggan.v_layouts.app')
@section('content')
    @include('pelanggan.v_layouts.navbar')
    @include('pelanggan.v_layouts.sidebar')
    <div class="app">
        <div class="content">
                <h1>Selamat Datang</h1>
                @auth('pelanggan')
                    <p>Hai, {{ Auth::guard('pelanggan')->user()->nama_pelanggan }}</p>
                @else
                    <p>Anda belum login sebagai pelanggan.</p>
                @endauth
                <p>Silakan gunakan navigasi di atas untuk menjelajahi fitur aplikasi.</p>
            </div>
        </div>
    </div>
@endsection