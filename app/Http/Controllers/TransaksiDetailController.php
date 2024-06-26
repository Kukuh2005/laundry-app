<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TransaksiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(TransaksiDetail $transaksiDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransaksiDetail $transaksiDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $kode)
    {
        $transaksiDetail = TransaksiDetail::find($id);
        $transaksiDetail->status = $request->status;
        $transaksiDetail->update();

        return redirect(auth()->user()->level . '/transaksi' . '/' . $kode . '/edit')->with('sukses', 'Status berhasil update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiDetail $transaksiDetail)
    {
        //
    }
}
