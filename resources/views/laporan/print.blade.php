<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi {{$transaksi->pelanggan->nama_pelanggan}}</title>
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
    <h4 style="margin-bottom: -15;">{{$transaksi->kode}}</h4>
    <h4 style="float: right">{{$transaksi->user->name}}</h4>

    <p>{{$pelanggan->nama_pelanggan}}</p>
    <p>{{$pelanggan->telepon}}</p>
    <p>{{$pelanggan->alamat}}</p>

    <table>
        <thead>
            <tr>
                <th>Tanggal Selesai</th>
                <th>Paket</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Sub Total</th>  
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi_detail as $item)
            <tr>
                <td>{{$item->tanggal_selesai}}</td>
                <td>{{$item->Paket->nama}}</td>
                <td>{{$item->jumlah}}</td>
                @if($item->status == 'Selesai')
                <td style="background-color: blue; color: white; font-weight: bold;">{{$item->status}}</td>
                @elseif($item->status == 'Proses')
                <td style="background-color: orange; color: white; font-weight: bold;">{{$item->status}}</td>
                @elseif($item->status == 'Siap Ambil')
                <td style="background-color: skyBlue; color: white; font-weight: bold;">{{$item->status}}</td>
                @endif
                <td>{{$item->formatRupiah('total')}}</td>
            </tr>
            @endforeach
            <tr>
            <td colspan="4" style="background-color: grey; color: white; font-weight: bold;">Total</td>
                <td>{{$transaksi->formatRupiah('total')}}</td>
            </tr>
        </tbody>
    </table>
    <footer style="position: fixed; bottom: 0; background-color: blue; font-weight: bold; color: white; width: 100%;">
        <p style="margin: 5;">Terimakasih ~ <span>{{$outlet->nama}}</span></p>
    </footer>
</body>

</html>
