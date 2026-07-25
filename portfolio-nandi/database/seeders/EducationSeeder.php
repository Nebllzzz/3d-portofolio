<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'level'       => 'Sekolah Dasar',
                'institution' => 'SDN 1 Nataendah',
                'year_start'  => 2013,
                'year_end'    => 2019,
                'sort_order'  => 1,
            ],
            [
                'level'       => 'Sekolah Menengah Pertama',
                'institution' => 'SMPN 3 Margahayu',
                'year_start'  => 2019,
                'year_end'    => 2022,
                'sort_order'  => 2,
            ],
            [
                'level'       => 'Sekolah Menengah Kejuruan',
                'institution' => 'SMK MARHAS Margahayu',
                'year_start'  => 2022,
                'year_end'    => 2025,
                'sort_order'  => 3,
            ],
        ];

        foreach ($data as $row) {
            DB::table('educations')->insert(array_merge($row, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
