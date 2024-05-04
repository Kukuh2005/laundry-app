<!-- Modal -->
@foreach($transaksi as $item)
<div class="modal fade" id="modal-edit{{$item->kode}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Edit Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/order/{{$item->id}}/update" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" value="{{$item->kode}}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-email">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control" id="">
                                <option value="Proses" {{$item->status == 'Proses' ? 'selected' : ''}}>Proses</option>
                                <option value="Siap Ambil" {{$item->status == 'Siap Ambil' ? 'selected' : ''}}>Siap Ambil</option>
                                <option value="Selesai" {{$item->status == 'Selesai' ? 'selected' : ''}}>Selesai</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach