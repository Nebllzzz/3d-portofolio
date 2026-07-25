<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title'      => 'Aplikasi Admin & Kasir Caffee',
                'summary'    => 'Aplikasi kasir berbasis web untuk mengelola transaksi dan produk sebuah cafe, dibangun dengan Laravel. Dilengkapi hak akses per-level user, cetak struk, dan laporan penjualan.',
                'source_url' => 'https://github.com/username-nandi/kasir-caffee',
                'demo_url'   => null,
                'is_featured'=> true,
                'points'     => [
                    'Merancang skema database MySQL dan menambah tabel kebutuhan.',
                    'Setup lingkungan Laravel (XAMPP, Composer, Git) dari terminal.',
                    'Fitur CRUD untuk beberapa tabel.',
                    'Fitur cetak struk dan cetak laporan penjualan.',
                    'Dashboard, login/logout, dan hak akses berdasarkan level user.',
                    'Menguji aplikasi dan mempresentasikan hasilnya.',
                ],
                'tags' => ['Laravel', 'PHP', 'MySQL', 'HTML', 'CSS', 'JavaScript'],
            ],
            [
                'title'      => 'Aplikasi Admin & Kasir Bioskop',
                'summary'    => 'Aplikasi kasir bioskop berbasis web menggunakan PHP Native, mencakup analisis kebutuhan, perancangan sistem, hingga fitur transaksi dan laporan.',
                'source_url' => 'https://github.com/username-nandi/kasir-bioskop',
                'demo_url'   => null,
                'is_featured'=> true,
                'points'     => [
                    'Analisis kebutuhan sistem: flowmap dan ERD untuk menentukan tabel.',
                    'Membuat skema database MySQL dengan relasi yang jelas.',
                    'Mendesain tampilan website dengan Figma.',
                    'Fitur CRUD untuk beberapa tabel.',
                    'Fitur cetak struk dan laporan penjualan.',
                    'Dashboard, login, dan logout.',
                    'Menguji aplikasi dan mempresentasikan hasilnya.',
                ],
                'tags' => ['PHP Native', 'MySQL', 'HTML', 'CSS', 'Figma'],
            ],
        ];

        $order = 1;
        foreach ($projects as $p) {
            $projectId = DB::table('projects')->insertGetId([
                'title'       => $p['title'],
                'slug'        => Str::slug($p['title']),
                'summary'     => $p['summary'],
                'cover_path'  => null,
                'source_url'  => $p['source_url'],
                'demo_url'    => $p['demo_url'],
                'is_featured' => $p['is_featured'],
                'sort_order'  => $order++,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            $pointOrder = 1;
            foreach ($p['points'] as $point) {
                DB::table('project_points')->insert([
                    'project_id' => $projectId,
                    'point'      => $point,
                    'sort_order' => $pointOrder++,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($p['tags'] as $tag) {
                DB::table('project_tags')->insert([
                    'project_id' => $projectId,
                    'tag'        => $tag,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
