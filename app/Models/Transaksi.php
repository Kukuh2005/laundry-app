<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'pelanggan_id',
        'tanggal',
        'total',
        'bayar',
        'kembali',
        'status',
        'status_pembayaran',
        'user_id',
    ];
}
