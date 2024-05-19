<!-- Modal -->
@foreach($transaksi as $item)
<div class="modal fade" id="modal-detail{{$item->kode}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Detail | {{$item->kode}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive text-nowrap mt-2 mb-2">
                    <table class="table table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Pelanggan</td>
                                <td>Paket</td>
                                <td>Jenis</td>
                                <td>Jumlah</td>
                                <td>Total</td>
                                <td>Tanggal Selesai</td>
                                <td>Status</td>
                                <td>Keterangan</td>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $no = 1; ?>
                            @foreach($transaksi_detail as $data)
                            @if($data->kode == $item->kode)
                            <tr>
                                <td>
                                    <?php 
                                    echo($no);
                                    $no++;
                                    ?>
                                </td>
                                <td>{{$data->pelanggan->nama_pelanggan}}</td>
                                <td>{{$data->paket->nama}}</td>
                                <td><span class="badge bg-label-primary me-1">{{$data->paket->jenis}}</span></td>
                                <td>{{$data->jumlah}}</td>
                                <td>{{$data->formatRupiah('total')}}</td>
                                <td>{{$data->tanggal_selesai}}</td>
                                <td>
                                    @if($data->status == 'Proses')
                                    <span class="badge bg-label-warning me-1">Proses</span>
                                    @elseif($data->status == 'Siap Ambil')
                                    <span class="badge bg-label-info me-1">Siap Ambil</span>
                                    @elseif($data->status == 'Selesai')
                                    <span class="badge bg-label-success me-1">Selesai</span>
                                    @endif
                                </td>
                                <td>{{$data->keterangan}}</td>
                                <td></td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
