@extends('layout.app')

@section('title', 'Profile')

@section('content-header', 'Data Profile')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Detail Profile</h5>
        <!-- Account -->
        <div class="card-body">
            
        <hr class="my-0">
        <div class="card-body">
            <form action="/{{auth()->user()->level}}/profile/{{auth()->user()->id}}/update" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="firstName" class="form-label">Nama</label>
                        <input class="form-control" type="text" id="firstName" name="name" value="{{auth()->user()->name}}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" id="lastName" value="{{auth()->user()->email}}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Password Baru</label>
                        <input class="form-control" type="password" id="email" name="password_baru" placeholder="Opsional">
                    </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
</div>
@endsection
