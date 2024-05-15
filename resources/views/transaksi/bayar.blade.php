<div class="modal fade" id="modal-bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="modalCenterTitle">Transaksi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/{{auth()->user()->level}}/transaksi/{{$pelanggan->id}}/bayar" method="POST" id="form-bayar">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Total</label>
                            <h1 class="text-info float-end">{{$total}}</h1>
                            <h1 class="text-info float-end me-1">Rp</h1>
                            <input type="text" id="total" name="total" value="{{$sub_total}}" hidden>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="emailWithTitle" class="form-label">Status Pembayaran</label>
                            <select name="status_pembayaran" class="form-control" id="status_pembayaran_select"
                                onchange="toggleHidden()">
                                <option value="Belum Bayar">Belum Bayar</option>
                                <option value="Sudah Bayar">Sudah Bayar</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3" id="bayar_kembali_row" hidden>
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Bayar</label>
                            <input type="text" id="bayar" class="form-control" name="bayar"
                                oninput="this.value = this.value.replace(/[^\d.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btn-simpan" class="btn btn-primary" onclick="cekBayar()">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
