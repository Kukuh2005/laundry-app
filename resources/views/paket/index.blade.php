@extends('layout.app')

@section('title', 'Paket')

@section('content-header', 'Data Paket')

@section('content')
<div class="col-md-10 mb-2">
    <div class="card">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="/paket" class="btn btn-outline-primary">Kiloan</a>
            <a href="/paket/satuan" class="btn btn-outline-primary">Satuan</a>
        </div>
    </div>
</div>
<div class="col-md-2 mb-2">
    <div class="card">
        <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#modal-tambah">Tambah</button>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="table-responsive text-nowrap mt-2 mb-2">
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Jenis</td>
                        <td>Harga</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($paket as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->jenis}}</td>
                        <td>{{$item->harga}}</td>
                        <td>
                            <form action="/paket/{{$item->id}}/delete">
                                @method('DELETE')
                                @csrf
                                <a href="/paket/{{$item->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{$item->id}})">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('paket.form')
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
