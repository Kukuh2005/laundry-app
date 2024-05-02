<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiSementara;
use App\Models\TransaksiDetail;
use App\Models\Pelanggan;
use App\Models\Paket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bayar(Request $request, $pelanggan_id)
    {
        $pelanggan = TransaksiSementara::where('pelanggan_id', $pelanggan_id)->get();

        $now = Carbon::now();
        $tanggal_sekarang = $now->year . "-" . $now->month . "-" . $now->day;

        $tahun_bulan = $now->year . $now->month;
        $cek = Transaksi::count();
        
        if($cek == 0){
            $urut = 10000001;
            $nomor = "NOTA-" . $tahun_bulan . $urut;
        }else {
            $ambil = Transaksi::all()->last();
            $urut = (int)substr($ambil->kode, -8) + 1;
            $nomor = "NOTA-" . $tahun_bulan . $urut;
        }

        if($request->status_pembayaran == "Belum Bayar"){
            $transaksi = new Transaksi;
            $transaksi->kode = $nomor;
            $transaksi->pelanggan_id = $pelanggan_id;
            $transaksi->tanggal = $tanggal_sekarang;
            $transaksi->total = $request->total;
            $transaksi->bayar = 0;
            $transaksi->kembali = 0;
            $transaksi->status = "proses";
            $transaksi->status_pembayaran = $request->status_pembayaran;
            $transaksi->user_id = 1;
            $transaksi->save();

            $transaksi_sementara = TransaksiSementara::where('pelanggan_id', $pelanggan_id)->get();

            foreach ($transaksi_sementara as $data) {
                $transaksi_detail = new TransaksiDetail;
                $transaksi_detail->kode = $nomor;
                $transaksi_detail->pelanggan_id = $data->pelanggan_id;
                $transaksi_detail->tanggal = $data->tanggal;
                $transaksi_detail->tanggal_selesai = $data->tanggal_selesai;
                $transaksi_detail->paket_id = $data->paket_id;
                $transaksi_detail->jumlah = $data->jumlah;
                $transaksi_detail->status = $data->status;
                $transaksi_detail->total = $data->total;
                $transaksi_detail->save();
            }

            foreach($transaksi_sementara as $data){
                $data->delete();
            }

            return redirect('transaksi')->with('sukses', 'Transaksi berhasil');
        }else{
            $transaksi = new Transaksi;
            $transaksi->kode = $nomor;
            $transaksi->pelanggan_id = $pelanggan_id;
            $transaksi->tanggal = $tanggal_sekarang;
            $transaksi->total = $request->total;
            $transaksi->bayar = $request->bayar;
            $transaksi->kembali = $request->kembali;
            $transaksi->status = "Proses";
            $transaksi->status_pembayaran = $request->status_pembayaran;
            $transaksi->user_id = 1;
            $transaksi->save();

            $transaksi_sementara = TransaksiSementara::where('pelanggan_id', $pelanggan_id)->get();

            foreach ($transaksi_sementara as $data) {
                $transaksi_detail = new TransaksiDetail;
                $transaksi_detail->kode = $nomor;
                $transaksi_detail->pelanggan_id = $data->pelanggan_id;
                $transaksi_detail->tanggal = $data->tanggal;
                $transaksi_detail->tangal_selesai = $data->tangal_selesai;
                $transaksi_detail->paket_id = $data->paket_id;
                $transaksi_detail->jumlah = $data->jumlah;
                $transaksi_detail->status = $data->status;
                $transaksi_detail->total = $data->total;
                $transaksi_detail->save();
            }

            foreach($transaksi_sementara as $data){
                $data->delete();
            }
        
            return redirect('transaksi')->with('sukses', 'Transaksi berhasil');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
