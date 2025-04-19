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
      <form id="exportForm" action="{{ route('exportperbaikan') }}" method="POST" target="_blank">
          @csrf
          <input type="hidden" name="data" id="exportData">
          <button type="submit" class="btn btn-danger mb-3">Export PDF</button>
      </form>
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
              let table = $("#example1").DataTable(); // Inisialisasi DataTable

              // Event saat form export disubmit
              $('#exportForm').on('submit', function(e) {
                  e.preventDefault(); // Mencegah submit biasa

                  // Ambil data yang sedang ditampilkan di DataTable (yang difilter)
                  var rows = table.rows({
                      search: 'applied'
                  }).nodes();
                  var cleanData = [];

                  rows.each(function(row) {
                      var rowData = [];
                      $(row).find('td').each(function(index, td) {
                          // Jika kolom status, ambil nilai yang terpilih dari dropdown
                          if (index == 8) { // Kolom ke-8 (index ke-7) adalah kolom status
                              var status = $(td).find('select')
                                  .val(); // Ambil nilai yang dipilih dari select
                              rowData.push(status); // Menyimpan status yang dipilih
                          } else {
                              rowData.push($(td).text().trim()); // Ambil teks selain status
                          }
                      });
                      cleanData.push(rowData); // Menyimpan data setiap row
                  });

                  // Isi input hidden dengan data yang sudah diproses
                  $('#exportData').val(JSON.stringify(cleanData));

                  // Submit form setelah data diisi
                  this.submit();
              });
          });
      </script>
  @endsection
