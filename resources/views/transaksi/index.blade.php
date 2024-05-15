@extends('layout.app')

@section('title', 'Transaksi')

@section('content-header', 'Transaksi')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="btn-tambah m-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-tambah">Tambah</button>
        </div>
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
                        <td>
                            <!-- <a href="/transaksi/{{$item->kode}}/edit" class="btn btn-warning btn-sm d-block m-2">Edit</a> -->
                            <a href="/{{auth()->user()->level}}/transaksi/{{$item->kode}}/detail" class="btn btn-primary btn-sm d-block" >Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('transaksi.formPelanggan')
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
    $(document).ready(function () {
        $('#table-pelanggan').DataTable();
    });
</script>
@endpush
