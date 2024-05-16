@extends('layout.app')

@section('title', 'User')

@section('content-header', 'Data User')

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
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Level</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($user as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        @if($item->level == 'Admin')
                        <td><span class="badge bg-label-info me-1">{{$item->level}}</span></td>
                        @elseif($item->level == 'Karyawan')
                        <td><span class="badge bg-label-success me-1">{{$item->level}}</span></td>
                        @else
                        <td><span class="badge bg-label-primary me-1">{{$item->level}}</span></td>
                        @endif
                        <td>
                            @if($item->level != 'Pemilik')
                            <form action="/{{auth()->user()->level}}/user/{{$item->id}}/delete" id="delete-form">
                                @method('DELETE')
                                @csrf
                                <a class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modal-edit{{$item->id}}">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{$item->id}})">Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('user.form')
@include('user.edit')
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
                    form.action = '/{{auth()->user()->level}}/user/' + id + '/delete'; // Ubah aksi form sesuai dengan ID yang sesuai
                    form.submit();
                }
            });
    }

</script>
@endpush
