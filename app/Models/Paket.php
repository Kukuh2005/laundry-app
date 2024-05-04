<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormatRupiah;
use App\Models\TransaksiSementara;
use App\Models\Transaksi;

class Paket extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    protected $fillable = [
        'nama',
        'jenis',
        'harga',
    ];

    public function TransaksiSementara()
    {
        return $this->hasMany(TransaksiSementara::class);
    }

    public function Transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
