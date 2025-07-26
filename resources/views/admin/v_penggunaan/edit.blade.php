@extends('admin.v_layouts.app')

@section('content')
<!-- contentAwal -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('penggunaan.update', $penggunaan->id_penggunaan) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">{{ $judul }}</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Pilih Pelanggan -->
                                <div class="form-group">
                                    <label>Pelanggan</label>
                                    {{-- Tampilkan nama pelanggan (readonly) --}}
                                    <input type="text" class="form-control"
                                        value="{{ $penggunaan->pelanggan->nama_pelanggan }} - {{ $penggunaan->pelanggan->nomor_kwh }}"
                                        readonly>
                                    {{-- Tetap kirim id_pelanggan ke server --}}
                                    <input type="hidden" name="id_pelanggan" value="{{ $penggunaan->id_pelanggan }}">
                                </div>

                                <!-- Tahun -->
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="number" name="tahun" value="{{ old('tahun', $penggunaan->tahun) }}"
                                        class="form-control @error('tahun') is-invalid @enderror">
                                    @error('tahun')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Bulan -->
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select name="bulan" class="form-control @error('bulan') is-invalid @enderror">
                                        <option value="">- Pilih Bulan -</option>
                                        @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bln)
                                        <option value="{{ $bln }}" {{ old('bulan', $penggunaan->bulan) == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                                        @endforeach
                                    </select>
                                    @error('bulan')
                                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Meter Awal -->
                                <div class="form-group">
                                    <label>Meter Awal</label>
                                    <div class="input-group">
                                        <input type="number" id="meter_awal" name="meter_awal"
                                            value="{{ old('meter_awal', $penggunaan->meter_awal) }}" readonly
                                            class="form-control @error('meter_awal') is-invalid @enderror">
                                        <div class="input-group-append">
                                            <button type="button" id="toggleMeterAwalBtn" class="btn btn-warning" onclick="toggleMeterAwal()">Edit</button>
                                        </div>
                                    </div>
                                    @error('meter_awal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Meter Akhir -->
                                <div class="form-group">
                                    <label>Meter Akhir</label>
                                    <input type="number" name="meter_akhir"
                                        value="{{ old('meter_akhir', $penggunaan->meter_akhir) }}"
                                        class="form-control @error('meter_akhir') is-invalid @enderror">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Perbaharui</button>
                            <a href="{{ route('penggunaan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleMeterAwal() {
        const input = document.getElementById('meter_awal');
        const btn = document.getElementById('toggleMeterAwalBtn');

        if (input.hasAttribute('readonly')) {
            input.removeAttribute('readonly');
            input.focus();
            btn.textContent = 'Kunci';
            btn.classList.remove('btn-warning');
            btn.classList.add('btn-secondary');
        } else {
            input.setAttribute('readonly', true);
            btn.textContent = 'Edit';
            btn.classList.remove('btn-secondary');
            btn.classList.add('btn-warning');
        }
    }
</script>
<!-- contentAkhir -->
@endsection