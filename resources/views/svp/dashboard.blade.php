@extends('layout.main')
@section('judul')
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
@endsection

@section('isi')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{ $totalPeminjaman }}</h3><sup style="font-size: 20px"></h3>
                    <h4>Peminjaman</h4>
                </div>
                <div class="icon">
                    <i class="ion-shuffle"></i>
                </div>
                <a href="{{ route('peminjaman') }}" class="small-box-footer">Peminjaman Barang <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
@endsection
