<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 12px;
        table-layout: auto;

    }

    th,
    td {
        padding: 6px;
        text-align: left;
        border: 1px solid #ddd;
        word-wrap: break-word;

    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }


    .table-container {
        overflow-x: auto;

        -webkit-overflow-scrolling: touch;
    }

    td {
        white-space: normal;

    }


    th,
    td {
        width: auto;

    }

    td {
        word-break: break-word;

    }
</style>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Tiket</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Detail</th>
                <th>Kontak</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row[1] }}</td>
                    <td>{{ $row[2] }}</td>
                    <td>{{ $row[3] }}</td>
                    <td>{{ $row[4] }}</td>
                    <td>{{ $row[5] }}</td>
                    <td>{{ $row[6] }}</td>
                    <td>{{ $row[8] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
