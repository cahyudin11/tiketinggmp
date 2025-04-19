<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT Tiketing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

        .form-check-input:checked {
            background-color: #c19528;
            border-color: #c19528;
        }

        .form-check-input:checked+.form-check-label {
            color: #c19528;
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
                    <a class="nav-link active" href="#">Pengajuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tiketing') }}">Lacak</a>
                </li>
            </ul>

            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Permintaan Berhasil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Pengajuan Tiket Anda berhasil dikirim! Kode Tiket: <strong id="kodeTiket"></strong><br>
                            Silahkan <strong>Salin Kode Tiket</strong> untuk tracking Tiket.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" style="background-color: #c19528; color: white;"
                                id="copyButton">Salin Kode Tiket</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('permintaan') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Tanggal *</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label>Nama Pemohon *</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap Anda" required>
                </div>

                <div class="form-group">
                    <label for="divisi_id">Pilih Divisi:</label>
                    <select name="divisi_id" id="divisiSelect" class="form-control" required>
                        <option value="" disabled selected>Pilih Divisi</option>
                        @foreach ($divisi as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="mb-3">
                    <label>Kontak Pemohon *</label>
                    <input type="text" name="kontak" class="form-control" placeholder="Contoh : 089654963859"
                        required>
                    <small class="form-text text-muted">Masukkan nomor WhatsApp Anda untuk mengetahui info update
                        terbaru!</small>
                </div>

                <div class="mb-3">
                    <label>Jenis Permintaan *</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_permintaan" value="Perbaikan"
                            id="perbaikan" required>
                        <label class="form-check-label" for="perbaikan">Perbaikan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_permintaan" value="Permintaan Barang"
                            id="permintaanbarang">
                        <label class="form-check-label" for="permintaanbarang">Permintaan Barang</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_permintaan" value="Peminjaman"
                            id="peminjaman">
                        <label class="form-check-label" for="peminjaman">Peminjaman</label>
                    </div>
                </div>


                <div id="perbaikan-form" style="display: none;">
                    <label>Detail Perbaikan*</label><br>
                    <textarea name="detail" class="form-control" placeholder="Masukkan detail perbaikan" rows="4" required></textarea>
                </div>

                <div id="permintaanbarang-form" style="display: none;">
                    <label>Nama Barang *</label>
                    <select id="barangPermintaanSelect" name="barang_id" class="form-control mb-2"
                        style="width: 100%">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_barang }}</option>
                        @endforeach
                    </select>

                    <label>Jumlah *</label>
                    <input type="number" name="quantity" class="form-control" min="1"
                        placeholder="Masukkan jumlah barang">
                    <label>keterangan *</label>
                    <textarea name="keterangan" class="form-control" placeholder="Masukkan barang digunakan untuk keperluan apa"
                        rows="4"></textarea>
                </div>
                <div id="peminjaman-form" style="display: none;">
                    <label>Nama Barang *</label>
                    <select id="barangPeminjamanSelect" name="barang_id_peminjaman" class="form-control mb-2"
                        style="width: 100%;">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_barang }}</option>
                        @endforeach
                    </select>

                    <label>Dari Tanggal *</label>
                    <input type="date" name="dari" class="form-control mb-2" value="{{ date('Y-m-d') }}"
                        required>

                    <label>Sampai Tanggal *</label>
                    <input type="date" name="sampai" class="form-control" required>

                    <label>Pilih Pengguna Approve *</label>
                    <select name="approve_user_id" class="form-control mb-2" required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Upload Foto</label>
                    <input type="file" name="photo" class="form-control">
                </div>

                <button type="submit">Kirim</button>
            </form>
        </div>
    </div>

    <footer class="text-center  mt-5">
        <p class="mb-0 py-3">&copy; 2025 PT.Gajah Mitra Paragon. All Rights Reserved.</p>
    </footer>

