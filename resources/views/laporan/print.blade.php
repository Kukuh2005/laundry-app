<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            /* Adjust padding for better spacing */
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1,
        h3,
        .telepon {
            text-align: center;
            margin-bottom: -10;
        }

        .telepon {
            margin-bottom: 20;
        }

        p{
            margin-bottom: -10;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }

    </style>
</head>

<body>
    <h1>{{$outlet->nama}}</h1>
    <h3>{{$outlet->alamat}}</h3>
    <p class="telepon">{{$outlet->telepon}}</p>

    <p>{{$pelanggan->nama_pelanggan}}</p>
    <p>{{$pelanggan->telepon}}</p>
    <p>{{$pelanggan->alamat}}</p>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Pelanggan</th>
                <th>Paket</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Total</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi_detail as $item)
            <tr>
                <td>{{$item->kode}}</td>
                <td>{{$item->pelanggan->nama_pelanggan}}</td>
                <td>{{$item->Paket->nama}}</td>
                <td>{{$item->jumlah}}</td>
                <td>{{$item->status}}</td>
                <td>{{$item->total}}</td>
                <td>{{$item->keterangan}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
