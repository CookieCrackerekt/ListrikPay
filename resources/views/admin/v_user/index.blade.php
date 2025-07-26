@extends('admin.v_layouts.app')

@section('content')
<!-- contentAwal -->
<div class="row">
    <div class="col-12">
        <a href="{{ route('user.create') }}">
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
                                <th>Username</th>
                                <th>Nama Admin</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->nama_admin }}</td>
                                    <td>
                                        @if ($row->id_level == 1)
                                            <span class="badge badge-info text-success">ADMIN</span>
                                        @elseif ($row->id_level == 2)
                                            <span class="badge badge-info text-success">PETUGAS</span>
                                        @else
                                            <span class="badge badge-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user.edit', $row->user_id) }}" title="Ubah Data">
                                            <button type="button" class="btn btn-cyan btn-sm">
                                                <i class="far fa-edit"></i> Ubah
                                            </button>
                                        </a>
                                        <form method="POST" action="{{ route('user.destroy', $row->user_id) }}"
                                              style="display: inline-block;">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                    data-konf-delete="{{ $row->nama_admin }}" title="Hapus Data">
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
