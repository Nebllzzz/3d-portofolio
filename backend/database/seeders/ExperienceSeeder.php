<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'title'      => 'Website Admin & Kasir Bioskop',
                'subtitle'   => 'Menggunakan PHP Native',
                'date_label' => '12 Mei 2024',
                'points'     => [
                    'Perancangan awal: analisis kebutuhan sistem, flowmap, dan ERD.',
                    'Membuat skema database MySQL dengan relasi jelas.',
                    'Mendesain website dengan Figma.',
                    'Menulis back-end dan front-end di Visual Studio Code.',
                    'Fitur CRUD, cetak struk, laporan penjualan, dashboard, login/logout.',
                    'Menguji dan mempresentasikan hasil.',
                ],
            ],
            [
                'title'      => 'Website Admin & Kasir Caffee',
                'subtitle'   => 'Menggunakan Framework Laravel',
                'date_label' => '23 Oktober 2024',
                'points'     => [
                    'Melanjutkan dari skema database MySQL yang diberikan dan menambah tabel.',
                    'Instalasi Laravel (XAMPP, Composer, Git) via terminal.',
                    'Fitur CRUD, cetak struk, laporan penjualan, dashboard, login/logout.',
                    'Menambahkan hak akses berdasarkan level user yang login.',
                    'Menguji dan mempresentasikan hasil.',
                ],
            ],
            [
                'title'      => 'Organisasi Siswa Intra Sekolah (OSIS)',
                'subtitle'   => 'Seksi Bidang Keagamaan',
                'date_label' => '2022 – 2024',
                'points'     => [
                    'Mengembangkan public speaking dan kepemimpinan.',
                    'Melatih manajemen waktu, inisiatif, dan tanggung jawab.',
                    'Terbiasa bekerja di bawah tekanan dan berpikir kritis.',
                ],
            ],
        ];

        $order = 1;
        foreach ($experiences as $e) {
            $experienceId = DB::table('experiences')->insertGetId([
                'title'      => $e['title'],
                'subtitle'   => $e['subtitle'],
                'date_label' => $e['date_label'],
                'sort_order' => $order++,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $pointOrder = 1;
            foreach ($e['points'] as $point) {
                DB::table('experience_points')->insert([
                    'experience_id' => $experienceId,
                    'point'         => $point,
                    'sort_order'    => $pointOrder++,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
    }
}
