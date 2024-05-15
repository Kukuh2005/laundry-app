@extends('layout.app')

@section('title', 'Transaksi')

@section('content-header', 'Transaksi Edit')

@section('content')
<div class="col-md-12">
    <div class="card">
    <div class="btn-tambah m-2">
            <p class="card-header"><a href="/transaksi">Transaksi</a> / {{$kode}}</p>
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
                        <td>Status</td>
                        <td>Total</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($transaksi_detail as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->pelanggan_id}}</td>
                        <td>{{$item->tanggal_selesai}}</td>
                        <td>{{$item->paket_id}}</td>
                        <td>{{$item->jumlah}}</td>
                        <td>
                            <form action="/{{auth()->user()->level}}/transaksi/{{$item->id}}/{{$kode}}/update-status" id="form-edit-status-{{$item->id}}" method="POST">
                                @method('PUT')
                                @csrf
                                <select name="status" class="form-control">
                                    <option value="Proses" {{ $item->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="Siap Ambil" {{ $item->status == 'Siap Ambil' ? 'selected' : '' }}>Siap Ambil</option>
                                </select>
                            </form>
                        </td>
                        <td>{{$item->total}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" onclick="updateStatus({{$item->id}})">Simpan</button>
                        </td>
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

    function updateStatus($id){
        var form = document.getElementById('form-edit-status-' + $id);
        form.submit();
    }
</script>
@endpush