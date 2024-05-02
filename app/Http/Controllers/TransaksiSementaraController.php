<?php

namespace App\Http\Controllers;

use App\Models\TransaksiSementara;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Pelanggan;
use App\Models\Paket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiSementaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        $pelanggan = Pelanggan::all();

        return view('transaksi.index', compact('transaksi', 'pelanggan'));
        // $pelanggan = Pelanggan::all();
        // $paket = Paket::all();
        // $keranjang = TransaksiSementara::all();

        // $now = Carbon::now();
        // $tahun_bulan = $now->year . $now->month;
        // $cek = Transaksi::count();
        
        // if($cek == 0){
        //     $urut = 10000001;
        //     $nomor = $tahun_bulan . $urut;
        // }else {
        //     $ambil = Transaksi::all()->last();
        //     $urut = (int)substr($ambil->kode_transaksi, -8) + 1;
        //     $nomor = $tahun_bulan . $urut;
        // }

        // return view('transaksi.index', compact('pelanggan', 'paket', 'nomor', 'keranjang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($pelanggan_id)
    {
        // Transaksi::truncate();
        // TransaksiSementara::truncate();
        // TransaksiDetail::truncate();

        $pelanggan = Pelanggan::find($pelanggan_id);
        $paket = Paket::all();
        $keranjang = TransaksiSementara::where('pelanggan_id', $pelanggan_id)->get();

        $get_sub_total = TransaksiSementara::where('pelanggan_id', $pelanggan_id)->get();
        $jumlah = 0;
        
        if($get_sub_total){
            foreach($get_sub_total as $data){
                $jumlah += $data->total;
            }
        }else{
            $jumlah = 0;
        }

        return view('transaksi.transaksi', compact('pelanggan', 'paket', 'keranjang', 'jumlah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $pelanggan_id)
    {
        $paket = Paket::find($request->paket_id);
        $total = $paket->harga * $request->jumlah;

        $now = Carbon::now();
        $tanggal_sekarang = $now->year . "-" . $now->month . "-" . $now->day;

        $transaksiSementara = new TransaksiSementara;
        $transaksiSementara->pelanggan_id = $request->pelanggan_id;
        $transaksiSementara->tanggal = $tanggal_sekarang;
        $transaksiSementara->tanggal_selesai = $request->tanggal_selesai;
        $transaksiSementara->paket_id = $request->paket_id;
        $transaksiSementara->jumlah = $request->jumlah;
        $transaksiSementara->status = "proses";
        $transaksiSementara->total = $total;
        $transaksiSementara->save();

        return redirect('transaksi/' . $pelanggan_id)->with('sukses', 'Item ditambahkan ke keranjang');
    }

    /**
     * Display the specified resource.
     */
    public function show(TransaksiSementara $transaksiSementara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransaksiSementara $transaksiSementara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransaksiSementara $transaksiSementara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $pelanggan_id)
    {
        $transaksiSementara = TransaksiSementara::find($id);

        $transaksiSementara->delete();

        return redirect('transaksi/' . $pelanggan_id)->with('sukses', 'Item di hapus dari keranjang');
    }
}