<?php
namespace Database\Seeders;

use App\Models\FasilitasUmum;
use App\Models\PeminjamanFasilitas;
use App\Models\Warga;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PeminjamanFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil data fasilitas dan warga yang sudah ada
        $fasilitas = FasilitasUmum::all();
        $warga     = Warga::all();

        if ($fasilitas->isEmpty() || $warga->isEmpty()) {
            $this->command->error('❌ Data fasilitas atau warga masih kosong!');
            $this->command->info('Jalankan dulu: php artisan db:seed --class=FasilitasUmumSeeder');
            $this->command->info('Jalankan dulu: php artisan db:seed --class=WargaSeeder');
            return;
        }

        // Data tujuan peminjaman
        $tujuanOptions = [
            'Acara Pernikahan', 'Rapat RT/RW', 'Pengajian', 'Peringatan 17 Agustus',
            'Lomba 17 Agustus', 'Kegiatan Posyandu', 'Kegiatan Karang Taruna',
            'Latihan Olahraga', 'Turnamen', 'Acara Keluarga', 'Syukuran',
            'Hajatan', 'Khitanan', 'Ulang Tahun', 'Reuni', 'Rapat Kerja',
            'Pelatihan', 'Workshop', 'Seminar', 'Pertemuan Warga',
            'Gotong Royong', 'Bakti Sosial', 'Donor Darah', 'Pemeriksaan Kesehatan',
            'Festival', 'Pasar Murah', 'Bazar', 'Pameran', 'Pentas Seni',
            'Latihan Tari', 'Latihan Musik', 'Latihan Drama', 'Kegiatan PKK',
            'Kegiatan Dasawisma', 'Posyandu Lansia', 'Kegiatan Keagamaan',
            'Retret', 'Ibadah', 'Khotbah', 'Kegiatan Remaja Masjid',
            'Latihan Paskibra', 'Pramuka', 'Kegiatan Sekolah Minggu',
            'Kelas Parenting', 'Pelatihan Keterampilan', 'Kursus Masak',
            'Kegiatan Sosialisasi', 'Penyuluhan', 'Kampanye', 'Pemilihan RT/RW',
        ];

        // Data status peminjaman dengan probabilitas
        $statusOptions = [
            ['status' => 'pending', 'weight' => 15],
            ['status' => 'approved', 'weight' => 40],
            ['status' => 'rejected', 'weight' => 10],
            ['status' => 'completed', 'weight' => 30],
            ['status' => 'cancelled', 'weight' => 5],
        ];

        // Data catatan opsional
        $catatanOptions = [
            null,
            'Mohon persiapan tempat sebelum acara dimulai',
            'Akan ada sekitar 50 orang yang hadir',
            'Perlu sound system dan kursi',
            'Acara akan dihadiri tamu dari kelurahan',
            'Mohon kebersihan dijaga setelah acara',
            'Perlu meja dan kursi untuk 30 orang',
            'Akan ada konsumsi untuk peserta',
            'Acara dimulai pukul 08.00 WIB',
            'Mohon tempat dibersihkan terlebih dahulu',
            'Perlu akses listrik tambahan',
            'Akan ada dekorasi sederhana',
            'Mohon ijin parkir untuk 10 mobil',
            'Acara bersifat tertutup untuk keluarga',
            'Perlu LCD projector dan screen',
        ];

        // Fungsi untuk memilih status berdasarkan weight
        function getRandomStatus($statusOptions)
        {
            $totalWeight = array_sum(array_column($statusOptions, 'weight'));
            $random      = rand(1, $totalWeight);
            $current     = 0;

            foreach ($statusOptions as $option) {
                $current += $option['weight'];
                if ($random <= $current) {
                    return $option['status'];
                }
            }

            return 'pending'; // Default
        }

        // Hitung biaya berdasarkan jenis fasilitas
        function calculateBiaya($jenisFasilitas, $durasiHari)
        {
            $hargaPerHari = [
                'Balai RW'          => 500000,
                'Balai RT'          => 200000,
                'Masjid'            => 300000,
                'Gereja'            => 400000,
                'GOR'               => 1000000,
                'Lapangan Olahraga' => 300000,
                'Ruang Serbaguna'   => 400000,
                'Taman'             => 150000,
                'Kolam Renang Umum' => 800000,
                'Perpustakaan'      => 100000,
                'Sanggar Seni'      => 250000,
                'Pasar Rakyat'      => 600000,
            ];

            $defaultPrice = 200000; // Harga default untuk jenis lainnya

            $harga = $hargaPerHari[$jenisFasilitas] ?? $defaultPrice;
            return $harga * $durasiHari;
        }

        // Array untuk menyimpan data peminjaman
        $peminjamanData = [];

        // Generate 100 data peminjaman
        for ($i = 1; $i <= 100; $i++) {
            // Pilih fasilitas random
            $fasilitasItem = $fasilitas->random();

            // Pilih warga random
            $wargaItem = $warga->random();

            // Generate tanggal mulai (dalam 6 bulan terakhir ke depan)
            $tanggalMulai = Carbon::now()
                ->subMonths(3)                            // Mulai dari 3 bulan yang lalu
                ->addDays($faker->numberBetween(0, 180)); // Sampai 6 bulan ke depan

            // Tentukan durasi (1-7 hari)
            $durasiHari     = $faker->numberBetween(1, 7);
            $tanggalSelesai = $tanggalMulai->copy()->addDays($durasiHari);

            // Pastikan tanggal selesai tidak lebih dari 6 bulan dari sekarang
            if ($tanggalSelesai->greaterThan(Carbon::now()->addMonths(3))) {
                $tanggalSelesai = Carbon::now()->addMonths(3);
                $durasiHari     = $tanggalMulai->diffInDays($tanggalSelesai);
            }

            // Pilih tujuan
            $tujuan = $faker->randomElement($tujuanOptions);

            // Pilih status dengan probabilitas menggunakan fungsi baru
            $status = getRandomStatus($statusOptions);

            // Hitung total biaya DULU
            $calculatedBiaya = calculateBiaya($fasilitasItem->jenis, $durasiHari);

            // Untuk status rejected atau cancelled, kurangi biaya atau set ke 0
            if ($status === 'rejected' || $status === 'cancelled') {
                $totalBiaya = $faker->optional(0.3, 0)->numberBetween(50000, $calculatedBiaya * 0.5);
            }

            // Untuk status pending, kadang belum ada biaya (tapi minimal 0)
            if ($status === 'pending') {
                $totalBiaya = $faker->optional(0.5, 0)->numberBetween(0, $calculatedBiaya);
            }

            // Untuk status approved atau completed, gunakan biaya yang dihitung
            if ($status === 'approved' || $status === 'completed') {
                $totalBiaya = $calculatedBiaya;
            }

            // PASTIKAN total_biaya tidak null, minimal 0
            $totalBiaya = $totalBiaya ?? 0;

            // Pilih catatan
            $catatan = $faker->optional(0.6)->randomElement($catatanOptions);

            // Pastikan created_at lebih awal dari tanggal mulai
            $createdAt = $tanggalMulai->copy()->subDays($faker->numberBetween(1, 30));

            // Tambahkan data ke array
            $peminjamanData[] = [
                'fasilitas_id'    => $fasilitasItem->fasilitas_id,
                'warga_id'        => $wargaItem->warga_id,
                'tanggal_mulai'   => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,
                'tujuan'          => $tujuan,
                'status'          => $status,
                'total_biaya'     => $totalBiaya, // Pastikan tidak null
                'catatan'         => $catatan,
                'created_at'      => $createdAt,
                'updated_at'      => now(),
            ];

            // Progress indicator
            if ($i % 10 === 0) {
                $this->command->info("Created {$i} peminjaman records...");
            }
        }

        // Insert semua data sekaligus untuk performa lebih baik
        try {
            PeminjamanFasilitas::insert($peminjamanData);
            $this->command->info('✅ Successfully seeded 100 peminjaman fasilitas records!');
        } catch (\Exception $e) {
            $this->command->error('❌ Error: ' . $e->getMessage());
            // Tampilkan data yang bermasalah
            foreach ($peminjamanData as $index => $data) {
                if ($data['total_biaya'] === null) {
                    $this->command->error("Data ke-{$index} memiliki total_biaya null");
                }
            }
            return;
        }

        // Tampilkan statistik
        $statusCounts = array_count_values(array_column($peminjamanData, 'status'));
        $this->command->info("\n📊 Statistik Status Peminjaman:");
        foreach ($statusCounts as $status => $count) {
            $percentage = ($count / 100) * 100;
            $this->command->info("   {$status}: {$count} ({$percentage}%)");
        }

        // Tampilkan statistik biaya
        $totalBiayaArray = array_column($peminjamanData, 'total_biaya');
        $avgBiaya        = array_sum($totalBiayaArray) / count($totalBiayaArray);
        $maxBiaya        = max($totalBiayaArray);
        $minBiaya        = min($totalBiayaArray);

        $this->command->info("\n💰 Statistik Biaya:");
        $this->command->info("   Rata-rata: Rp " . number_format($avgBiaya));
        $this->command->info("   Tertinggi: Rp " . number_format($maxBiaya));
        $this->command->info("   Terendah: Rp " . number_format($minBiaya));

        // Tampilkan contoh data
        $this->command->table(
            ['Fasilitas', 'Warga', 'Tanggal', 'Tujuan', 'Status', 'Biaya'],
            array_map(function ($item) use ($fasilitas, $warga) {
                $fasilitasNama = $fasilitas->firstWhere('fasilitas_id', $item['fasilitas_id'])->name ?? '-';
                $wargaNama     = $warga->firstWhere('warga_id', $item['warga_id'])->nama ?? '-';

                return [
                    substr($fasilitasNama, 0, 15) . '...',
                    substr($wargaNama, 0, 15) . '...',
                    Carbon::parse($item['tanggal_mulai'])->format('d/m'),
                    substr($item['tujuan'], 0, 15) . '...',
                    $item['status'],
                    $item['total_biaya'] ? 'Rp ' . number_format($item['total_biaya']) : 'Rp 0',
                ];
            }, array_slice($peminjamanData, 0, 5))
        );
    }
}
