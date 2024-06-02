<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiSementara;
use App\Models\TransaksiDetail;
use App\Models\Pelanggan;
use App\Models\Paket;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $transaksi = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();
        $belum_bayar = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();
        $proses = TransaksiDetail::where('status', 'Proses')->get();
        $siap_ambil = TransaksiDetail::where('status', 'Siap Ambil')->get();
        $selesai = TransaksiDetail::where('status', 'Selesai')->get();
        $data = "Belum Bayar";

        return view('order.index', compact('transaksi', 'belum_bayar', 'proses', 'siap_ambil', 'selesai', 'data'));
    }

    public function proses(){
        $transaksi = TransaksiDetail::where('status', 'Proses')->orderBy('tanggal_selesai', 'asc')->get();
        $belum_bayar = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();
        $proses = TransaksiDetail::where('status', 'Proses')->get();
        $siap_ambil = TransaksiDetail::where('status', 'Siap Ambil')->get();
        $selesai = TransaksiDetail::where('status', 'Selesai')->get();
        $data = "Proses";

        return view('order.detailOrder', compact('transaksi', 'belum_bayar', 'proses', 'siap_ambil', 'selesai', 'data'));
    }

    public function siap(){
        $transaksi = TransaksiDetail::where('status', 'Siap Ambil')->orderBy('tanggal_selesai', 'desc')->get();
        $belum_bayar = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();
        $proses = TransaksiDetail::where('status', 'Proses')->get();
        $siap_ambil = TransaksiDetail::where('status', 'Siap Ambil')->get();
        $selesai = TransaksiDetail::where('status', 'Selesai')->get();
        $data = "Siap Ambil";

        return view('order.detailOrder', compact('transaksi', 'belum_bayar', 'proses', 'siap_ambil', 'selesai', 'data'));
    }

    public function selesai(){
        $transaksi = TransaksiDetail::where('status', 'Selesai')->get();
        $belum_bayar = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();
        $proses = TransaksiDetail::where('status', 'Proses')->get();
        $siap_ambil = TransaksiDetail::where('status', 'Siap Ambil')->get();
        $selesai = TransaksiDetail::where('status', 'Selesai')->orderBy('tanggal_selesai', 'desc')->get();
        $data = "Selesai";

        return view('order.detailOrder', compact('transaksi', 'belum_bayar', 'proses', 'siap_ambil', 'selesai', 'data'));
    }
    
    public function update(Request $request, $id){
        
        if($request->status_pembayaran != null){
            $transaksi = Transaksi::find($id);
            $transaksi->status_pembayaran = $request->status_pembayaran;
            $transaksi->bayar = $request->bayar;
            $kembali = $request->bayar - $transaksi->total;
            $transaksi->kembali = $kembali;
            $transaksi->update();
            
            return redirect(auth()->user()->level . '/order')->with('sukses', 'Update data berhasil');
        }else{
            $transaksi = TransaksiDetail::find($id);
            $cek = Transaksi::where('kode' ,$transaksi->kode)->first();

            if($request->status == "Selesai" && $cek->status_pembayaran == "Belum Bayar"){      
                if($transaksi->status == "Proses"){
                    return redirect(auth()->user()->level . '/order/proses')->with('gagal', 'Pelangan belum bayar');
                }elseif($transaksi->status == "Siap Ambil"){
                    return redirect(auth()->user()->level . '/order/siap-ambil')->with('gagal', 'Pelangan belum bayar');
                }          
            }else{
                $transaksi->status = $request->status;
                $transaksi->update();

                if($request->status == 'Proses'){
                    return redirect(auth()->user()->level . '/order/proses')->with('sukses', 'Update data berhasil');
                }elseif($request->status == 'Siap Ambil'){
                    return redirect(auth()->user()->level . '/order/siap-ambil')->with('sukses', 'Update data berhasil');
                }else{
                    return redirect(auth()->user()->level . '/order/selesai')->with('sukses', 'Update data berhasil');
                }
            }
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
