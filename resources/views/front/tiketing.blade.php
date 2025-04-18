<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT Tiketing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: #ffffff;">
    <style>
        .nav-tabs .nav-link {
            color: #c19528;
            border: none;
            border-bottom: 3px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: #fff;
            background-color: #c19528;
            border-radius: 0.375rem 0.375rem 0 0;
            border-color: transparent;
        }

        button[type="submit"] {
            background-color: #c19528;
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 20px;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            width: 100%;

        }
    </style>

    <div class="container mt-4">
        <div class="bg-white p-4 rounded shadow-lg mx-auto" style="max-width: 600px;">
            <div class="text-center mb-3">
                <img src="{{ asset('photo/logo.png') }}" alt="Logo" height="130">
                <h3 class="mt-2" style="color: #c19528;"><strong>IT</strong> Tiketing</h3>
                <p>Mengotomatiskan, Sesuaikan, Prioritaskan. Tiket kami membantu Anda menyelesaikan <strong>permasalahan
                        anda yang berkaitan dengan IT.</strong></p>
            </div>

            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('form') }}">Pengajuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('tiketing') }}">Lacak</a>
                </li>
            </ul>


            <form method="POST" action="{{ route('lacak') }}">
                @csrf
                <div class="mb-3">
                    <label for="kode_tiket">Nomor Permintaan*</label>
                    <input type="text" name="kode_tiket" id="kode_tiket" class="form-control"
                        placeholder="Masukkan nomor Permintaan" required>
                </div>
                <button type="submit">Lacak Status</button>
            </form>

            @if (isset($data))
                <hr>
                <div class="card shadow-lg mt-4 p-4">
                    <h4 class="text-center">Status Tiket: {{ $data->kode_tiket }}</h4>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="status-icon mb-3">
                                    @if ($data->status == 'selesai')
                                        <i class="fas fa-check-circle fa-3x text-success"></i>
                                    @elseif ($data->status == 'menunggu antrian')
                                        <i class="fas fa-cogs fa-3x text-warning"></i>
                                    @elseif ($data->status == 'ditolak')
                                        <i class="fas fa-times-circle fa-3x text-danger"></i>
                                    @elseif ($data->status == 'sedang dikerjakan')
                                        <i class="fas fa-tools fa-3x text-info"></i>
                                    @endif
                                </div>
                                <div class="status-info mb-3">
                                    <p class="status-text fs-5">
                                        <span
                                            class="badge bg-{{ $data->status == 'selesai'
                                                ? 'success'
                                                : ($data->status == 'menunggu antrian'
                                                    ? 'warning'
                                                    : ($data->status == 'ditolak'
                                                        ? 'danger'
                                                        : 'info')) }}">
                                            {{ ucfirst($data->status) }}
                                        </span>
                                    </p>
                                </div>

                                <div class="text-center">
                                    <p><strong>Nama:</strong> {{ $data->nama }}</p>
                                    <p><strong>Kontak:</strong> {{ $data->kontak }}</p>

                                    @if ($jenis === 'perbaikan')
                                        <p><strong>Detail:</strong> {{ $data->detail }}</p>
                                    @elseif ($jenis === 'permintaan')
                                        <p><strong>Barang:</strong> {{ $data->barang->nama_barang ?? '-' }}</p>
                                        <p><strong>Jumlah:</strong> {{ $data->quantity }}</p>
                                        <p><strong>Keterangan:</strong> {{ $data->keterangan }}</p>
                                    @elseif ($jenis === 'peminjaman')
                                        <p><strong>Barang yang dipinjam:</strong>
                                            {{ $data->barang->nama_barang ?? '-' }}</p>
                                        <p><strong>Tanggal Peminjaman:</strong> {{ $data->dari }}</p>
                                        <p><strong>Tanggal Kembali:</strong> {{ $data->sampai }}</p>
                                    @elseif ($jenis === 'peminjaman')
                                        <p><strong>Barang yang dipinjam:</strong>
                                            {{ $data->barang->nama_barang ?? '-' }}</p>
                                        <p><strong>Tanggal Peminjaman:</strong> {{ $data->dari }}</p>
                                        <p><strong>Tanggal Kembali:</strong> {{ $data->sampai }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <footer class="text-center mt-5">
                <p class="mb-0 py-3">&copy; 2025 PT.Gajah Mitra Paragon. All Rights Reserved.</p>
            </footer>

</body>

</html>
