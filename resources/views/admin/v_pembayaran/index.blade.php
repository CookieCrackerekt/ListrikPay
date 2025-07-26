@extends('admin.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="row">
        <div class="col-12">
            <a href="{{ route('pembayaran.cetak') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Cetak</button>
            </a>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $judul }}</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tagihan Bulan</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Biaya Admin</th>
                                    <th>Total Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->tagihan->penggunaan->pelanggan->nama_pelanggan ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $row->tagihan->penggunaan->bulan ?? '-' }} /
                                            {{ $row->tagihan->penggunaan->tahun ?? '-' }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($row->tgl_bayar)->format('d-m-Y') }}</td>
                                        <td>Rp {{ number_format($row->biaya_admin, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($row->total_bayar, 0, ',', '.') }}</td>
                                        <td>
                                            <form action="{{ route('pembayaran.destroy', $row->id_pembayaran) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger show_confirm"
                                                    data-konf-delete="{{ $row->tagihan->penggunaan->pelanggan->nama_pelanggan ?? '' }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection