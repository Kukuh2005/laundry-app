@extends('layout.app')

@section('title', 'Dashboard')

@section('content-header', 'Dashboard')

@section('content')
@if(auth()->user()->level == 'Karyawan')
<div class="col-md-12">
    <div class="card mb-2">
        <div class="d-flex align-items-end row">
            <div class="col-sm-8">
                <div class="card-body">
                    <h5 class="card-title text-primary">Selamat Datang {{auth()->user()->name}}! 🎉</h5>
                    <p class="mb-4">
                        Kamu Login Sebagai <span class="font-weight-bold">{{auth()->user()->level}}</span>
                    </p>
                </div>
            </div>
            <div class="col-sm-4 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User"
                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                        data-app-light-img="illustrations/man-with-laptop-light.png">
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(auth()->user()->level == 'Admin')
<div class="col-md-8">
    <div class="card mb-2">
        <div class="d-flex align-items-end row">
            <div class="col-sm-8">
                <div class="card-body">
                    <h5 class="card-title text-primary">Selamat Datang {{auth()->user()->name}}! 🎉</h5>
                    <p class="mb-4">
                        Kamu Login Sebagai <span class="font-weight-bold">{{auth()->user()->level}}</span>
                    </p>
                </div>
            </div>
            <div class="col-sm-4 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User"
                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                        data-app-light-img="illustrations/man-with-laptop-light.png">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="position: relative;">
                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                    <div class="card-title">
                        <h5 class="text-nowrap mb-2">Pendapatan</h5>
                        <span class="badge bg-label-warning rounded-pill">{{$bulan_ini}}</span>
                    </div>
                    <div class="mt-sm-auto">
                        <h1 class="mb-0 text-success">Rp {{$pendapatan_bulan}}</h1>
                    </div>
                </div>
                <div class="resize-triggers">
                    <div class="expand-trigger">
                        <div style="width: 669px; height: 115px;"></div>
                    </div>
                    <div class="contract-trigger"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="col-md-3">
    <div class="card mb-2">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <i class="fas fa-calendar-alt fa-lg text-primary"></i>
            </div>
            <span class="fw-semibold d-block mb-1">Order Selesai Hari Ini</span>
            <h3 class="card-title mb-2">{{$selesai_hari_ini->count()}}</h3>
            <a class="text-primary fw-semibold" href="#" data-bs-toggle="modal"
                data-bs-target="#selesai_hari_ini">Lihat</a>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card mb-2">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <i class="fas fa-spinner fa-lg text-warning"></i>
            </div>
            <span class="fw-semibold d-block mb-1">Order Proses</span>
            <h3 class="card-title mb-2">{{$proses->count()}}</h3>
            @if(auth()->user()->level == 'Karyawan')
            <a href="/order/proses" class="text-warning fw-semibold">Detail</a>
            @endif
            @if(auth()->user()->level == 'Admin')
            <a href="" class="text-warning fw-semibold" data-bs-toggle="modal" data-bs-target="#proses">Detail</a>
            @endif
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card mb-2">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <i class="fas fa-check fa-lg text-info"></i>
            </div>
            <span class="fw-semibold d-block mb-1">Siap Ambil</span>
            <h3 class="card-title mb-2">{{$siap_ambil->count()}}</h3>
            @if(auth()->user()->level == 'Karyawan')
            <a href="/order/siap-ambil" class="text-info fw-semibold">Detail</a>
            @endif
            @if(auth()->user()->level == 'Admin')
            <a href="" class="text-info fw-semibold" data-bs-toggle="modal" data-bs-target="#siap_ambil">Detail</a>
            @endif
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card mb-2">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <i class="fas fa-tasks fa-lg text-success"></i>
            </div>
            <span class="fw-semibold d-block mb-1">Order Selesai</span>
            <h3 class="card-title mb-2">{{$selesai->count()}}</h3>
            @if(auth()->user()->level == 'Karyawan')
            <a href="/order/selesai" class="text-success fw-semibold">Detail</a>
            @endif
            @if(auth()->user()->level == 'Admin')
            <a href="" class="text-success fw-semibold" data-bs-toggle="modal" data-bs-target="#selesai">Detail</a>
            @endif
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card mb-2">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <i class="fas fa-money-check-alt fa-lg text-danger"></i>
            </div>
            <span class="fw-semibold d-block mb-1">Belum Bayar</span>
            <h3 class="card-title mb-2">{{$belum_bayar->count()}}</h3>
            @if(auth()->user()->level == 'Karyawan')
            <a href="/order" class="text-danger fw-semibold">Detail</a>
            @endif
            @if(auth()->user()->level == 'Admin')
            <a href="" class="text-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#belum_bayar">Detail</a>
            @endif
        </div>
    </div>
</div>
@include('dashboard.hariIni')
@include('dashboard.belumBayar')
@include('dashboard.proses')
@include('dashboard.selesai')
@include('dashboard.siapAmbil')
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#table_selesai_hari_ini').DataTable();
    });

    $(document).ready(function () {
        $('#table_proses').DataTable();
    });

    $(document).ready(function () {
        $('#table_siap_ambil').DataTable();
    });

    $(document).ready(function () {
        $('#table_selesai').DataTable();
    });

    $(document).ready(function () {
        $('#table_belum_bayar').DataTable();
    });
</script>
@endpush