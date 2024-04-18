@extends('layout.app')

@section('title', 'Transaksi')

@section('content-header', 'Transaksi')

@section('content')
<div class="col-md-12">
    <div class="card">
        <form class="m-3" action="" method="post">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success mb-3" style="width: 100%" data-bs-toggle="modal" data-bs-target="#modal-tambah">Pelanggan Baru</button>
                    <button type="button" class="btn btn-primary" style="width: 100%">Keranjang</button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <label class="form-label" for="basic-default-message">Kode Transaksi</label>
                    <input type="text" class="form-control" name="kode" value="{{$nomor}}" id="" readonly>                       
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <select class="form-control" name="pelanggan_id" id="">
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($pelanggan as $item)
                                <option value="{{$item->id}}">{{$item->nama_pelanggan}}</option>
                                @endforeach
                            </select>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <select class="form-control" name="paket_id" id="">
                                <option value="">-- Pilih Paket --</option>
                                @foreach($paket as $item)
                                @if($item->jenis == 'kiloan')
                                <optgroup label="Paket Kiloan">
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                </optgroup>
                                @endif
                                @if($item->jenis == 'satuan')
                                <optgroup label="Paket Satuan">
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                </optgroup>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="text" name="tanggal" class="form-control" id="floatInput"
                                oninput="this.value = this.value.replace(/[^\d.]/g, '').replace(/(\..*)\./g, '$1');"
                                placeholder="Berat/Jumlah">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label" for="basic-default-name">Tanggal Masuk</label>
                            <input type="date" name="tanggal_selesai" class="form-control"
                                min="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label" for="basic-default-name">Tanggal Selesai</label>
                            <input type="date" name="jumlah" class="form-control" min="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row mb-3">
                        <label class="form-label" for="basic-default-message">Status</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="status" id="">
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="diambil">Diambil</option>
                            </select>
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
            <button type="submit" class="btn btn-primary float-end">Simpan</button>
        </form>
    </div>
</div>
@include('transaksi.formTambahPelanggan')
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });

</script>
@endpush
