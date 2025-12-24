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

        // Gunakan collect() untuk membungkus hasil query agar fungsi ->random() pasti jalan
        $peminjamans = collect(DB::table('peminjaman_fasilitas')
            ->where('total_biaya', '>', 0)
            ->get());

        if ($peminjamans->isEmpty()) {
            $this->command->warn("Data peminjaman kosong. Pastikan PeminjamanFasilitasSeeder sudah dijalankan.");
            return;
        }

        for ($i = 0; $i < 100; $i++) {
            $pinjam = $peminjamans->random();

            // Logika pencegahan error "Start date must be anterior to end date"
            $start = strtotime($pinjam->tanggal_mulai) > time() ? 'now' : $pinjam->tanggal_mulai;

            DB::table('pembayaran_fasilitas')->insert([
                'pinjam_id' => $pinjam->pinjam_id,
                'tanggal' => $faker->dateTimeBetween($start, 'now')->format('Y-m-d'),
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