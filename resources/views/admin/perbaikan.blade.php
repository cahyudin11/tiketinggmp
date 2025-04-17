  @extends('layout.main')
  @section('judul')
      <section class="content-header">
          <h1>
              Data Perbaikan
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Tiketing</li>
          </ol>
      </section>
  @endsection

  @section('isi')
      <div class="box">
          <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Kode Tiket</th>
                          <th>Tanggal</th>
                          <th>Nama</th>
                          <th>Divisi</th>
                          <th>Detail Kerusakan</th>
                          <th>Kontak</th>
                          <th>Photo</th>
                          <th>Status</th>
                          <th>Aksi</th>

                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($perbaikan as $item)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $item->kode_tiket }}</td>
                              <td>{{ $item->tanggal }}</td>
                              <td>{{ $item->nama }}</td>
                              <td>{{ $item->divisi->nama_divisi }}</td>
                              <td>{{ $item->detail }}</td>
                              <td>{{ $item->kontak }}</td>
                              <td class="text-center">
                                  @if ($item->photo)
                                      <!-- Gambar Kecil yang Dapat Diklik -->
                                      <a href="{{ asset('storage/' . $item->photo) }}" target="_blank">
                                          <img src="{{ asset('storage/' . $item->photo) }}" alt="Foto" width="80">
                                      </a>
                                  @else
                                      <span class="text-muted">Tidak ada foto</span>
                                  @endif
                              </td>
                              <td>
                                  <form action="{{ route('admin.updateStatustik', $item->id) }}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <select name="status" class="form-select form-select-sm">
                                          <option value="menunggu antrian"
                                              {{ $item->status == 'menunggu antrian' ? 'selected' : '' }}>
                                              Meununggu Antrian</option>
                                          <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>
                                              Ditolak</option>
                                          <option value="sedang dikerjakan"
                                              {{ $item->status == 'sedang dikerjakan' ? 'selected' : '' }}>
                                              Sedang dikerjakan</option>
                                          <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>
                                              Selesai</option>
                                      </select>
                                      <button type="submit" class="btn btn-sm btn-primary mt-1">Ubah</button>
                                  </form>
                              </td>
                              <td>
                                  <form action="{{ route('perbaikan.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus?')">
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
                  "lengthChange": false,
                  "searching": false,
                  "ordering": true,
                  "info": true,
                  "autoWidth": false
              });
          });
      </script>
  @endsection
