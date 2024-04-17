<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
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
        $pelanggan = Pelanggan::all();
        $paket = Paket::all();

        $now = Carbon::now();
        $tahun_bulan = $now->year . $now->month;
        $cek = Transaksi::count();
        
        if($cek == 0){
            $urut = 10000001;
            $nomor = $tahun_bulan . $urut;
        }else {
            $ambil = Transaksi::all()->last();
            $urut = (int)substr($ambil->kode_transaksi, -8) + 1;
            $nomor = $tahun_bulan . $urut;
        }

        return view('transaksi.index', compact('pelanggan', 'paket', 'nomor'));
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
    public function store(Request $request)
    {
        //
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
