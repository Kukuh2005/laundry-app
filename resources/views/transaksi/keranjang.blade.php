<!-- Modal -->
<div class="modal fade" id="modal-keranjang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Keranjang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive text-nowrap mt-2 mb-2">
                    <table class="table table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Paket</td>
                                <td>Jumlah</td>
                                <td>Sub Total</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($keranjang as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->paket->nama}}</td>
                                <td>{{$item->jumlah}}</td>
                                <td>{{$item->formatRupiah('total')}}</td>
                                <td>
                                    <form action="/transaksi/{{$item->id}}/{{$pelanggan->id}}/delete" id="delete-form">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" >Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
