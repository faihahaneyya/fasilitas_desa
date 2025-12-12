<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warga;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Data agama di Indonesia
        $agama = ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        // Data pekerjaan umum
        $pekerjaan = [
            'PNS', 'Guru', 'Dosen', 'Dokter', 'Perawat', 'Bidan', 'Apoteker',
            'Pengusaha', 'Wiraswasta', 'Pedagang', 'Karyawan Swasta', 'Buruh',
            'Petani', 'Nelayan', 'Sopir', 'Teknisi', 'Arsitek', 'Akuntan',
            'Programmer', 'Desainer', 'Marketing', 'Satpam', 'Cleaning Service',
            'Ibu Rumah Tangga', 'Pelajar', 'Mahasiswa', 'Pensiunan'
        ];

        // Domain email Indonesia
        $emailDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'ymail.com', 'rocketmail.com'];

        // Array untuk menyimpan nomor KTP yang sudah digunakan
        $usedKtp = [];

        for ($i = 1; $i <= 100; $i++) {
            // Generate nomor KTP unik (16 digit)
            do {
                $no_ktp = $faker->numerify('################'); // 16 digit
            } while (in_array($no_ktp, $usedKtp));

            $usedKtp[] = $no_ktp;

            // Generate nama lengkap Indonesia
            $nama = $faker->name;

            // Jenis kelamin random
            $jenis_kelamin = $faker->randomElement(['L', 'P']);

            // Untuk nama, sesuaikan dengan jenis kelamin jika perlu
            if ($jenis_kelamin === 'L' && strpos($nama, 'Mrs') !== false) {
                $nama = str_replace('Mrs', 'Mr', $nama);
            } elseif ($jenis_kelamin === 'P' && strpos($nama, 'Mr') !== false) {
                $nama = str_replace('Mr', 'Mrs', $nama);
            }

            // Generate nomor telepon Indonesia
            $telp = $faker->numerify('08##########');

            // Buat email dari nama
            $username = strtolower(str_replace(' ', '.', $nama));
            $username = preg_replace('/[^a-z0-9.]/', '', $username);
            $email = $username . '@' . $faker->randomElement($emailDomains);

            // Data untuk disimpan
            $warga = [
                'no_ktp' => $no_ktp,
                'nama' => $nama,
                'jenis_kelamin' => $jenis_kelamin,
                'agama' => $faker->randomElement($agama),
                'pekerjaan' => $faker->randomElement($pekerjaan),
                'telp' => $telp,
                'email' => $email,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Warga::create($warga);

            // Progress indicator
            if ($i % 10 === 0) {
                $this->command->info("Created {$i} warga records...");
            }
        }

        $this->command->info('✅ Successfully seeded 100 warga records!');
    }
}
