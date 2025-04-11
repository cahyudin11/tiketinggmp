@extends('layout.main')
  @section('judul')
      <section class="content-header">
          <h1>
              Tambah Barang
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Tambah</li>
          </ol>
      </section>
  @endsection

  @section('isi')
  <form action="" method="POST">
    @csrf

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Barang</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="kode" class="form-label">Kode Barang</label>
        <input type="text" name="kode" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('barang') }}" class="btn btn-secondary">Kembali</a>
</form>

  @endsection
