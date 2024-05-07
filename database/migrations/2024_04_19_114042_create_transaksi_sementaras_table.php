<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_sementaras', function (Blueprint $table) {
            $table->id();
            $table->integer('pelanggan_id');
            $table->datetime('tanggal');
            $table->datetime('tanggal_selesai');
            $table->integer('paket_id');
            $table->float('jumlah');
            $table->string('status');
            $table->float('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_sementaras');
    }
};
