@extends('admin.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $judul }}</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pelanggan</th>
                                    <th>Bulan / Tahun</th>
                                    <th>Jumlah Meter</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->penggunaan->pelanggan->nama_pelanggan ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $row->bulan ?? '-' }} / {{ $row->tahun ?? '-' }}</td>
                                        <td>{{ $row->jumlah_meter }}</td>
                                        <td>
                                            @if ($row->status == 'belum bayar')
                                                <span class="badge badge-info text-danger">BELUM BAYAR</span>
                                            @elseif ($row->status == 'lunas')
                                                <span class="badge badge-info text-success">LUNAS</span>
                                            @else
                                                <span class="badge badge-secondary">Tidak Diketahui</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('tagihan.edit', $row->id_tagihan) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-money-bill-wave"></i> Bayar
                                            </a>
                                            <form action="{{ route('tagihan.destroy', $row->id_tagihan) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger show_confirm"
                                                    data-konf-delete="{{ $row->penggunaan->pelanggan->nama_pelanggan ?? '' }}">
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