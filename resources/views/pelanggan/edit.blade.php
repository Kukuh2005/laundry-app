@extends('layout.app')

@section('title', 'Pelanggan')

@section('content-header', 'Edit Data Pelanggan')

@section('content')
<div class="col-md-12">
    <div class="card">
        <form class="m-4" action="/pelanggan/{{$pelanggan->id}}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" name="nama_pelanggan" value="{{$pelanggan->nama_pelanggan}}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-email">Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" name="telepon" value="{{$pelanggan->telepon}}"
                        oninput="validasiInput(this)" placeholder="Contoh: 0878****">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-email">Alamat</label>
                <div class="col-sm-10">
                    <textarea id="basic-default-message" class="form-control" name="alamat" placeholder="Nama jalan, Rt, Rw, No rumah">{{$pelanggan->alamat}}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-end">Simpan</button>
            <a href="/pelanggan" class="btn btn-warning float-start">
                <-Kembali</a> </form> </div> </div> @endsection @push('script') <script>
                    function validasiInput(inputElement) {
                    // Membuang karakter angka dari nilai input
                    inputElement.value = inputElement.value.replace(/\D/g, '');
                    }
                    </script>
                    @endpush
