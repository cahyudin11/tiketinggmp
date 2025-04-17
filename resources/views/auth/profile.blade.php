@extends('layout.main')
@section('judul')
    <section class="content-header">
        <h1>
            Profile
        </h1>
    </section>
@endsection

@section('isi')
    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Foto -->
        <div class="form-group">
            <label>Foto Profil</label><br>
            <img src="{{ asset('storage/foto/' . Auth::user()->foto) }}" width="120" class="rounded"
                style="margin-bottom: 10px;">
            <input type="file" name="foto" class="form-control-file mb-2">
            <small class="text-muted">Format: jpg, jpeg, png. Maks 2MB</small>
        </div>


        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
