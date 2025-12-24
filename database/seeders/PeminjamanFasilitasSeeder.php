<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Warga;
use App\Models\FasilitasUmum;
use Faker\Factory as Faker;

class PeminjamanFasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID yang tersedia untuk relasi
        $wargaIds = Warga::pluck('warga_id')->toArray();
        $fasilitasIds = FasilitasUmum::pluck('fasilitas_id')->toArray();

        // Pastikan ada data di tabel referensi
        if (empty($wargaIds) || empty($fasilitasIds)) {
            $this->command->warn("Data Warga atau Fasilitas Umum kosong. Jalankan seeder mereka terlebih dahulu!");
            return;
        }

        $tujuanPinjam = [
            'Acara Pernikahan', 'Rapat RT/RW', 'Lomba 17 Agustusan', 
            'Pengajian Rutin', 'Latihan Olahraga', 'Kerja Bakti', 
            'Arisan Keluarga', 'Vaksinasi Massal', 'Bazar UMKM'
        ];

        for ($i = 0; $i < 100; $i++) {
            $mulai = $faker->dateTimeBetween('-1 month', '+1 month');
            // Tanggal selesai adalah 1-3 hari setelah tanggal mulai
            $selesai = (clone $mulai)->modify('+' . rand(0, 3) . ' days');

            DB::table('peminjaman_fasilitas')->insert([
                'fasilitas_id'    => $faker->randomElement($fasilitasIds),
                'warga_id'        => $faker->randomElement($wargaIds),
                'tanggal_mulai'   => $mulai->format('Y-m-d'),
                'tanggal_selesai' => $selesai->format('Y-m-d'),
                'tujuan'          => $faker->randomElement($tujuanPinjam),
                'status'          => $faker->randomElement(['pending', 'approved', 'rejected', 'completed', 'cancelled']),
                'total_biaya'     => $faker->randomElement([0, 50000, 100000, 250000, 500000]),
                'catatan'         => $faker->optional(0.5)->sentence(),
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}