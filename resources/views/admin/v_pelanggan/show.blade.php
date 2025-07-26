@extends('admin.v_layouts.app')
@section('content')
<!-- contentAwal -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $judul }}</h4>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nomor KWH</label>
                                <input type="text" class="form-control" value="{{ $show->nomor_kwh }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input type="text" class="form-control" value="{{ $show->nama_pelanggan }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" rows="3" disabled>{{ $show->alamat }}</textarea>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" value="{{ $show->username }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Tarif / Daya</label>
                                <input type="text" class="form-control"
                                    value="{{ $show->tarif->daya }} VA - Rp.{{ number_format($show->tarif->tarifperkwh, 0, ',', '.') }}/kWh"
                                    disabled>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="border-top">
                    <div class="card-body">
                        <a href="{{ route('pelanggan.index') }}">
                            <button type="button" class="btn btn-secondary">Kembali</button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- contentAkhir -->
@endsection
