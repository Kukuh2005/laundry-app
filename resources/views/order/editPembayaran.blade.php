<!-- Modal -->
@foreach($transaksi as $item)
<div class="modal fade" id="modal-edit{{$item->kode}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Rubah Status Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/{{auth()->user()->level}}/order/{{$item->id}}/update" method="POST" id="form-bayar">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" value="{{$item->kode}}"
                                readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-email">Status Pembayaran</label>
                        <div class="col-sm-10">
                            <select name="status_pembayaran" class="form-control" id="status_pembayaran_select"
                                onchange="toggleHidden()">
                                <option value="Belum Bayar"
                                    {{$item->status_pembayaran == 'Belum Bayar' ? 'selected' : ''}}>Belum Bayar</option>
                                <option value="Sudah Bayar"
                                    {{$item->status_pembayaran == 'Sudah Bayar' ? 'selected' : ''}}>Sudah Bayar</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3" id="bayar_kembali_row" hidden>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="col-sm-2 col-form-label">Total</label>
                                <h1 class="text-info float-end">{{$item->formatRupiah('total')}}</h1>
                                <h1 class="text-info float-end me-1">Rp</h1>
                                <input type="text" id="total" name="total" value="{{$item->total}}" hidden>
                            </div>
                        </div>
                        <label for="emailWithTitle" class="col-sm-2 col-form-label">Bayar</label>
                        <div class="col-sm-10 mb-0">
                            <input type="text" id="bayar" class="form-control" name="bayar">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary float-end" id="btn-simpan" onclick="cekBayar()">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
