<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $profileId = DB::table('profiles')->insertGetId([
            'full_name'   => 'Nandi Rifki Baihaqi',
            'nickname'    => 'Nandi',
            'headline'    => 'Aspiring Programmer · Web Developer',
            'bio'         => 'Saya Nandi Rifki Baihaqi, biasa dipanggil Nandi. Lahir di Bandung, 8 September 2007, anak kedua dari empat bersaudara. Selain belajar, saya suka berolahraga, bermain game, dan mengeksplor hal baru. Cita-cita saya menjadi seorang programmer yang sukses, dan untuk itu saya selalu antusias belajar hal-hal baru.',
            'birth_place' => 'Bandung',
            'birth_date'  => '2007-09-08',
            'address'     => 'Jln Sadang, RT 04 RW 09, Desa Margahayu Tengah, Kec. Margahayu, Kab. Bandung, Jawa Barat',
            'phone'       => '+62 899 1708 260',
            'email'       => 'nandizailani@gmail.com',
            'photo_path'  => null,
            'cv_path'     => null,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $socials = [
            ['platform' => 'github',   'label' => 'GitHub',    'url' => 'https://github.com/username-nandi', 'icon' => 'github',   'sort_order' => 1],
            ['platform' => 'linkedin', 'label' => 'LinkedIn',  'url' => 'https://linkedin.com/in/username-nandi', 'icon' => 'linkedin', 'sort_order' => 2],
            ['platform' => 'email',    'label' => 'Email',     'url' => 'mailto:nandizailani@gmail.com', 'icon' => 'mail', 'sort_order' => 3],
            ['platform' => 'whatsapp', 'label' => 'WhatsApp',  'url' => 'https://wa.me/628991708260', 'icon' => 'whatsapp', 'sort_order' => 4],
        ];

        foreach ($socials as $s) {
            DB::table('socials')->insert(array_merge($s, [
                'profile_id' => $profileId,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
