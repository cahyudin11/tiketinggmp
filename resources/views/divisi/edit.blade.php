@extends('layout.main')
@section('judul')
    <section class="content-header">
        <h1>
            Edit Divisi
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
        <form action="{{ route('updatedivisi', $divisi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="box-body">
                <div class="mb-3">
                    <label>Nama Divisi</label>
                    <input type="text" name="nama_divisi" class="form-control" value="{{ $divisi->nama_divisi }}"
                        required>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('formdivisi') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
