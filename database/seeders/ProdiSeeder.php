<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::create([
            'kode_prodi' => '511',
            'nama_prodi' => 'Teknik Sipil'
        ]);

        Prodi::create([
            'kode_prodi' => '521',
            'nama_prodi' => 'Teknik Arsitektur'
        ]);

        Prodi::create([
            'kode_prodi' => '531',
            'nama_prodi' => 'Teknik Mesin'
        ]);

        Prodi::create([
            'kode_prodi' => '541',
            'nama_prodi' => 'Teknik Elektro'
        ]);

        Prodi::create([
            'kode_prodi' => '551',
            'nama_prodi' => 'Teknologi Informasi'
        ]);

        Prodi::create([
            'kode_prodi' => '561',
            'nama_prodi' => 'Teknik Lingkungan'
        ]);

        Prodi::create([
            'kode_prodi' => '571',
            'nama_prodi' => 'Teknik Industri'
        ]);
    }
}
