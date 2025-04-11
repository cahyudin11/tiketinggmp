@extends('layout.main')
@section('judul')
    <section class="content-header">
        <h1>
            Master Divisi
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Divisi</li>
        </ol>
    </section>
@endsection

@section('isi')
    <a href="{{ route('divisi') }}" class="btn btn-success mb-3">+ Tambah</a>
    <div class="box">
        <div class="box-body">
            @if (session('success') || session('error'))
                <div id="alert-box"
                    style="padding: 12px 20px;
               background-color: {{ session('success') ? '#d4edda' : '#f8d7da' }};
               color: {{ session('success') ? '#155724' : '#721c24' }};
               border-radius: 6px;
               margin-bottom: 15px;
               box-shadow: 0 2px 4px rgba(0,0,0,0.1);
               transition: opacity 0.5s ease;">
                    {{ session('success') ?? session('error') }}
                </div>

                <script>
                    setTimeout(function() {
                        const alertBox = document.getElementById('alert-box');
                        if (alertBox) {
                            alertBox.style.opacity = '0';
                            setTimeout(() => alertBox.remove(), 200);
                        }
                    }, 2000);
                </script>
            @endif

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($divisi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_divisi }}</td>
                            <td>
                                <div style="display: flex; justify-content: center; gap: 5px;">
                                    <a href="{{ route('editdivisi', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('hapusdivisi', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
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
