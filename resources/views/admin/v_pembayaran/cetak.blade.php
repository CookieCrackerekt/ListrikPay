<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ccc;
    }

    table th, table td {
        border: 1px solid #ccc;
        padding: 6px;
        text-align: center;
        vertical-align: middle;
    }
</style>

<h4>{{ $judul }}</h4>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Bulan / Tahun</th>
            <th>Tanggal Bayar</th>
            <th>Biaya Admin</th>
            <th>Total Bayar</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cetak as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->tagihan->penggunaan->pelanggan->nama_pelanggan ?? '-' }}</td>
                <td>{{ $row->tagihan->penggunaan->bulan ?? '-' }} / {{ $row->tagihan->penggunaan->tahun ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tgl_bayar)->format('d-m-Y') }}</td>
                <td>Rp {{ number_format($row->biaya_admin, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($row->total_bayar, 0, ',', '.') }}</td>
                <td>
                    <span class="badge badge-success">Lunas</span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    window.onload = function () {
        window.print();
    }
</script>
