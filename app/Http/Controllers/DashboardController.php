<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\TransaksiDetail;
use App\Models\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $proses = TransaksiDetail::where('status', 'Proses')->orderBy('tanggal_selesai', 'asc')->get();
        $siap_ambil = TransaksiDetail::where('status', 'Siap Ambil')->get();
        $selesai = TransaksiDetail::where('status', 'Selesai')->orderBy('tanggal_selesai', 'asc')->get();
        $belum_bayar = Transaksi::where('status_pembayaran', 'Belum Bayar')->get();

        $now = Carbon::now()->format('Y-m-d');
        $selesai_hari_ini = TransaksiDetail::whereDate('tanggal_selesai', $now)->get();

        // Mendapatkan tanggal satu bulan yang lalu dari sekarang
        $now = Carbon::now();
        $bulan_ini = $now->formatLocalized('%B');
        $tanggal_satu = $now->year . '-' . $now->month . '-' . 01;

        // Mendapatkan tanggal hari ini
        $tanggal_sekarang = Carbon::now();
        $pendapatan = Transaksi::whereBetween('tanggal', [$tanggal_satu, $tanggal_sekarang])->where('status_pembayaran', 'Sudah Bayar')->get();
        $sub_total = 0;
        
        if($pendapatan){
            foreach($pendapatan as $data){
                $sub_total += $data->total;   
            }
        }

        $pendapatan_bulan = number_format($sub_total, 0, ',', '.');

        return view('dashboard.index', compact('proses', 'siap_ambil', 'selesai', 'belum_bayar', 'selesai_hari_ini', 'pendapatan_bulan', 'bulan_ini'));
    }
}
