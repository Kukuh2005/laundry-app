<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormatRupiah;
use App\Models\Paket;
use App\Models\Pelanggan;

class TransaksiDetail extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    protected $fillable = [
        'kode',
        'pelanggan_id',
        'tanggal',
        'tanggal_selesai',
        'paket_id',
        'status',
        'tanggal',
        'total',
    ];

    public function Paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function Pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

}
