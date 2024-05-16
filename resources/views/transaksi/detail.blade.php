@extends('layout.app')

@section('title', 'Transaksi')

@section('content-header', 'Transaksi Detail')

@section('content')
<div class="col-md-12">
    <div class="card">
    <div class="btn-tambah m-2">
            <p class="card-header"><a href="/{{auth()->user()->level}}/transaksi">Transaksi</a> / {{$kode}}</p>
        </div>
        <div class="table-responsive text-nowrap mt-2 mb-2">
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Pelanggan</td>
                        <td>Tanggal Selesai</td>
                        <td>Paket</td>
                        <td>jumlah</td>
                        <td>Total</td>
                        <td>Status</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($transaksi_detail as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->pelanggan->nama_pelanggan}}</td>
                        <td>{{$item->tanggal_selesai}}</td>
                        <td>{{$item->paket->nama}}</td>
                        <td>{{$item->jumlah}}</td>
                        <td>{{$item->total}}</td>
                        <td>@if($item->status == 'Proses')
                            <span class="badge bg-label-warning me-1">Proses</span>
                            @elseif($item->status == 'Siap Ambil')
                            <span class="badge bg-label-info me-1">Siap Ambil</span>
                            @elseif($item->status == 'Selesai')
                            <span class="badge bg-label-success me-1">Selesai</span>
                            @endif</td>
                        <td>{{$item->keterangan}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
@endpush