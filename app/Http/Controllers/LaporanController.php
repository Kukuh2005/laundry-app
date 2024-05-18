<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Outlet;
use App\Models\TransaksiDetail;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::orderBy('tanggal', 'desc')->get();
        $transaksi_detail = TransaksiDetail::all();
        $now = Carbon::now();
        $tanggal_dari = $now->format('Y-m-d');
        $tanggal_sampai = $now->format('Y-m-d');

        return view('laporan.index', compact('transaksi', 'transaksi_detail', 'tanggal_dari', 'tanggal_sampai'));
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
    public function cari(Request $request)
    {
        $transaksi_detail = TransaksiDetail::all();
        $tanggal_dari = $request->tanggal_dari;
        $tanggal_sampai = $request->tanggal_sampai;

        // Pastikan format tanggal yang diterima sesuai dengan Y-m-d
        $tanggal_dari = \Carbon\Carbon::parse($tanggal_dari)->format('Y-m-d');
        $tanggal_sampai = \Carbon\Carbon::parse($tanggal_sampai)->format('Y-m-d');

        $transaksi = Transaksi::whereBetween(\DB::raw('DATE(tanggal)'), [$tanggal_dari, $tanggal_sampai])->get();

        return view('laporan.index', compact('transaksi', 'transaksi_detail', 'tanggal_dari', 'tanggal_sampai'));

    }

    public function print($kode)
    {
        $cari_user = Transaksi::where('kode', $kode)->first();
        $pelanggan_id = $cari_user->pelanggan_id;
        $pelanggan = Pelanggan::find($pelanggan_id);
        $id_transaksi = Transaksi::where('kode', $kode)->first();
        $transaksi = Transaksi::find($id_transaksi->id);
        $transaksi_detail = TransaksiDetail::where('kode', $kode)->get();

        $outlet = Outlet::find(1);

        $pdf = Pdf::loadView('laporan.print', compact('transaksi', 'transaksi_detail', 'outlet', 'pelanggan'));
        return $pdf->stream();
    }
    
    public function printTanggal($tanggal_dari, $tanggal_sampai)
    {
        $tanggal_dari_format = \Carbon\Carbon::parse($tanggal_dari)->format('Y-m-d');
        $tanggal_sampai_format = \Carbon\Carbon::parse($tanggal_sampai)->format('Y-m-d');

        $transaksi = Transaksi::whereBetween(\DB::raw('DATE(tanggal)'), [$tanggal_dari_format, $tanggal_sampai_format])->get();
        $sub_total = 0;
        
        foreach($transaksi as $data){
            if($data->status_pembayaran == "Sudah Bayar"){
                $sub_total += $data->total;
            }
        }

        $total = number_format($sub_total, 0, ',', '.');

        $pdf = Pdf::loadView('laporan.printTanggal', compact('transaksi', 'total', 'tanggal_dari', 'tanggal_sampai'));
        return $pdf->stream();
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
