<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormatRupiah;
use App\Models\Pelanggan;
use App\Models\User;

class Transaksi extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    protected $fillable = [
        'kode',
        'pelanggan_id',
        'tanggal',
        'total',
        'bayar',
        'kembali',
        'status_pembayaran',
        'user_id',
    ];

    public function Pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
