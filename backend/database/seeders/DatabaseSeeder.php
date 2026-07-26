<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin panel. Password dibaca dari .env (tidak masuk git).
        // Kalau ADMIN_PASSWORD belum diisi, seeder berhenti daripada
        // membuat akun dengan password yang bisa ditebak.
        $password = env('ADMIN_PASSWORD');

        if (blank($password)) {
            throw new RuntimeException(
                'ADMIN_PASSWORD belum diisi di .env. Isi dulu sebelum menjalankan db:seed.'
            );
        }

        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'nandizailani@gmail.com')],
            [
                'name' => 'Nandi Rifki Baihaqi',
                'password' => Hash::make($password),
            ]
        );

        // Seeder konten memakai insert biasa, jadi hanya dijalankan saat
        // tabelnya masih kosong — supaya `db:seed` aman diulang.
        $content = [
            ProfileSeeder::class => 'profiles',
            EducationSeeder::class => 'educations',
            SkillSeeder::class => 'skill_categories',
            ProjectSeeder::class => 'projects',
            ExperienceSeeder::class => 'experiences',
        ];

        foreach ($content as $seeder => $table) {
            if (DB::table($table)->exists()) {
                $this->command?->info("Lewati {$seeder} — tabel {$table} sudah terisi.");

                continue;
            }

            $this->call($seeder);
        }
    }
}
