<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin untuk panel (ganti password sebelum production!)
        User::firstOrCreate(
            ['email' => 'nandizailani@gmail.com'],
            [
                'name'     => 'Nandi Rifki Baihaqi',
                'password' => Hash::make('ubah_password_ini'),
            ]
        );

        $this->call([
            ProfileSeeder::class,
            EducationSeeder::class,
            SkillSeeder::class,
            ProjectSeeder::class,
            ExperienceSeeder::class,
        ]);
    }
}
