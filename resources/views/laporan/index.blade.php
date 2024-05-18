@extends('layout.app')

@section('title', 'Laporan')

@section('content-header', 'Laporan')

@section('content')
<div class="col-md-12">
    <div class="card mb-2">
        <form action="/{{auth()->user()->level}}/laporan/cari" method="GET" id="form-cari-print">
            <div class="row m-2">
                @csrf
                <div class="col-md-4 d-flex mb-2 mt-2">
                    <label class="form-label m-3" for="basic-default-message">Dari</label>
                    <input type="date" class="form-control" name="tanggal_dari" id="tanggal-dari" value="{{$tanggal_dari}}"
                        max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-4 d-flex mb-2 mt-2">
                    <label class="form-label m-3" for="basic-default-message">Sampai</label>
                    <input type="date" class="form-control" name="tanggal_sampai" id="tanggal-sampai" value="{{$tanggal_sampai}}"
                        max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-4 mb-2 mt-2 d-flex">
                    <button type="submit" class="btn btn-success btn-lg me-2" style="width: 100%"><i
                            class="fas fa-search"></i> Cari</button>
                    <button type="button" onclick="printTanggal()" class="btn btn-danger btn-lg" style="width: 100%"><i
                            class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="table-responsive text-nowrap mt-2 mb-2">
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode</td>
                        <td>Pelanggan</td>
                        <td>Total</td>
                        <td>Status Pembayaran</td>
                        <td>Karyawan</td>
                        <td>Tanggal</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($transaksi as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->kode}}</td>
                        <td>{{$item->pelanggan->nama_pelanggan}}</td>
                        <td>{{$item->formatRupiah('total')}}</td>
                        <td>
                            @if($item->status_pembayaran == 'Belum Bayar')
                            <span class="badge bg-label-danger me-1">{{$item->status_pembayaran}}</span>
                            @elseif($item->status_pembayaran == 'Sudah Bayar')
                            <span class="badge bg-label-success me-1">{{$item->status_pembayaran}}</span>
                            @endif
                        </td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->tanggal}}</td>
                        <td>
                            <!-- <a href="/transaksi/{{$item->kode}}/edit" class="btn btn-warning btn-sm d-block m-2">Edit</a> -->
                            <a href="#" class="btn btn-primary btn-sm d-block mb-2"  data-bs-toggle="modal" data-bs-target="#modal-detail{{$item->kode}}">Detail</a>
                            <a href="/{{auth()->user()->level}}/laporan/{{$item->kode}}/print" target="_blank" class="btn btn-danger btn-sm d-block">Print</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('laporan.detail')
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
<script>
    function printTanggal(){
        var tanggal_dari = document.getElementById('tanggal-dari').value;
        var tanggal_sampai = document.getElementById('tanggal-sampai').value;

        window.open('/{{auth()->user()->level}}/laporan/' + tanggal_dari + '/' + tanggal_sampai + '/print', '_blank');
    }
</script>
@endpush
