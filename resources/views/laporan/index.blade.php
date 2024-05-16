@extends('layout.app')

@section('title', 'Laporan')

@section('content-header', 'Laporan')

@section('content')
<div class="col-md-12">
    <div class="card mb-2">
        <form action="/{{auth()->user()->level}}/laporan/cari" method="GET">
            <div class="row m-2">
                @csrf
                <div class="col-md-5 d-flex mb-2 mt-2">
                    <label class="form-label m-3" for="basic-default-message">Dari</label>
                    <input type="date" class="form-control" name="tanggal_dari" id="" value="{{$tanggal_dari}}"
                        max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-5 d-flex mb-2 mt-2">
                    <label class="form-label m-3" for="basic-default-message">Sampai</label>
                    <input type="date" class="form-control" name="tanggal_sampai" id="" value="{{$tanggal_sampai}}"
                        max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-2 mb-2 mt-2">
                    <button type="submit" class="btn btn-success btn-lg" style="width: 100%"><i
                            class="fas fa-search"></i> Cari</button>
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
                            <a href="#" class="btn btn-primary btn-sm d-block"  data-bs-toggle="modal" data-bs-target="#modal-detail{{$item->kode}}">Detail</a>
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
@endpush
