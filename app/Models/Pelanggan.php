<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Pelanggan;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'telepon',
    ];

    public function Transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function TransaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function Pelanggan()
    {
        return $this->hasMany(Pelanggan::class);
    }
}
