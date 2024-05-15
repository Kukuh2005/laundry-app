@extends('layout.app')

@section('title', 'Paket')

@section('content-header', 'Edit Data Paket')

@section('content')
<div class="col-md-12">
    <div class="card">
        <form class="m-4" action="/{{auth()->user()->level}}/paket/{{$paket->id}}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" name="nama"
                        placeholder="Contoh: Cuci Basah" value="{{$paket->nama}}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Jenis</label>
                <div class="col-sm-10">
                    <select class="form-control" name="jenis" id="">
                        <option value="">Pilih Jenis</option>
                        <option value="kiloan" {{$paket->jenis == "kiloan" ? 'selected' : ''}}>Kiloan</option>
                        <option value="satuan" {{$paket->jenis == "satuan" ? 'selected' : ''}}>Satuan</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-email">Durasi(jam)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" name="durasi"
                        oninput="validasiInput(this)" placeholder="Contoh: 24, 48, 72" value="{{$paket->durasi}}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-email">Harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" name="harga"
                        oninput="validasiInput(this)" placeholder="Contoh: 5000, 4500" value="{{$paket->harga}}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-end">Simpan</button>
            @if($paket->jenis == "kiloan")
            <a href="/paket" class="btn btn-warning float-start"><-Kembali</a>
            @else($paket->jenis == "satuan")
            <a href="/paket/satuan" class="btn btn-warning float-start"><-Kembali</a>
            @endif
        </form>
    </div>
</div>
@endsection
@push('script')
<script>
    function validasiInput(inputElement) {
        // Membuang karakter angka dari nilai input
        inputElement.value = inputElement.value.replace(/\D/g, '');
    }
</script>
@endpush
