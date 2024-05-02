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
                        <td>Status</td>
                        <td>Status Pembayaran</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($transaksi as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->kode}}</td>
                        <td>{{$item->pelanggan_id}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->status_pembayaran}}</td>
                        <td>
                            <form action="/transaksi/{{$item->id}}/delete" id="delete-form">
                                @method('DELETE')
                                @csrf
                                <a href="/transaksi/{{$item->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/transaksi/{{$item->kode}}/detail" class="btn btn-primary btn-sm" >Detail</a>
                            </form>
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
