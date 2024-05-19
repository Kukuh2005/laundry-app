<!-- Modal -->
@foreach($paket as $item)
<div class="modal fade" id="modal-edit{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Edit Paket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="m-4" action="/{{auth()->user()->level}}/paket/{{$item->id}}/update" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" name="nama"
                                placeholder="Contoh: Cuci Basah" value="{{$item->nama}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Jenis</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis" id="">
                                <option value="">Pilih Jenis</option>
                                <option value="kiloan" {{$item->jenis == "kiloan" ? 'selected' : ''}}>Kiloan</option>
                                <option value="satuan" {{$item->jenis == "satuan" ? 'selected' : ''}}>Satuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-email">Durasi(jam)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" name="durasi"
                                oninput="validasiInput(this)" placeholder="Contoh: 24, 48, 72" value="{{$item->durasi}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-email">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" name="harga"
                                oninput="validasiInput(this)" placeholder="Contoh: 5000, 4500" value="{{$item->harga}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach