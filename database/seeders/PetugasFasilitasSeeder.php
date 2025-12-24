<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Warga;
use App\Models\FasilitasUmum;
use Faker\Factory as Faker;

class PetugasFasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID yang tersedia dari tabel referensi
        $fasilitasIds = FasilitasUmum::pluck('fasilitas_id')->toArray();
        $wargaIds = Warga::pluck('warga_id')->toArray();

        // Cek jika data referensi kosong
        if (empty($fasilitasIds) || empty($wargaIds)) {
            $this->command->warn("Data Fasilitas atau Warga kosong. Jalankan seeder mereka terlebih dahulu!");
            return;
        }

        $daftarPeran = [
            'Ketua Pengelola',
            'Sekretaris',
            'Bendahara',
            'Anggota Keamanan',
            'Penanggung Jawab Kebersihan',
            'Staf Operasional',
            'Koordinator Lapangan'
        ];

        // Looping tepat 100 kali
        for ($i = 0; $i < 100; $i++) {
            DB::table('petugas_fasilitas')->insert([
                'fasilitas_id' => $faker->randomElement($fasilitasIds),
                'petugas_warga_id' => $faker->randomElement($wargaIds),
                'peran' => $faker->randomElement($daftarPeran),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("Berhasil menambahkan 100 data petugas fasilitas.");
    }
}