<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            User::class,               // Akun login admin
            WargaSeeder::class,              // Data warga (master)
            FasilitasUmumSeeder::class,      // Data fasilitas (master)
            PeminjamanFasilitasSeeder::class,// Peminjaman (tergantung fasilitas & warga)
            PembayaranFasilitasSeeder::class,// Pembayaran (tergantung peminjaman)
            SyaratFasilitasSeeder::class,    // Syarat (tergantung fasilitas)
            PetugasFasilitasSeeder::class,   // Petugas (tergantung fasilitas & warga)
        ]);
    }
}
