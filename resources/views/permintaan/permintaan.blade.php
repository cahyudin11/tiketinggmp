@extends('layout.main')
@section('judul')
    <section class="content-header">
        <h1>
            Data Permintaan Barang
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Permintaan</li>
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
                        <th>Quantity</th>
                        <th>Kontak</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($permintaan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_tiket }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->divisi->nama_divisi }}</td>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->kontak }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <form action="{{ route('admin.updateStatusper', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="sedang diajukan"
                                            {{ $item->status == 'sedang diajukan' ? 'selected' : '' }}>
                                            Sedang Diajukan
                                        </option>
                                        <option value="barang datang"
                                            {{ $item->status == 'barang datang' ? 'selected' : '' }}>
                                            Barang Datang
                                        </option>
                                        <option value="proses pemasangan"
                                            {{ $item->status == 'proses pemasangan' ? 'selected' : '' }}>
                                            Proses Pemasangan
                                        </option>
                                        <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary mt-1">Ubah</button>
                                </form>
                            </td>

                            <td>
                                <form action="{{ route('hapuspermintaan', $item->id) }}" method="POST"
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
