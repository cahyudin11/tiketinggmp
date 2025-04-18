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
    <div class="box box-warning">
        <div class="box-header with-border">
        </div>
        <form action="{{ route('tambahbarang') }}" method="POST">
            @csrf

            <div class="box-body">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="nama_barang" class="form-control" id="nama_barang" name="nama_barang"
                        placeholder="Masukan nama barang" required>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">Tambah</button>
                <a href="{{ route('barang') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
