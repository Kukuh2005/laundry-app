@extends('layout.app')

@section('title', 'Pelanggan')

@section('content-header', 'Data Pelanggan')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="btn-tambah float-end m-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-tambah">Tambah</button>
        </div>
        <div class="table-responsive text-nowrap mt-2 mb-2">
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Telepon</td>
                        <td>Alamat</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($pelanggan as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama_pelanggan}}</td>
                        <td>{{$item->telepon}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>
                            <form action="/pelanggan/{{$item->id}}/delete" id="delete-form">
                                @method('DELETE')
                                @csrf
                                <a href="/pelanggan/{{$item->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{$item->id}})">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('pelanggan.form')
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
