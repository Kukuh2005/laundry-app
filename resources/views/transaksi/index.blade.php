@extends('layout.app')

@section('title', 'Transaksi')

@section('content-header', 'Transaksi')

@section('content')
<div class="col-md-4">
    <div class="card">
        <form class="mt-3 ms-3" action="" method="post">
            <div class="row mb-3">
                <div class="col-sm-10">
                    <select class="form-control" name="pelanggan_id" id="">
                        <option value="">Pilih Pelanggan</option>

                        @php
                        $currentLetter = ''; // Menyimpan huruf depan saat ini
                        @endphp

                        @foreach($pelanggan as $item)
                        @php
                        $firstLetter = strtoupper(substr($item->nama_pelanggan, 0, 1)); // Mengambil huruf depan dan mengonversi menjadi huruf besar
                        @endphp

                        {{-- Jika huruf depan berbeda dari sebelumnya, tambahkan grup baru --}}
                        @if($firstLetter != $currentLetter)
                        @php
                        $currentLetter = $firstLetter;
                        @endphp
                        <optgroup label="{{$currentLetter}}">
                            @endif

                            <option value="{{$item->id}}">{{$item->nama_pelanggan}}</option>

                            {{-- Jika huruf depan berbeda dari huruf depan item berikutnya, tutup grup --}}
                            @php
                            $nextFirstLetter = isset($pelanggan[$loop->index + 1]) ?
                            strtoupper(substr($pelanggan[$loop->index + 1]->nama_pelanggan, 0, 1)) : '';
                            @endphp
                            @if($nextFirstLetter != $currentLetter)
                        </optgroup>
                        @endif
                        @endforeach
                    </select>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });

</script>
@endpush
