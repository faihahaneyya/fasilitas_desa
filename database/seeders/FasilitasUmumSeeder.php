<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FasilitasUmumSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $jenisFasilitas = [
            'Aula',
            'Lapangan Sepak Bola',
            'Lapangan Bulutangkis',
            'Pos Kamling',
            'Masjid',
            'Musholla',
            'Taman Bermain',
            'Balai RW',
            'Perpustakaan Desa',
            'Puskesmas Pembantu',
            'Pasar Tradisional',
            'Gedung Serbaguna'
        ];

        for ($i = 0; $i < 100; $i++) {
            $jenis = $faker->randomElement($jenisFasilitas);

            DB::table('fasilitas_umum')->insert([
                'name' => $jenis . ' ' . $faker->streetName,
                'jenis' => $jenis,
                'alamat' => $faker->address,
                'rt' => str_pad($faker->numberBetween(1, 15), 3, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'kapasitas' => $faker->optional(0.8)->numberBetween(20, 500), // 80% data terisi
                'deskripsi' => $faker->optional()->paragraph(2),
                'fotos' => json_encode([
                    'https://via.placeholder.com/640x480.png?text=Fasilitas+1',
                    'https://via.placeholder.com/640x480.png?text=Fasilitas+2'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}