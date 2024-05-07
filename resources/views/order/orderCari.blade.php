<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry App</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome/css/all.min.css')}}">

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/izitoast/css/iziToast.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    <style>
        .mask-custom {
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, .15);
        }

        .navbar-brand {
            font-size: 1.75rem;
            letter-spacing: 3px;
        }

    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme sticky-top"
                    id="layout-navbar">
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a href="/" class="app-brand-text demo menu-text fw-bolder ms-2 text-primary">Laundry
                                    App</a>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper mb-5">
                    <!-- / Layout wrapper -->
                    <div class="container px-4 px-lg-5 h-100">
                        <div class="row mt-5 align-items-center justify-content-center text-center">
                            <div class="col-lg-8 align-self-end">
                                @foreach($transaksi as $item)
                                <h1 class="text-white font-weight-bold text-primary">
                                    {{$item->pelanggan->nama_pelanggan}} | {{$item->status_pembayaran}}</h1>
                                @endforeach
                                <hr class="divider">
                                <p class="text-white-75 mb-3"><a href="/">Home</a> / cek-order</p>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($transaksi_detail as $item)
                                    <div class="col-md-4">
                                        <div class="card m-2 rounded shadow">
                                            <div class="row">
                                                <label class=" col-form-label text-end bg-secondary text-white"
                                                    for="basic-default-company" style="width: 50%">Kode</label>
                                                <label class=" col-form-label text-start"
                                                    style="width: 50%">{{$item->kode}}</label>
                                                <label class="col-form-label text-end bg-secondary text-white"
                                                    for="basic-default-company" style="width: 50%">Nama Pelanggan</label>
                                                <label
                                                    class="col-form-label text-start" style="width: 50%">{{$item->pelanggan->nama_pelanggan}}</label>
                                                <label class="col-form-label text-end bg-secondary text-white"
                                                    for="basic-default-company" style="width: 50%">Estimasi Selesai</label>
                                                <label
                                                    class="col-form-label text-start" style="width: 50%">{{$item->tanggal_selesai}}</label>
                                                <label class="col-form-label text-end bg-secondary text-white"
                                                    for="basic-default-company" style="width: 50%">Paket</label>
                                                <label class="col-form-label text-start" style="width: 50%">{{$item->paket->nama}}</label>
                                                <label class="col-form-label text-end bg-secondary text-white"
                                                    for="basic-default-company" style="width: 50%">Jumlah</label>
                                                <label class="col-form-label text-start" style="width: 50%">{{$item->jumlah}}</label>
                                                <label class="col-form-label text-end bg-secondary text-white"
                                                    for="basic-default-company" style="width: 50%">Total</label>
                                                <label
                                                    class="col-form-label text-start" style="width: 50%">{{$item->formatRupiah('total')}}</label>
                                                <label class="col-form-label text-end bg-secondary text-white"
                                                    for="basic-default-company" style="width: 50%">Status</label>
                                                @if($item->status == "Proses")
                                                <label
                                                    class="col-form-label text-start text-warning" style="width: 50%">{{$item->status}}</label>
                                                @elseif($item->status == "Siap Ambil")
                                                <label
                                                    class="col-form-label text-start text-info" style="width: 50%">{{$item->status}}</label>
                                                @else
                                                <label
                                                    class="col-form-label text-start text-success" style="width: 50%">{{$item->status}}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layout.footer')
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <div class="buy-now">
      <a
        href="https://wa.me/62+087743055636"
        target="_blank"
        class="btn btn-success btn-buy-now"
        ><i class="fab fa-whatsapp"></i> WhatsApp</a
      >
    </div>
    <script src="{{asset('assets/vendor/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });

    </script>
</body>

</html>
