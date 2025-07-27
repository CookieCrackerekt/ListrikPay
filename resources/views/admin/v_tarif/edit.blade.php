@extends('admin.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('tarif.update', $edit->id_tarif) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="form-group">
                                <label>Daya (VA)</label>
                                <input type="number" name="daya" value="{{ old('daya', $edit->daya) }}"
                                    class="form-control @error('daya') is-invalid @enderror"
                                    placeholder="Masukkan daya dalam Watt">
                                @error('daya')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tarif per kWh (Rp)</label>
                                <input type="number" name="tarifperkwh" value="{{ old('tarifperkwh', $edit->tarifperkwh) }}"
                                    class="form-control @error('tarifperkwh') is-invalid @enderror"
                                    placeholder="Masukkan tarif per kWh dalam Rupiah">
                                @error('tarifperkwh')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Perbaharui</button>
                                <a href="{{ route('tarif.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection