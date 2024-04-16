<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paket = Paket::where('jenis', 'kiloan')->get();

        return view('paket.index', compact('paket'));
    }

    public function satuan()
    {
        $paket = Paket::where('jenis', 'satuan')->get();

        return view('paket.index', compact('paket'));
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
        $paket->harga = $request->harga;
        $paket->save();

        if($request->jenis == 'kiloan'){
            return redirect('paket')->with('sukses', 'Berhasil tambah data');
        }else{
            return redirect('paket/satuan')->with('sukses', 'Berhasil tambah data');
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
        $paket = Paket::find($id);

        return view('paket.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $paket = Paket::find($id);

        $paket->nama = $request->nama;
        $paket->jenis = $request->jenis;
        $paket->harga = $request->harga;
        $paket->update();

        if($request->jenis == "kiloan"){
            return redirect('paket')->with('sukses', 'Edit data berhasil');
        }elseif($request->jenis == "satuan"){
            return redirect('paket/satuan')->with('sukses', 'Edit data berhasil');
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
            return redirect('paket')->with('sukses', 'Hapus data berhasil');
        }else{
            return redirect('paket/satuan')->with('sukses', 'Hapus data berhasil');
        }

    }
}
