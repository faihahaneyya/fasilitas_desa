<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PembayaranFasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil ID peminjaman yang valid (yang memiliki biaya > 0)
        $peminjamans = DB::table('peminjaman_fasilitas')
            ->where('total_biaya', '>', 0)
            ->get();

        if ($peminjamans->isEmpty()) {
            $this->command->warn("Tidak ada data peminjaman dengan biaya > 0. Jalankan PeminjamanFasilitasSeeder dulu!");
            return;
        }

        // Looping sebanyak 100 kali
        for ($i = 0; $i < 100; $i++) {
            // Ambil satu data peminjaman secara acak dari koleksi yang ada
            $pinjam = $peminjamans->random();

            // Logika tanggal aman (seperti yang Anda miliki sebelumnya)
            $startDate = strtotime($pinjam->tanggal_mulai) > time() ? 'now' : $pinjam->tanggal_mulai;

            DB::table('pembayaran_fasilitas')->insert([
                'pinjam_id' => $pinjam->pinjam_id,
                'tanggal' => $faker->dateTimeBetween($startDate, 'now')->format('Y-m-d'),
                'jumlah' => $pinjam->total_biaya,
                'metode' => $faker->randomElement(['Transfer Bank', 'Tunai', 'QRIS', 'E-Wallet']),
                'keterangan' => 'Pembayaran lunas untuk tagihan #' . ($i + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("Berhasil menambahkan 100 data pembayaran.");
    }
}