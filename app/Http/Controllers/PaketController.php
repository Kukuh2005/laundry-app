<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paket = Paket::where('jenis', 'kiloan')->get();
        $data = "Kiloan";

        return view('paket.index', compact('paket', 'data'));
    }

    public function satuan()
    {
        $paket = Paket::where('jenis', 'satuan')->get();
        $data = "Satuan";

        return view('paket.index', compact('paket', 'data'));
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
        $paket = new Paket;
        $paket->nama = $request->nama;
        $paket->jenis = $request->jenis;
        $paket->durasi = $request->durasi;
        $paket->harga = $request->harga;
        $paket->save();

        if($request->jenis == 'kiloan'){
            return redirect(auth()->user()->level . '/paket')->with('sukses', 'Berhasil tambah data');
        }else{
            return redirect(auth()->user()->level . '/paket/satuan')->with('sukses', 'Berhasil tambah data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $paket = Paket::find($id);

        $paket->nama = $request->nama;
        $paket->jenis = $request->jenis;
        $paket->durasi = $request->durasi;
        $paket->harga = $request->harga;
        $paket->update();

        if($request->jenis == "kiloan"){
            return redirect(auth()->user()->level . '/paket')->with('sukses', 'Edit data berhasil');
        }elseif($request->jenis == "satuan"){
            return redirect(auth()->user()->level . '/paket/satuan')->with('sukses', 'Edit data berhasil');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paket = Paket::find($id);

        $paket->delete();

        if($paket->jenis == 'kiloan'){
            return redirect(auth()->user()->level . '/paket')->with('sukses', 'Hapus data berhasil');
        }else{
            return redirect(auth()->user()->level . '/paket/satuan')->with('sukses', 'Hapus data berhasil');
        }

    }
}
