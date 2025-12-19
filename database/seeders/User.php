<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class User extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Data admin dengan password khusus
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // password khusus admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 100 user dengan password random
        $users = [];
        for ($i = 0; $i < 100; $i++) {
            $users[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make($faker->password(8, 12)), // password random 8-12 karakter
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users);

        echo "Seeder berhasil! 101 user dibuat.\n";
        echo "Admin: admin@example.com / admin123\n";
        echo "User lain: password random\n";
    }
}
