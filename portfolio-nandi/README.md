# Portfolio Nandi — Spec & Context Pack

Kumpulan file spesifikasi untuk membangun **website portofolio 3D monokrom dinamis** milik Nandi Rifki Baihaqi. File-file ini dirancang agar bisa dibaca langsung oleh Claude Code (atau kamu sendiri) sebagai konteks project, jadi kamu tidak perlu menjelaskan ulang tiap kali membuka sesi baru.

## Stack

- **Frontend:** Vue 3 (Composition API, Vite) — seluruh sisi publik
- **3D & motion:** Three.js + GSAP
- **Backend / admin panel:** Laravel 11
- **Database:** MySQL
- **Sumber data awal:** CV Nandi → sudah dijadikan seeder di `database/seeders/`

## Cara pakai file ini di Claude Code

1. Taruh seluruh folder ini di root project kamu.
2. Buka Claude Code di folder itu, lalu suruh Claude membaca `docs/` dulu:
   > "Baca semua file di folder docs, lalu mulai scaffold frontend Vue sesuai `docs/05-FRONTEND-VUE.md`."
3. Untuk backend, arahkan ke `docs/06-BACKEND-LARAVEL.md` dan seeder yang sudah ada.

## Urutan baca yang disarankan

| File | Isi |
|------|-----|
| `docs/01-PROJECT-BRIEF.md` | Visi, tujuan, siapa Nandi, target audiens |
| `docs/02-DESIGN-SYSTEM.md` | Aturan desain 3D hitam-putih, token warna, tipografi, motion |
| `docs/03-DATABASE-SCHEMA.md` | Tabel MySQL & relasinya |
| `docs/04-SECTIONS-SITEMAP.md` | Daftar section/menu (termasuk yang mirip referensi + tambahan) |
| `docs/05-FRONTEND-VUE.md` | Struktur komponen Vue + implementasi 3D |
| `docs/06-BACKEND-LARAVEL.md` | API, model, admin panel |
| `database/seeders/*` | Data asli Nandi, siap `php artisan db:seed` |

## Catatan penting soal data

Data di seeder diambil dari CV Nandi. Beberapa bagian (misalnya daftar skill teknis) aku lengkapi mengikuti struktur referensi yang kamu kasih supaya portofolionya terlihat penuh — silakan **edit sesuai kemampuan yang benar-benar kamu kuasai** sebelum dipublikasikan, biar jujur dan tidak overclaim saat wawancara kerja.
