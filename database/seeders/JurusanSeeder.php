<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            [
                'nama_jurusan' => 'Sistem Informasi',
            ],
            [
                'nama_jurusan' => 'Teknik Informasi',
            ],
            [
                'nama_jurusan' => 'Akuntansi',
            ],
            [
                'nama_jurusan' => 'Sastra',
            ],
        ];
        Jurusan::insert($jurusans);
    }
}
