<!-- Modal -->
<div class="modal fade" id="siap_ambil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-info" id="exampleModalLabel">Order Siap Ambil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive text-nowrap mt-2 mb-2">
                    <table class="table table-striped" style="width: 100%" id="table_siap_ambil">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Kode</td>
                                <td>Pelanggan</td>
                                <td>Paket</td>
                                <td>Tanggal Selesai</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($siap_ambil as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->kode}}</td>
                                <td>{{$item->pelanggan->nama_pelanggan}}</td>
                                <td>{{$item->paket->nama}}</td>
                                <td>{{$item->tanggal_selesai}}</td>
                                <td>
                                    @if($item->status == 'Proses')
                                    <span class="badge bg-label-warning me-1">Proses</span>
                                    @elseif($item->status == 'Siap Ambil')
                                    <span class="badge bg-label-info me-1">Siap Ambil</span>
                                    @elseif($item->status == 'Selesai')
                                    <span class="badge bg-label-success me-1">Selesai</span>
                                    @endif
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
