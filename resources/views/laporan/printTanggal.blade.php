<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi {{$tanggal_dari}} Sampai {{$tanggal_sampai}}</title>
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
    <h1 style="color: blue">{{$outlet->nama}}</h1>
    <h3>{{$outlet->alamat}}</h3>
    <p class="telepon">{{$outlet->telepon}}</p>
    <h2 style="text-align: center">{{$tanggal_dari}} >>> {{$tanggal_sampai}}</h2>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Status</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $item)
            <tr>
                <td>{{$item->kode}}</td>
                <td>{{$item->tanggal}}</td>
                <td>{{$item->pelanggan->nama_pelanggan}}</td>
                @if($item->status_pembayaran == 'Sudah Bayar')
                <td style="background-color: green; color: white; font-weight: bold;">{{$item->status_pembayaran}}</td>
                @elseif($item->status_pembayaran == 'Belum Bayar')
                <td style="background-color: red; color: white; font-weight: bold;">{{$item->status_pembayaran}}</td>
                @endif
                <td>{{$item->formatRupiah('total')}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" style="background-color: grey; color: white; font-weight: bold;">Total</td>
                <td>{{$total}}</td>
            </tr>
        </tbody>
    </table>
    <footer style="position: fixed; bottom: 0; background-color: blue; font-weight: bold; color: white; width: 100%;">
        <p style="margin: 5;">Terimakasih ~ <span>{{$outlet->nama}}</span></p>
    </footer>
</body>

</html>
