@extends('admin.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="row">
        <div class="col-12">
            <a href="{{ route('penggunaan.create') }}">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </button>
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
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Meter Awal</th>
                                    <th>Meter Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->pelanggan->nama_pelanggan ?? '-' }}</td>
                                        <td>{{ $row->bulan }}</td>
                                        <td>{{ $row->tahun }}</td>
                                        <td>{{ $row->meter_awal }}</td>
                                        <td>{{ $row->meter_akhir }}</td>
                                        <td>
                                            <a href="{{ route('penggunaan.edit', $row->id_penggunaan) }}" title="Ubah Data">
                                                <button type="button" class="btn btn-cyan btn-sm">
                                                    <i class="far fa-edit"></i> Update
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ route('penggunaan.destroy', $row->id_penggunaan) }}"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                    data-konf-delete="{{ $row->pelanggan->nama_pelanggan ?? '' }}"
                                                    title="Hapus Data">
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