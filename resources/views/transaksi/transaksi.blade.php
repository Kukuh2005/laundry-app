@extends('layout.app')

@section('title', 'Transaksi')

@section('content-header', 'Transaksi')

@section('content')
<div class="col-md-12">
    <div class="card">
        <form class="m-3" action="/transaksi/{{$pelanggan->id}}/store" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-primary" style="width: 100%" data-bs-toggle="modal" data-bs-target="#modal-keranjang">Keranjang ({{$keranjang->count()}})</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <h1 class="card-title text-info">{{$pelanggan->nama_pelanggan}}</h1>
                            <p class="mb-4">{{$pelanggan->telepon}}</p>
                            <select class="form-control" name="pelanggan_id" id="" hidden>
                                <option value="{{$pelanggan->id}}">{{$pelanggan->nama_pelanggan}}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <h1 class="text-info float-end">{{$total}}</h1>
                            <h1 class="text-info float-end me-1">Rp</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label" for="basic-default-name">Paket</label>
                            <select class="form-control" name="paket_id" id="">
                                <option value="">-- Pilih Paket --</option>
                                @foreach($paket as $item)
                                @if($item->jenis == 'kiloan')
                                <optgroup label="Paket Kiloan">
                                    <option value="{{$item->id}}">{{$item->nama}} ({{$item->formatRupiah('harga')}})</option>
                                </optgroup>
                                @endif
                                @if($item->jenis == 'satuan')
                                <optgroup label="Paket Satuan">
                                    <option value="{{$item->id}}">{{$item->nama}} ({{$item->formatRupiah('harga')}})</option>
                                </optgroup>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label" for="basic-default-name">Berat/Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" oninput="this.value = this.value.replace(/[^\d.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="contoh : 4.5/5">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label" for="basic-default-name">Estimasi Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" min="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row mb-3">
                        <label class="form-label" for="basic-default-message">Keterangan</label>
                        <div class="col-sm-12">
                            <textarea id="basic-default-message" class="form-control" name="keterangan"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
            @if($total != 0)
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modal-bayar">Simpan</button>
            @endif
        </form>
    </div>
</div>
@include('transaksi.keranjang')
@include('transaksi.bayar')
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });

    function toggleHidden() {
        var select = document.getElementById('status_pembayaran_select');
        var row = document.getElementById('bayar_kembali_row');
        
        if (select.value === 'Sudah Bayar') {
            row.removeAttribute('hidden');
        } else {
            row.setAttribute('hidden', 'true');
        }
    }
</script>
@endpush
