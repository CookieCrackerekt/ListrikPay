@extends('admin.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('user.update', $edit->user_id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="row">
                                <!-- Foto -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        @if ($edit->foto)
                                            <img src="{{ asset('storage/img-user/' . $edit->foto) }}" class="foto-preview" width="100%">
                                        @else
                                            <img src="{{ asset('storage/img-user/img-default.jpg') }}" class="foto-preview" width="100%">
                                        @endif
                                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto()">
                                        @error('foto')
                                            <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form Fields -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select name="id_level" class="form-control @error('id_level') is-invalid @enderror">
                                            <option value="">- Pilih Level -</option>
                                            <option value="1" {{ old('id_level', $edit->id_level) == '1' ? 'selected' : '' }}>Admin</option>
                                            <option value="2" {{ old('id_level', $edit->id_level) == '2' ? 'selected' : '' }}>Petugas</option>
                                        </select>
                                        @error('id_level')
                                            <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" value="{{ old('username', $edit->username) }}"
                                            class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Masukkan Username">
                                        @error('username')
                                            <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Admin</label>
                                        <input type="text" name="nama_admin" value="{{ old('nama_admin', $edit->nama_admin) }}"
                                            class="form-control @error('nama_admin') is-invalid @enderror"
                                            placeholder="Masukkan Nama Admin">
                                        @error('nama_admin')
                                            <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Password Baru (opsional)</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Isi jika ingin mengganti password">
                                        @error('password')
                                            <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Konfirmasi Password Baru">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Perbaharui</button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection
