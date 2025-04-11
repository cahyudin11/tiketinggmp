@extends('layout.main')
@section('judul')
    <section class="content-header">
        <h1>
            Tambah Divisi
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Divisi</li>
        </ol>
    </section>
@endsection

@section('isi')
    <div class="box box-warning">
        <div class="box-header with-border">
        </div>
        <form action="{{ route('tambahdivisi') }}" method="POST">
            @csrf

            <div class="box-body">
                <div class="form-group">
                    <label for="nama_divisi">Nama Divisi</label>
                    <input type="nama_divisi" class="form-control" id="nama_divisi" name="nama_divisi"
                        placeholder="Masukan nama divisi" required>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">Tambah</button>
                <a href="{{ route('formdivisi') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
