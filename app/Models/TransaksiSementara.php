<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSementara extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'tanggal',
        'tanggal_selesai',
        'paket_id',
        'status',
        'tanggal',
        'total',
    ];
}
