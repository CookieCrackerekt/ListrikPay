@extends('admin.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="row">
        <div class="col-12">
            <a href="{{ route('tarif.create') }}">
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
                                    <th>Daya (VA)</th>
                                    <th>Tarif per kWh (Rp)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->daya }} VA</td>
                                        <td>Rp {{ number_format($row->tarifperkwh, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('tarif.edit', $row->id_tarif) }}" title="Ubah Data">
                                                <button type="button" class="btn btn-cyan btn-sm">
                                                    <i class="far fa-edit"></i> Ubah
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ route('tarif.destroy', $row->id_tarif) }}" style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                    data-konf-delete="{{ $row->daya }} Watt" title="Hapus Data">
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
