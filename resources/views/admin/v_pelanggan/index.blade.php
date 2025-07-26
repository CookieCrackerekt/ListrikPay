@extends('admin.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="row">
        <div class="col-12">
            <a href="{{ route('pelanggan.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $judul }} </h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor KWH</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Alamat</th>
                                    <th>Daya</th>
                                    <th>Tarif / KWH</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nomor_kwh }}</td>
                                        <td>{{ $row->nama_pelanggan }}</td>
                                        <td>{{ $row->alamat }}</td>
                                        <td>{{ $row->tarif->daya }} VA</td>
                                        <td>Rp. {{ number_format($row->tarif->tarifperkwh, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('pelanggan.edit', $row->id_pelanggan) }}"
                                                title="Ubah Data">
                                                <button type="button" class="btn btn-cyan btn-sm">
                                                    <i class="far fa-edit"></i> Ubah
                                                </button>
                                            </a>

                                            <a href="{{ route('pelanggan.show', $row->id_pelanggan) }}"
                                                title="Detail Data">
                                                <button type="button" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-plus"></i> Detail
                                                </button>
                                            </a>

                                            <form method="POST"
                                                action="{{ route('pelanggan.destroy', $row->id_pelanggan) }}"
                                                style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                    data-konf-delete="{{ $row->nama_pelanggan }}" title="Hapus Data">
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