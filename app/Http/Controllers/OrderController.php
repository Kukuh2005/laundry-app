<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiSementara;
use App\Models\TransaksiDetail;
use App\Models\Pelanggan;
use App\Models\Paket;

class OrderController extends Controller
{
    public function index(){
        $transaksi = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();
        $belum_bayar = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();
        $proses = TransaksiDetail::where('status', 'Proses')->get();
        $siap_ambil = TransaksiDetail::where('status', 'Siap Ambil')->get();
        $selesai = TransaksiDetail::where('status', 'Selesai')->get();

        return view('order.index', compact('transaksi', 'belum_bayar', 'proses', 'siap_ambil', 'selesai'));
    }

    public function proses(){
        $transaksi = TransaksiDetail::where('status', 'Proses')->get();
        $belum_bayar = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();
        $proses = TransaksiDetail::where('status', 'Proses')->get();
        $siap_ambil = TransaksiDetail::where('status', 'Siap Ambil')->get();
        $selesai = TransaksiDetail::where('status', 'Selesai')->get();

        return view('order.detailOrder', compact('transaksi', 'belum_bayar', 'proses', 'siap_ambil', 'selesai'));
    }

    public function siap(){
        $transaksi = TransaksiDetail::where('status', 'Siap Ambil')->get();
        $belum_bayar = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();
        $proses = TransaksiDetail::where('status', 'Proses')->get();
        $siap_ambil = TransaksiDetail::where('status', 'Siap Ambil')->get();
        $selesai = TransaksiDetail::where('status', 'Selesai')->get();

        return view('order.detailOrder', compact('transaksi', 'belum_bayar', 'proses', 'siap_ambil', 'selesai'));
    }

    public function selesai(){
        $transaksi = TransaksiDetail::where('status', 'Selesai')->get();
        $belum_bayar = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();
        $proses = TransaksiDetail::where('status', 'Proses')->get();
        $siap_ambil = TransaksiDetail::where('status', 'Siap Ambil')->get();
        $selesai = TransaksiDetail::where('status', 'Selesai')->get();

        return view('order.detailOrder', compact('transaksi', 'belum_bayar', 'proses', 'siap_ambil', 'selesai'));
    }
    
    public function update(Request $request, $id){
        
        if($request->status_pembayaran != null){
            $transaksi = Transaksi::find($id);
            $transaksi->status_pembayaran = $request->status_pembayaran;
            $transaksi->update();
            
            return redirect('order')->with('sukses', 'Update data berhasil');
        }else{
            $transaksi = TransaksiDetail::find($id);
            $transaksi->status = $request->status;
            $transaksi->update();
        }

        if($request->status == 'Proses'){
            return redirect('order/proses')->with('sukses', 'Update data berhasil');
        }elseif($request->status == 'Siap Ambil'){
            return redirect('order/siap-ambil')->with('sukses', 'Update data berhasil');
        }else{
            return redirect('order/selesai')->with('sukses', 'Update data berhasil');
        }

    }

    public function cek(){
        return view('order.cekOrder');
    }

    public function cari(Request $request){
        $transaksi = Transaksi::where('kode', $request->kode)->get();
        $transaksi_detail = TransaksiDetail::where('kode', $request->kode)->get();

        return view('order.orderCari', compact('transaksi', 'transaksi_detail'));
    }
}
