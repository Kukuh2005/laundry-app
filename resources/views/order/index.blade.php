@extends('layout.app')

@section('title', 'Order')

@section('content-header', 'Data Order')

@section('content')
<div class="col-md-12 mb-2">
    <div class="card">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="/{{auth()->user()->level}}/order" class="btn btn-outline-primary">Belum Bayar ({{$belum_bayar->count()}})</a>
            <a href="/{{auth()->user()->level}}/order/proses" class="btn btn-outline-primary">Proses ({{$proses->count()}})</a>
            <a href="/{{auth()->user()->level}}/order/siap-ambil" class="btn btn-outline-primary">Siap Ambil ({{$siap_ambil->count()}})</a>
            <a href="/{{auth()->user()->level}}/order/selesai" class="btn btn-outline-primary">Selesai ({{$selesai->count()}})</a>
        </div>
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
                        <td><span class="badge bg-label-danger me-1">{{$item->status_pembayaran}}</span></td>
                        <td>{{$item->user->name}}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-edit{{$item->kode}}">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('order.editPembayaran')
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

<script>
    function cekBayar(){
        var btn_simpan = document.getElementById('btn-simpan');
        var bayar = parseFloat(document.getElementById('bayar').value);
        var total = parseFloat(document.getElementById('total').value);
        var form = document.getElementById('form-bayar');

        if(bayar < total){
            iziToast.warning({
            title: 'Jumlah Bayar Kurang',
            position: 'topRight'
            });
        }else{
            form.submit();
        }
    }
</script>
@endpush
