<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\FasilitasUmum;
use Faker\Factory as Faker;

class SyaratFasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID fasilitas yang tersedia
        $fasilitasIds = FasilitasUmum::pluck('fasilitas_id')->toArray();

        if (empty($fasilitasIds)) {
            $this->command->warn("Data Fasilitas Umum kosong. Jalankan FasilitasUmumSeeder terlebih dahulu!");
            return;
        }

        $daftarSyarat = [
            'Fotokopi KTP Pemohon',
            'Surat Izin Keramaian dari RT/RW',
            'Uang Jaminan Kebersihan',
            'Surat Pernyataan Menjaga Ketertiban',
            'Sertifikat Vaksin Minimal Dosis 2',
            'Membayar Biaya Administrasi',
            'Dilarang Membawa Senjata Tajam/Miras',
            'Maksimal Durasi Penggunaan 5 Jam',
            'Membawa Kantong Sampah Sendiri',
            'Menyerahkan Kartu Keluarga (KK)',
            'Mendapatkan Izin Pengelola',
            'Lapor ke Petugas Keamanan Lokal'
        ];

        // Looping sebanyak 100 kali untuk menghasilkan tepat 100 data
        for ($i = 0; $i < 100; $i++) {
            DB::table('syarat_fasilitas')->insert([
                // Pilih ID fasilitas secara acak dari data yang ada
                'fasilitas_id' => $faker->randomElement($fasilitasIds),
                // Pilih nama syarat secara acak
                'nama_syarat' => $faker->randomElement($daftarSyarat),
                'deskripsi' => $faker->optional(0.7)->sentence(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("Berhasil menambahkan 100 data syarat fasilitas.");
    }
}