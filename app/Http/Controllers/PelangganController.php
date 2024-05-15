<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();

        return view('pelanggan.index', compact('pelanggan'));
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
        $pelanggan = new Pelanggan;
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->telepon = $request->telepon;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();

        return redirect(auth()->user()->level . '/pelanggan')->with('sukses', 'Tambah data berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->telepon = $request->telepon;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->update();

        return redirect(auth()->user()->level . '/pelanggan')->with('sukses', 'Edit data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);

        $pelanggan->delete();

        return redirect(auth()->user()->level . '/pelanggan')->with('sukses', 'Hapus data berhasil');
    }
}
