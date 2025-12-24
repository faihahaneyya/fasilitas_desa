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
        // Inisialisasi Faker dengan locale Indonesia
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            Warga::create([
                'no_ktp' => $faker->unique()->numerify('################'),
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik']),
                'pekerjaan' => $faker->jobTitle(),
                'telp' => substr($faker->e164PhoneNumber(), 0, 15),
                'email' => $faker->unique()->safeEmail(),
            ]);
        }
    }
}