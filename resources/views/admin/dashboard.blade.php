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
              <div class="small-box bg-green">
                  <div class="inner">
                    <h3>{{ $totalPerbaikan }}</h3><sup style="font-size: 20px"></h3>
                     
                      <h4>Tiket</h4>
                  </div>
                  <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="{{ route('perbaikan') }}" class="small-box-footer">Tiketing <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>{{ $totalPermintaan }}</h3><sup style="font-size: 20px"></h3>
                      <h4>Permintaan</h4>
                  </div>
                  <div class="icon">
                      <i class="ion-plus-circled"></i>
                  </div>
                  <a href="{{ route('permintaan') }}" class="small-box-footer">Permintaan Barang <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div><!-- ./col -->
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
          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-gray">
                  <div class="inner">
                    <h3>{{ $totalBarang }}</h3><sup style="font-size: 20px"></h3>
                      <h4>Barang</h4>
                  </div>
                  <div class="icon">
                      <i class="ion-briefcase"></i>
                  </div>
                  <a href="{{ route('barang') }}" class="small-box-footer">Barang <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div><!-- ./col -->
          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                  <div class="inner">
                    <h3>{{ $totalBarang }}</h3><sup style="font-size: 20px"></h3>
                      <h4>Divisi</h4>
                  </div>
                  <div class="icon">
                      <i class="ion-person-stalker"></i>
                  </div>
                  <a href="{{ route('formdivisi') }}" class="small-box-footer">Divisi <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div><!-- ./col -->
         
  @endsection
