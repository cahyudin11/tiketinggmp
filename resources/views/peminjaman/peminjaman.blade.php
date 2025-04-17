@extends('layout.main')
@section('judul')
    <section class="content-header">
        <h1>
            Data Peminjaman Barang
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Peminjaman</li>
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
                        <th>Barang</th>
                        <th>Kontak</th>
                        <th>Dari</th>
                        <th>Sampai</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_tiket }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->divisi->nama_divisi }}</td>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td>{{ $item->kontak }}</td>
                            <td>{{ $item->dari }}</td>
                            <td>{{ $item->sampai }}</td>
                          
                            <td>
                                <form action="{{ route('admin.updateStatus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="menunggu antrian" {{ $item->status == 'menunggu antrian' ? 'selected' : '' }}>
                                            Menunggu Antrian
                                        </option>
                                        <option value="dalam peminjaman" {{ $item->status == 'dalam peminjaman' ? 'selected' : '' }}>
                                            Dipinjam
                                        </option>
                                        <option value="dikembalikan" {{ $item->status == 'dikembalikan' ? 'selected' : '' }}>
                                            Dikembalikan
                                        </option>
                                        <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>
                                            Ditolak
                                        </option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary mt-1">Ubah</button>
                                </form>
                            </td>
                            
                            <td>
                                <form action="{{ route('hapuspeminjaman', $item->id) }}" method="POST"
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
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@endsection
