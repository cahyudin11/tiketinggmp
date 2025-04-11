@extends('layout.main')
  @section('judul')
      <section class="content-header">
          <h1>
              Master Barang
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Tiketing</li>
          </ol>
      </section>
  @endsection

  @section('isi')
   <a href="{{ route('tambahbarang') }}" class="btn btn-success mb-3">+ Tambah</a>
      <div class="box">
          <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($barang as $item)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $item->nama_barang }}</td>
                              <td>
                                <form action="{{ route('perbaikan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>

                          </tr>
                      @endforeach
              </table>
          </div>
      </div>
      <!-- DataTables -->
      <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('template/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
      <!-- page script -->
      <script>
          $(function() {
              $("#example1").DataTable();
              $('#example2').DataTable({
                  "paging": true,
                  "lengthChange": true,
                  "searching": false,
                  "ordering": true,
                  "info": true,
                  "autoWidth": false
              });
          });
      </script>
  @endsection
