<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiSementara;
use App\Models\TransaksiDetail;
use App\Models\Pelanggan;
use App\Models\Paket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
            $kembali = $request->bayar - $request->total;
            
            $transaksi = new Transaksi;
            $transaksi->kode = $nomor;
            $transaksi->pelanggan_id = $pelanggan_id;
            $transaksi->tanggal = $now;
            $transaksi->total = $request->total;
            $transaksi->bayar = 0;
            $transaksi->kembali = 0;
            $transaksi->status_pembayaran = $request->status_pembayaran;
            $transaksi->user_id = Auth()->user()->id;
            $transaksi->save();

            $transaksi_sementara = TransaksiSementara::where('pelanggan_id', $pelanggan_id)->get();

            $now = Carbon::now();
            
            foreach ($transaksi_sementara as $data) {
                $paket = Paket::find($data->paket_id);
                
                $tanggal_selesai = $now->addHours($paket->durasi);
                
                $transaksi_detail = new TransaksiDetail;
                $transaksi_detail->kode = $nomor;
                $transaksi_detail->pelanggan_id = $data->pelanggan_id;
                $transaksi_detail->tanggal = $now;
                $transaksi_detail->tanggal_selesai = $tanggal_selesai;
                $transaksi_detail->paket_id = $data->paket_id;
                $transaksi_detail->jumlah = $data->jumlah;    
                $transaksi_detail->status = "Proses";    
                $transaksi_detail->total = $data->total;
                $transaksi_detail->keterangan = $data->keterangan;
                $transaksi_detail->save();
            }

            foreach($transaksi_sementara as $data){
                $data->delete();
            }
            
            return redirect(auth()->user()->level . '/transaksi')->with('sukses', 'Transaksi berhasil');
        }else{
            $kembali = $request->bayar - $request->total;

            $transaksi = new Transaksi;
            $transaksi->kode = $nomor;
            $transaksi->pelanggan_id = $pelanggan_id;
            $transaksi->tanggal = $now;
            $transaksi->total = $request->total;
            $transaksi->bayar = $request->bayar;
            $transaksi->kembali = $kembali;
            $transaksi->status_pembayaran = $request->status_pembayaran;
            $transaksi->user_id = Auth()->user()->id;
            $transaksi->save();

            $transaksi_sementara = TransaksiSementara::where('pelanggan_id', $pelanggan_id)->get();
            
            foreach ($transaksi_sementara as $data) {
                $paket = Paket::find($data->paket_id);
                
                $tanggal_selesai = $now->addHours($paket->durasi);
                
                $transaksi_detail = new TransaksiDetail;
                $transaksi_detail->kode = $nomor;
                $transaksi_detail->pelanggan_id = $data->pelanggan_id;
                $transaksi_detail->tanggal = $now;
                $transaksi_detail->tanggal_selesai = $tanggal_selesai;
                $transaksi_detail->paket_id = $data->paket_id;
                $transaksi_detail->jumlah = $data->jumlah;  
                $transaksi_detail->status = "Proses";      
                $transaksi_detail->total = $data->total;
                $transaksi_detail->keterangan = $data->keterangan;
                $transaksi_detail->save();
            }

            foreach($transaksi_sementara as $data){
                $data->delete();
            }
        
            return redirect(auth()->user()->level . '/transaksi')->with('sukses', 'Transaksi berhasil');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi, $kode)
    {
        $transaksi_detail = TransaksiDetail::where('kode', $kode)->get();
        $kode = $kode;

        return view('transaksi.edit', compact('transaksi_detail', 'kode'));
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
