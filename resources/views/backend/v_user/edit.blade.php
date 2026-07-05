@extends('backend.v_layouts.app')

@section('content')

<!-- contentAwal -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <form class="form-horizontal"
                    action="{{ route('backend.user.update', $user->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <h4 class="card-title">{{ $judul }}</h4>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label>

                                    <img class="foto-preview"
                                        src="{{ $user->foto ? asset('storage/img-user/' . $user->foto) : asset('backend/images/users/1.jpg') }}"
                                        alt="Preview Foto"
                                        style="max-width: 200px; display: block; margin-bottom: 10px;">

                                    <input type="file"
                                        name="foto"
                                        accept="image/*"
                                        class="form-control @error('foto') is-invalid @enderror"
                                        onchange="previewFoto()">

                                    @error('foto')
                                        <div class="invalid-feedback alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Hak Akses</label>

                                    <select name="role"
                                        class="form-control @error('role') is-invalid @enderror">
                                        <option value="" {{ old('role', $user->role) == '' ? 'selected' : '' }}>
                                            - Pilih Hak Akses -
                                        </option>
                                        <option value="1" {{ old('role', $user->role) == '1' ? 'selected' : '' }}>
                                            Super Admin
                                        </option>
                                        <option value="0" {{ old('role', $user->role) == '0' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                    </select>

                                    @error('role')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>

                                    <select name="status"
                                        class="form-control @error('status') is-invalid @enderror">
                                        <option value="" {{ old('status', $user->status) == '' ? 'selected' : '' }}>
                                            - Pilih Status -
                                        </option>
                                        <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>
                                            Aktif
                                        </option>
                                        <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>
                                            Nonaktif
                                        </option>
                                    </select>

                                    @error('status')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Nama</label>

                                    <input type="text"
                                        name="nama"
                                        value="{{ old('nama', $user->nama) }}"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        placeholder="Masukkan Nama">

                                    @error('nama')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Email</label>

                                    <input type="text"
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan Email">

                                    @error('email')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>HP</label>

                                    <input type="text"
                                        name="hp"
                                        value="{{ old('hp', $user->hp) }}"
                                        onkeypress="return hanyaAngka(event)"
                                        class="form-control @error('hp') is-invalid @enderror"
                                        placeholder="Masukkan Nomor HP">

                                    @error('hp')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('backend.user.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<!-- contentAkhir -->

<script>
function previewFoto() {
    const foto = document.querySelector('input[name="foto"]');
    const preview = document.querySelector('.foto-preview');
    const file = foto.files[0];

    if (!file) {
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };
    reader.readAsDataURL(file);
}

function hanyaAngka(event) {
    const charCode = event.which ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
@endsection