@extends('layout.main')
@section('judul')
    <section class="content-header">
        <h1>
            Edit Barang
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
@endsection

@section('isi')
    <div class="box box-warning">
        <div class="box-header with-border">
        </div>
        <form action="{{ route('updatebarang', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="box-body">
                <div class="mb-3">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}"
                        required>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('barang') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
