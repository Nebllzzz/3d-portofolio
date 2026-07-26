# 01 — Project Brief

## Subjek

Website portofolio pribadi untuk **Nandi Rifki Baihaqi**, seorang lulusan SMK (RPL/sejenis) kelahiran Bandung 2007 yang bercita-cita jadi programmer. Portofolio ini adalah kartu nama digital: dibuka oleh HR, rekruter, atau calon klien untuk menilai kemampuan Nandi dalam waktu kurang dari satu menit.

## Satu tugas utama halaman

Meyakinkan pengunjung — dalam 30 detik pertama — bahwa Nandi bisa membangun aplikasi web nyata (bukan cuma teori). Bukti utamanya: dua project kasir (bioskop PHP native + caffee Laravel) dan kemampuan full-stack dasar.

## Audiens

1. **Rekruter / HR** — cari bukti skill, pengalaman, kontak.
2. **Lead developer** — cek kualitas kode lewat link Source Code.
3. **Klien kecil / UMKM** — cari orang yang bisa bikin aplikasi kasir/CRUD sederhana.

## Kenapa 3D monokrom dinamis

Portofolio developer junior hampir semuanya seragam: template gelap, aksen ungu/hijau, kartu project biasa. Nandi minta pembeda. Arahnya: **monokrom (hitam–putih–abu) yang kedalamannya datang dari 3D, cahaya, dan gerak — bukan dari warna.** Ini justru lebih sulit ditiru dan terlihat lebih "sengaja dirancang" daripada sekadar menempel warna neon.

Prinsipnya: warna dikunci ke grayscale, jadi seluruh "wow" harus dibawa oleh:
- Objek 3D di hero (Three.js)
- Parallax & depth antar-layer saat scroll
- Micro-interaction saat hover (bayangan, tilt, cahaya bergerak)

## Tujuan terukur

- Hero tampil < 2 detik di koneksi 4G (objek 3D lazy-load, ada fallback statis).
- Semua data (profil, skill, project, pengalaman) berasal dari database, **bukan hardcode** — supaya Nandi bisa update lewat admin panel tanpa sentuh kode.
- Responsif sampai layar HP; animasi hormati `prefers-reduced-motion`.

## Yang HARUS ada

- Hero dengan objek 3D + nama Nandi
- Section Profil / About
- Section Skill Teknis (dikelompokkan, seperti referensi)
- Section Project (dengan tag teknologi + link Source Code / Live Demo)
- Section Pengalaman & Pendidikan (timeline)
- Section Kontak (form + link sosial)
- Admin panel Laravel untuk CRUD semua data di atas

## Non-goal (jangan dikerjakan dulu)

- Blog / CMS artikel
- Multi-bahasa (cukup Indonesia dulu)
- Autentikasi publik (login hanya untuk admin)
