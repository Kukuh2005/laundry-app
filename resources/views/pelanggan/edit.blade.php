<!-- Modal -->
@foreach($pelanggan as $item)
<div class="modal fade" id="modal-edit{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Edit Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="m-4" action="/{{ auth()->user()->level }}/pelanggan/{{$item->id}}/update" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" name="nama_pelanggan" value="{{$item->nama_pelanggan}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-email">Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" name="telepon" value="{{$item->telepon}}" oninput="validasiInput(this)" placeholder="Contoh: 0878****">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-email">Alamat</label>
                        <div class="col-sm-10">
                            <textarea id="basic-default-message" class="form-control" name="alamat" placeholder="Nama jalan, Rt, Rw, No rumah">{{$item->alamat}}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach