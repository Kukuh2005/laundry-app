<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Outlet::create([
            'nama' => 'Toko Laundry',
            'telepon' => '081234567891',
            'alamat' => 'sidoarjo, jawa timur',
        ]);

        \App\Models\Paket::create([
            'nama' => 'Cuci Basah Reguler',
            'jenis' => 'kiloan',
            'durasi' => 24,
            'harga' => 4000,
        ]);

        \App\Models\Paket::create([
            'nama' => 'Cuci Basah Express',
            'jenis' => 'kiloan',
            'durasi' => 12,
            'harga' => 6000,
        ]);

        \App\Models\Paket::create([
            'nama' => 'Cuci Kering Reguler',
            'jenis' => 'kiloan',
            'durasi' => 48,
            'harga' => 7000,
        ]);

        \App\Models\Paket::create([
            'nama' => 'Cuci Komplit Reguler',
            'jenis' => 'kiloan',
            'durasi' => 72,
            'harga' => 9000,
        ]);

        \App\Models\Paket::create([
            'nama' => 'Cuci Komplit Express',
            'jenis' => 'kiloan',
            'durasi' => 24,
            'harga' => 12000,
        ]);

        \App\Models\Paket::create([
            'nama' => 'Boneka',
            'jenis' => 'satuan',
            'durasi' => 24,
            'harga' => 10000,
        ]);
    }
}