</body>
<!-- jQuery & Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Inisialisasi Select2 -->
<script>
    $(document).ready(function() {
        $('#barangPermintaanSelect').select2({
            placeholder: "-- Pilih Barang --",
            width: '100%'
        });

        $('#barangPeminjamanSelect').select2({
            placeholder: "-- Pilih Barang --",
            width: '100%'
        });

        $('#divisiSelect').select2({
            placeholder: "Pilih Divisi",
            width: '100%'
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radios = document.querySelectorAll('input[name="jenis_permintaan"]');
        const perbaikanForm = document.getElementById('perbaikan-form');
        const permintaanForm = document.getElementById('permintaanbarang-form');
        const detailTextarea = perbaikanForm.querySelector('textarea[name="detail"]');
        const barangSelect = permintaanForm.querySelector('select[name="barang_id"]');
        const quantityInput = permintaanForm.querySelector('input[name="quantity"]');
        const keteranganTextarea = permintaanForm.querySelector('textarea[name="keterangan"]');
        const peminjamanForm = document.getElementById('peminjaman-form');
        const barangPinjamSelect = peminjamanForm.querySelector('select[name="barang_id_peminjaman"]');
        const tanggalDari = peminjamanForm.querySelector('input[name="dari"]');
        const tanggalSampai = peminjamanForm.querySelector('input[name="sampai"]');
        const approveUserSelect = peminjamanForm.querySelector(
            'select[name="approve_user_id"]');

        function showFormByValue(value) {

            if (value === 'Perbaikan') {
                perbaikanForm.style.display = 'block';
                permintaanForm.style.display = 'none';
                peminjamanForm.style.display = 'none';

                detailTextarea.setAttribute('required', 'required');
                barangSelect.removeAttribute('required');
                quantityInput.removeAttribute('required');
                keteranganTextarea.removeAttribute('required');
                approveUserSelect.removeAttribute('required');

                barangPinjamSelect.removeAttribute('required');
                tanggalDari.removeAttribute('required');
                tanggalSampai.removeAttribute('required');


            } else if (value === 'Permintaan Barang') {
                perbaikanForm.style.display = 'none';
                permintaanForm.style.display = 'block';
                peminjamanForm.style.display = 'none';

                detailTextarea.removeAttribute('required');
                barangSelect.setAttribute('required', 'required');
                quantityInput.setAttribute('required', 'required');
                keteranganTextarea.setAttribute('required', 'required');
                approveUserSelect.removeAttribute('required');

                barangPinjamSelect.removeAttribute('required');
                tanggalDari.removeAttribute('required');
                tanggalSampai.removeAttribute('required');


            } else if (value === 'Peminjaman') {
                perbaikanForm.style.display = 'none';
                permintaanForm.style.display = 'none';
                peminjamanForm.style.display = 'block';

                detailTextarea.removeAttribute('required');
                barangSelect.removeAttribute('required');
                quantityInput.removeAttribute('required');
                keteranganTextarea.removeAttribute('required');
                approveUserSelect.setAttribute('required', 'required');

                barangPinjamSelect.setAttribute('required', 'required');
                tanggalDari.setAttribute('required', 'required');
                tanggalSampai.setAttribute('required', 'required');
            }
        }

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                showFormByValue(radio.value);
            });

            if (radio.checked) {
                showFormByValue(radio.value);
            }
        });
    });
</script>

<script>
    @if (session('success'))
        const kodeTiket = '{{ session('success') }}';
        document.getElementById('kodeTiket').textContent = kodeTiket;
        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
        myModal.show();
    @endif

    document.getElementById('copyButton').addEventListener('click', function() {

        const kodeTiket = document.getElementById('kodeTiket').textContent;

        navigator.clipboard.writeText(kodeTiket).then(function() {
            alert('Kode tiket berhasil disalin!');
        }).catch(function(err) {
            alert('Gagal menyalin kode tiket: ' + err);
        });
    });
</script>


</html>
