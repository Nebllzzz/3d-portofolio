<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    /**
     * Struktur kategori mengikuti referensi (Bahasa Pemrograman, Backend,
     * Front End, Alat Pengembang). Isi disesuaikan dengan CV Nandi
     * (fokus Laravel, PHP, MySQL) + skill dasar web.
     *
     * PENTING: edit daftar ini agar hanya berisi yang benar-benar kamu kuasai
     * sebelum dipublikasikan.
     */
    public function run(): void
    {
        $categories = [
            'Bahasa Pemrograman' => [
                ['name' => 'PHP',        'icon' => 'php',        'level' => 4],
                ['name' => 'JavaScript', 'icon' => 'javascript', 'level' => 3],
                ['name' => 'SQL',        'icon' => 'mysql',      'level' => 4],
                ['name' => 'HTML',       'icon' => 'html5',      'level' => 4],
                ['name' => 'CSS',        'icon' => 'css3',       'level' => 4],
            ],
            'Backend Teknologi' => [
                ['name' => 'Laravel',  'icon' => 'laravel',  'level' => 4],
                ['name' => 'MySQL',    'icon' => 'mysql',    'level' => 4],
                ['name' => 'REST API', 'icon' => 'api',      'level' => 3],
            ],
            'Front End Teknologi' => [
                ['name' => 'Vue.js',    'icon' => 'vuejs',     'level' => 3],
                ['name' => 'Bootstrap', 'icon' => 'bootstrap', 'level' => 3],
                ['name' => 'Tailwind',  'icon' => 'tailwind',  'level' => 3],
            ],
            'Alat Pengembang' => [
                ['name' => 'Git',    'icon' => 'git',    'level' => 3],
                ['name' => 'GitHub', 'icon' => 'github', 'level' => 3],
                ['name' => 'VS Code','icon' => 'vscode', 'level' => 4],
                ['name' => 'Figma',  'icon' => 'figma',  'level' => 3],
                ['name' => 'XAMPP',  'icon' => 'server', 'level' => 4],
                ['name' => 'Composer','icon' => 'composer','level' => 3],
                ['name' => 'Postman','icon' => 'postman','level' => 3],
            ],
        ];

        $catOrder = 1;
        foreach ($categories as $catName => $skills) {
            $categoryId = DB::table('skill_categories')->insertGetId([
                'name'       => $catName,
                'slug'       => Str::slug($catName),
                'sort_order' => $catOrder++,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $skillOrder = 1;
            foreach ($skills as $skill) {
                DB::table('skills')->insert([
                    'skill_category_id' => $categoryId,
                    'name'              => $skill['name'],
                    'icon'              => $skill['icon'],
                    'level'             => $skill['level'],
                    'sort_order'        => $skillOrder++,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }
        }
    }
}
