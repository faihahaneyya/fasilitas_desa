<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PembayaranFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil data peminjaman yang sudah approved atau completed
        $peminjaman = PeminjamanFasilitas::whereIn('status', ['approved', 'completed'])
            ->whereNotNull('total_biaya')
            ->where('total_biaya', '>', 0)
            ->get();

        if ($peminjaman->isEmpty()) {
            $this->command->error('❌ Data peminjaman yang sudah approved/completed masih kosong!');
            $this->command->info('Jalankan dulu: php artisan db:seed --class=PeminjamanFasilitasSeeder');
            return;
        }

        // Data metode pembayaran
        $metodeOptions = [
            'tunai',
            'transfer',
            'kartu_kredit',
            'debit',
            'qris',
            'e-wallet'
        ];

        // Data keterangan pembayaran
        $keteranganOptions = [
            null,
            'Pembayaran via transfer bank',
            'Pembayaran lunas',
            'Pembayaran pertama',
            'Pembayaran kedua',
            'Pelunasan',
            'DP 50%',
            'Via QRIS',
            'Pembayaran di lokasi',
            'Bayar di kantor RW',
            'Transfer via mobile banking',
            'Bayar ke bendahara',
            'Pembayaran via e-wallet',
            'Cash di tempat acara',
            'Via virtual account'
        ];

        // Array untuk menyimpan data pembayaran
        $pembayaranData = [];

        // Counter untuk melacak peminjaman yang sudah dibayar
        $paidPinjamIds = [];

        // Generate 100 data pembayaran
        for ($i = 1; $i <= 100; $i++) {
            // Pilih peminjaman random yang belum dibayar
            $availablePeminjaman = $peminjaman->whereNotIn('pinjam_id', $paidPinjamIds);

            if ($availablePeminjaman->isEmpty()) {
                // Jika semua peminjaman sudah dibayar, pilih random dari semua
                $peminjamanItem = $peminjaman->random();
            } else {
                $peminjamanItem = $availablePeminjaman->random();
            }

            // Tandai peminjaman ini sudah dibayar (untuk menghindari duplikasi)
            if (!in_array($peminjamanItem->pinjam_id, $paidPinjamIds)) {
                $paidPinjamIds[] = $peminjamanItem->pinjam_id;
            }

            // Tentukan jumlah pembayaran
            $totalBiaya = $peminjamanItem->total_biaya;

            // 70% pembayaran lunas, 30% cicilan
            if ($faker->boolean(70)) {
                // Pembayaran lunas
                $jumlah = $totalBiaya;
                $keterangan = $faker->optional(0.5, null)->randomElement(['Pembayaran lunas', 'Pelunasan']);
            } else {
                // Pembayaran cicilan (2-3 kali)
                $jumlahCicilan = $faker->numberBetween(2, 3);
                $jumlah = floor($totalBiaya / $jumlahCicilan);

                // Pastikan total tidak melebihi
                $remaining = $totalBiaya - $jumlah;
                if ($remaining < $jumlah && $remaining > 0) {
                    $jumlah = $totalBiaya; // Bayar lunas jika sisa kecil
                }

                $keterangan = "Cicilan ke-" . $faker->numberBetween(1, $jumlahCicilan);
            }

            // Pastikan jumlah tidak melebihi total biaya
            $jumlah = min($jumlah, $totalBiaya);

            // Konversi tanggal peminjaman
            $tanggalMulai = Carbon::parse($peminjamanItem->tanggal_mulai);
            $tanggalPeminjaman = Carbon::parse($peminjamanItem->created_at);
            $now = Carbon::now();

            // Tentukan rentang tanggal pembayaran yang valid
            // Start date: max(tanggal_peminjaman, tanggal_mulai - 3 hari)
            $startDate = $tanggalPeminjaman->copy();
            $potentialStart = $tanggalMulai->copy()->subDays(3);

            if ($potentialStart->lessThan($startDate)) {
                $startDate = $potentialStart;
            }

            // End date: min(now, tanggal_mulai + 7 hari)
            $endDate = $now->copy();
            $potentialEnd = $tanggalMulai->copy()->addDays(7);

            if ($potentialEnd->lessThan($endDate)) {
                $endDate = $potentialEnd;
            }

            // Pastikan start date tidak lebih besar dari end date
            if ($startDate->greaterThan($endDate)) {
                // Jika start > end, gunakan tanggal peminjaman sebagai fallback
                $startDate = $tanggalPeminjaman;
                $endDate = $tanggalPeminjaman->copy()->addDays(3);

                // Pastikan end date tidak melebihi sekarang
                if ($endDate->greaterThan($now)) {
                    $endDate = $now;
                }
            }

            // Generate tanggal pembayaran
            try {
                $tanggalPembayaran = $faker->dateTimeBetween(
                    $startDate,
                    $endDate
                );
            } catch (\Exception $e) {
                // Fallback jika masih error
                $tanggalPembayaran = $tanggalPeminjaman->addDays(1);
            }

            // Konversi ke Carbon untuk konsistensi
            $tanggalPembayaran = Carbon::instance($tanggalPembayaran);

            // Pilih metode pembayaran
            $metode = $faker->randomElement($metodeOptions);

            // Pilih atau buat keterangan
            if (empty($keterangan)) {
                $keterangan = $faker->optional(0.6)->randomElement($keteranganOptions);
            }

            // Tambahkan data ke array
            $pembayaranData[] = [
                'pinjam_id' => $peminjamanItem->pinjam_id,
                'tanggal' => $tanggalPembayaran,
                'jumlah' => $jumlah,
                'metode' => $metode,
                'keterangan' => $keterangan,
                'created_at' => $tanggalPembayaran,
                'updated_at' => $tanggalPembayaran,
            ];

            // Progress indicator
            if ($i % 10 === 0) {
                $this->command->info("Created {$i} pembayaran records...");
            }
        }

        // Insert semua data sekaligus untuk performa lebih baik
        try {
            PembayaranFasilitas::insert($pembayaranData);
            $this->command->info('✅ Successfully seeded 100 pembayaran fasilitas records!');
        } catch (\Exception $e) {
            $this->command->error('❌ Error: ' . $e->getMessage());

            // Debug informasi
            $this->command->info("\n🔍 Debug Info:");
            $this->command->info("Peminjaman count: " . $peminjaman->count());
            $this->command->info("Pembayaran data count: " . count($pembayaranData));

            // Tampilkan beberapa data yang gagal
            if (!empty($pembayaranData)) {
                $this->command->table(
                    ['Pinjam ID', 'Jumlah', 'Metode', 'Tanggal'],
                    array_map(function($item) {
                        return [
                            $item['pinjam_id'],
                            $item['jumlah'],
                            $item['metode'],
                            $item['tanggal'] instanceof \DateTime ? $item['tanggal']->format('Y-m-d') : 'invalid'
                        ];
                    }, array_slice($pembayaranData, 0, 5))
                );
            }

            return;
        }

        // Tampilkan statistik
        $this->command->info("\n📊 Statistik Pembayaran:");

        // Hitung total jumlah pembayaran
        $totalJumlah = array_sum(array_column($pembayaranData, 'jumlah'));
        $this->command->info("   Total nilai pembayaran: Rp " . number_format($totalJumlah));

        // Hitung rata-rata pembayaran
        $avgJumlah = $totalJumlah / count($pembayaranData);
        $this->command->info("   Rata-rata per pembayaran: Rp " . number_format($avgJumlah));

        // Hitung berdasarkan metode
        $metodeCounts = array_count_values(array_column($pembayaranData, 'metode'));
        $this->command->info("\n💳 Distribusi Metode Pembayaran:");
        foreach ($metodeCounts as $metode => $count) {
            $percentage = ($count / 100) * 100;
            $this->command->info("   " . ucfirst($metode) . ": {$count} ({$percentage}%)");
        }

        // Tampilkan contoh data
        $this->command->table(
            ['ID Peminjaman', 'Tanggal', 'Jumlah', 'Metode', 'Keterangan'],
            array_map(function($item) {
                return [
                    '#' . $item['pinjam_id'],
                    $item['tanggal'] instanceof \DateTime ? $item['tanggal']->format('d/m/Y') : 'invalid',
                    'Rp ' . number_format($item['jumlah']),
                    ucfirst($item['metode']),
                    $item['keterangan'] ? substr($item['keterangan'], 0, 20) . '...' : '-'
                ];
            }, array_slice($pembayaranData, 0, 5))
        );

        // Info tambahan
        $this->command->info("\n📝 Informasi:");
        $this->command->info("   • Data diambil dari peminjaman dengan status 'approved' atau 'completed'");
        $this->command->info("   • 70% pembayaran lunas, 30% cicilan");
        $this->command->info("   • Tanggal pembayaran realistis");
    }
}
