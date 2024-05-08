@extends('layout.app')

@section('title', 'Order')

@section('content-header', 'Data Order')

@section('content')
<div class="col-md-12 mb-2">
    <div class="card">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="/order" class="btn btn-outline-primary">Belum Bayar ({{$belum_bayar->count()}})</a>
            <a href="/order/proses" class="btn btn-outline-primary">Proses ({{$proses->count()}})</a>
            <a href="/order/siap-ambil" class="btn btn-outline-primary">Siap Ambil ({{$siap_ambil->count()}})</a>
            <a href="/order/selesai" class="btn btn-outline-primary">Selesai ({{$selesai->count()}})</a>
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
                        <td>Paket</td>
                        <td>Tanggal Selesai</td>
                        <td>Status</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($transaksi as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->kode}}</td>
                        <td>{{$item->pelanggan->nama_pelanggan}}</td>
                        <td>{{$item->paket->nama}}</td>
                        <td>{{$item->tanggal_selesai}}</td>
                        <td>
                            @if($item->status == 'Proses')
                            <span class="badge bg-label-warning me-1">Proses</span>
                            @elseif($item->status == 'Siap Ambil')
                            <span class="badge bg-label-info me-1">Siap Ambil</span>
                            @elseif($item->status == 'Selesai')
                            <span class="badge bg-label-success me-1">Selesai</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modal-edit{{$item->kode}}">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('order.form')
@include('order.editStatus')
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });

    function validasiInput(inputElement) {
        // Membuang karakter angka dari nilai input
        inputElement.value = inputElement.value.replace(/\D/g, '');
    }

</script>
<script>
    function confirmDelete(id) {
        swal({
                title: 'Apa Anda Yakin ?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: "Batal",
                        value: null,
                        visible: true,
                        className: "btn-secondary",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Hapus",
                        value: true,
                        visible: true,
                        className: "btn-danger",
                        closeModal: true
                    }
                },
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    const form = document.getElementById('delete-form');
                    // Setelah pengguna mengkonfirmasi penghapusan, Anda bisa mengirim form ke server
                    form.action = '/pelanggan/' + id + '/delete'; // Ubah aksi form sesuai dengan ID yang sesuai
                    form.submit();
                }
            });
    }

</script>
@endpush
