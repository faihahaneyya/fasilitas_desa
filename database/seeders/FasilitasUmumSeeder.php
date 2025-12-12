<?php
namespace Database\Seeders;

use App\Models\FasilitasUmum;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FasilitasUmumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Data jenis fasilitas umum lengkap
        $jenisFasilitas = [
            'Balai RW', 'Balai RT', 'Posyandu', 'Poskamling', 'Musholla',
            'Masjid', 'Gereja', 'Pura', 'Vihara', 'Tempat Parkir Umum',
            'Taman', 'Lapangan Olahraga', 'Pos Ronda', 'Ruang Serbaguna',
            'Perpustakaan', 'Ruang Pertemuan', 'Pos Kesehatan', 'Kantor RW',
            'Kantor RT', 'TPA (Tempat Penitipan Anak)', 'Pos PAUD',
            'Sanggar Seni', 'Ruang Kreatif', 'Pasar Rakyat', 'Warung Makan Umum',
            'Toilet Umum', 'Tempat Sampah Terpadu', 'Bank Sampah', 'Kolam Renang Umum',
            'GOR (Gelanggang Olahraga)', 'Lapangan Basket', 'Lapangan Voli', 'Lapangan Badminton',
            'Futsal', 'Tempat Fitness', 'Jogging Track', 'Tempat Bermain Anak',
            'Gazebo', 'Pondok Baca', 'Ruang Laktasi', 'Pospindu',
            'Posbindu', 'Klinik', 'Apotik', 'ATM Center', 'Area Wi-Fi Publik',
            'Charging Station', 'Ruang Tunggu', 'Shelter', 'Halte Bus',
            'Area Parkir Sepeda', 'Bike Sharing',
        ];

        // Nama fasilitas berdasarkan jenis
        $namaFasilitas = [
            'Balai RW'          => ['Balai RW 01', 'Balai RW 02', 'Balai RW 03', 'Balai RW 04', 'Balai RW 05'],
            'Balai RT'          => ['Balai RT 001', 'Balai RT 002', 'Balai RT 003', 'Balai RT 004', 'Balai RT 005'],
            'Posyandu'          => ['Posyandu Melati', 'Posyandu Mawar', 'Posyandu Anggrek', 'Posyandu Flamboyan', 'Posyandu Kenanga'],
            'Poskamling'        => ['Poskamling 1', 'Poskamling 2', 'Poskamling 3', 'Poskamling 4', 'Poskamling 5'],
            'Musholla'          => ['Musholla Al-Ikhlas', 'Musholla Al-Hidayah', 'Musholla Nurul Iman', 'Musholla Baiturrahman', 'Musholla Al-Falah'],
            'Masjid'            => ['Masjid Al-Barkah', 'Masjid Nurul Huda', 'Masjid Baitul Makmur', 'Masjid At-Taqwa', 'Masjid Al-Istiqomah'],
            'Gereja'            => ['Gereja Kristen', 'Gereja Katolik', 'Gereja Protestan', 'Gereja Pantekosta', 'Gereja Advent'],
            'Pura'              => ['Pura Agung', 'Pura Segara', 'Pura Penataran', 'Pura Dalem', 'Pura Merajan'],
            'Vihara'            => ['Vihara Avalokitesvara', 'Vihara Bodhi', 'Vihara Maitreya', 'Vihara Sakyamuni', 'Vihara Metta'],
            'Taman'             => ['Taman Kota', 'Taman Bermain', 'Taman Rekreasi', 'Taman Hijau', 'Taman Flora'],
            'Lapangan Olahraga' => ['Lapangan Sepak Bola', 'Lapangan Serbaguna', 'Lapangan Tenis', 'Lapangan Bulutangkis'],
            'Perpustakaan'      => ['Perpustakaan Keliling', 'Perpustakaan Mini', 'Rumah Baca', 'Taman Bacaan'],
            'Ruang Serbaguna'   => ['Aula Serbaguna', 'Ruang Multi Fungsi', 'Hall Pertemuan', 'Ruang Acara'],
            'Pasar Rakyat'      => ['Pasar Pagi', 'Pasar Sore', 'Pasar Tradisional', 'Pasar Murah'],
            'Warung Makan Umum' => ['Warung Makan Rakyat', 'Kantin Umum', 'Food Court', 'Warung Padang'],
            'Bank Sampah'       => ['Bank Sampah Induk', 'Bank Sampah Unit', 'TPS 3R', 'Bank Sampah Mandiri'],
            'Kolam Renang Umum' => ['Kolam Renang Publik', 'Water Park Mini', 'Kolam Renang Anak', 'Kolam Renang Dewasa'],
            'GOR'               => ['GOR Serbaguna', 'GOR Indoor', 'GOR Outdoor', 'GOR Mini'],
            'TPA'               => ['TPA Ceria', 'TPA Bunda', 'TPA Kasih Ibu', 'TPA Mutiara'],
            'Sanggar Seni'      => ['Sanggar Tari', 'Sanggar Musik', 'Sanggar Lukis', 'Sanggar Teater'],
        ];

        // Kapasitas berdasarkan jenis fasilitas (min, max)
        $kapasitasRange = [
            'Balai RW'          => [50, 200],
            'Balai RT'          => [20, 50],
            'Posyandu'          => [10, 30],
            'Poskamling'        => [5, 10],
            'Musholla'          => [30, 100],
            'Masjid'            => [100, 1000],
            'Gereja'            => [50, 500],
            'Pura'              => [30, 200],
            'Vihara'            => [20, 150],
            'Taman'             => [50, 500],
            'Lapangan Olahraga' => [20, 100],
            'Perpustakaan'      => [10, 50],
            'Ruang Serbaguna'   => [30, 200],
            'Pasar Rakyat'      => [50, 300],
            'Warung Makan Umum' => [20, 100],
            'Bank Sampah'       => [5, 20],
            'Kolam Renang Umum' => [20, 100],
            'GOR'               => [100, 500],
            'TPA'               => [10, 30],
            'Sanggar Seni'      => [10, 40],
        ];

        // Array untuk menyimpan fasilitas yang dibuat
        $fasilitasData = [];

        for ($i = 1; $i <= 100; $i++) {
            // Pilih jenis fasilitas random
            $jenis = $faker->randomElement($jenisFasilitas);

            // Tentukan nama fasilitas berdasarkan jenis
            $nama = '';
            if (isset($namaFasilitas[$jenis])) {
                $nama = $faker->randomElement($namaFasilitas[$jenis]) . ' ' . $faker->randomElement(['I', 'II', 'III', 'IV', 'V']);
            } else {
                $nama = $jenis . ' ' . $faker->streetName . ' ' . $faker->randomElement(['I', 'II', 'III', 'IV']);
            }

            // Generate alamat lengkap
            $alamat = 'Jl. ' . $faker->streetName . ' No. ' . $faker->buildingNumber;

            // Generate RT dan RW yang realistis
            $rt = str_pad($faker->numberBetween(1, 20), 3, '0', STR_PAD_LEFT);
            $rw = str_pad($faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT);

            // Tentukan kapasitas berdasarkan jenis
            $kapasitas = null;
            if (isset($kapasitasRange[$jenis])) {
                $range     = $kapasitasRange[$jenis];
                $kapasitas = $faker->numberBetween($range[0], $range[1]);
            } else {
                $kapasitas = $faker->optional(0.8, null)->numberBetween(10, 500);
            }

            // Generate deskripsi yang informatif
            $deskripsi = "{$jenis} {$nama} yang terletak di {$alamat}, RT {$rt}/RW {$rw}. ";
            $deskripsi .= $faker->paragraph(2);

            // Tambahkan fasilitas ke array
            $fasilitasData[] = [
                'name'       => $nama,
                'jenis'      => $jenis,
                'alamat'     => $alamat,
                'rt'         => $rt,
                'rw'         => $rw,
                'kapasitas'  => $kapasitas,
                'deskripsi'  => $deskripsi,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Progress indicator
            if ($i % 10 === 0) {
                $this->command->info("Created {$i} fasilitas records...");
            }
        }

        // Insert semua data sekaligus untuk performa lebih baik
        FasilitasUmum::insert($fasilitasData);

        $this->command->info('✅ Successfully seeded 100 fasilitas umum records!');

        // Tampilkan contoh data yang dibuat
        $this->command->table(
            ['Name', 'Jenis', 'Alamat', 'RT/RW', 'Kapasitas'],
            array_map(function ($item) {
                return [
                    $item['name'],
                    $item['jenis'],
                    substr($item['alamat'], 0, 20) . '...',
                    "RT {$item['rt']}/RW {$item['rw']}",
                    $item['kapasitas'] ?? '-',
                ];
            }, array_slice($fasilitasData, 0, 5))
        );
    }
}
