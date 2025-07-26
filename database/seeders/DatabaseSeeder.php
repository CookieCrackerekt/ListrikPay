<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Level;
use App\Models\Tarif;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Level::insert([
            ['id_level' => 1, 'nama_level' => 'Admin'],
            ['id_level' => 2, 'nama_level' => 'Petugas']
        ]);

        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nama_admin' => 'Muhammad Hammmam Afif',
            'id_level' => 1,
        ]);

        Tarif::insert([
            ['daya' => 900, 'tarifperkwh' => 1352],
            ['daya' => 1300, 'tarifperkwh' => 1444.70],
            ['daya' => 2200, 'tarifperkwh' => 1444.70],
            ['daya' => 3500, 'tarifperkwh' => 1699.53],
            ['daya' => 5500, 'tarifperkwh' => 1699.53],
            ['daya' => 6600, 'tarifperkwh' => 1699.53]
        ]);

        Pelanggan::create([
            'username' => 'pelanggan01',
            'password' => Hash::make('pelanggan123'),
            'nomor_kwh' => '32154218902789252790',
            'nama_pelanggan' => 'Budi Santoso',
            'alamat' => 'Jl. Mawar No. 1',
            'id_tarif' => 1
        ]);

        Pelanggan::create([
            'username' => 'pelanggan02',
            'password' => Hash::make('pelanggan123'),
            'nomor_kwh' => '32154218909989247880',
            'nama_pelanggan' => 'Nuuri Afkaar',
            'alamat' => 'Jl. Pramuka No. 22',
            'id_tarif' => 2
        ]);

        Pelanggan::create([
            'username' => 'pelanggan03',
            'password' => Hash::make('pelanggan123'),
            'nomor_kwh' => '32154218967789247770',
            'nama_pelanggan' => 'Alif Rafi',
            'alamat' => 'Jl. Pedesaan No. 6',
            'id_tarif' => 3
        ]);
    }
}
