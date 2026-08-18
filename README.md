# Portfolio Nandi — 3D Monokrom

Website portofolio 3D monokrom dinamis milik **Nandi Rifki Baihaqi**. Repo ini adalah monorepo: Laravel (API + admin panel) dan Vue 3 (sisi publik) hidup berdampingan, dengan spesifikasi lengkap di `docs/`.

## Stack

- **Frontend:** Vue 3 (Composition API, Vite) — seluruh sisi publik
- **3D & motion:** Three.js + GSAP
- **Backend / admin panel:** Laravel 11
- **Database:** MySQL
- **Sumber data awal:** CV Nandi → sudah dijadikan seeder di `backend/database/seeders/`

## Struktur repo

```
3d-portofolio/
├── docker-compose.yml   # frontend + backend + MySQL
├── docker/              # config nginx & php untuk container
├── docs/          # spesifikasi (baca ini dulu)
├── backend/       # Laravel 11 — API + admin panel
│   └── database/
│       ├── migrations/   # 11 tabel sesuai docs/03-DATABASE-SCHEMA.md
│       └── seeders/      # data asli dari CV Nandi
└── frontend/      # Vue 3 + Vite + Three.js + GSAP
```

## Menjalankan

### Docker Compose (paling cepat)

Butuh Docker + Docker Compose v2. Semua service (frontend, backend, MySQL) jalan di satu
network `portofolio-net` dan saling panggil pakai nama service.

```bash
cp .env.example .env          # opsional; untuk mengganti UID/GID atau kredensial default lokal
docker compose up -d --build
```

| Port | Service | URL |
|------|---------|-----|
| **7010** | Frontend Vue 3 (Vite dev server, hot reload) | http://localhost:7010 |
| **7011** | Backend Laravel — API + panel Filament | http://localhost:7011 · http://localhost:7011/admin |
| — | MySQL 8.4 | Hanya dapat diakses container di network `portofolio-net` |

Migration dan seeding awal jalan otomatis tiap container `backend` start. Folder `backend/` dan `frontend/`
di-bind mount, jadi perubahan kode langsung kepakai tanpa rebuild — kecuali kalau kamu ubah
`Dockerfile`/`docker-entrypoint.sh`, itu perlu `docker compose build`.

Perintah harian:

```bash
docker compose logs -f backend frontend     # lihat log
docker compose exec backend php artisan …   # artisan
docker compose exec frontend npm i <paket>  # tambah dependency frontend
docker compose down                         # stop (data DB tetap aman di volume)
docker compose down -v                      # stop + hapus data DB
```

Kenapa `UID`/`GID` di `.env` penting: container backend menulis ke `storage/` dan
`bootstrap/cache/` lewat bind mount. Kalau UID-nya beda dengan user host, file hasil tulisan
container jadi milik user lain dan bikin error permission saat kamu jalan di host.

### Manual (tanpa Docker)

#### Backend

```bash
cd backend
cp .env.example .env          # isi DB_USERNAME, DB_PASSWORD, dan ADMIN_PASSWORD
php artisan key:generate
mysql -u root -p -e "CREATE DATABASE portfolio_nandi"
php artisan migrate --seed
php artisan serve             # http://localhost:8000
```

Untuk Docker lokal, kredensial admin default ada di `.env.example`; ganti `ADMIN_PASSWORD` sebelum deployment. Panel admin ada di `/admin`.

Belum punya kredensial MySQL? Untuk coba cepat, ganti `DB_CONNECTION=sqlite` di `.env`, jalankan `touch database/database.sqlite`, lalu `php artisan migrate --seed`.

#### Frontend

```bash
cd frontend
cp .env.example .env          # VITE_API_URL=http://localhost:8000
npm install
npm run dev                   # http://localhost:5173
```

## Urutan baca dokumentasi

| File | Isi |
|------|-----|
| `docs/01-PROJECT-BRIEF.md` | Visi, tujuan, siapa Nandi, target audiens |
| `docs/02-DESIGN-SYSTEM.md` | Aturan desain 3D hitam-putih, token warna, tipografi, motion |
| `docs/03-DATABASE-SCHEMA.md` | Tabel MySQL & relasinya |
| `docs/04-SECTIONS-SITEMAP.md` | Daftar section/menu (termasuk yang mirip referensi + tambahan) |
| `docs/05-FRONTEND-VUE.md` | Struktur komponen Vue + implementasi 3D |
| `docs/06-BACKEND-LARAVEL.md` | API, model, admin panel |
| `backend/database/seeders/*` | Data asli Nandi, siap `php artisan db:seed` |

## Status

Sudah jadi:

- Struktur monorepo, Laravel 11 + Vue 3 terpasang
- 11 migration sesuai skema, teruji jalan bersama seeder
- API publik: 6 endpoint + rate limit di form kontak
- Frontend Vue lengkap: 6 section, hero 3D Three.js, terpasang ke API
- Admin panel Filament v5 di `/admin` — CRUD semua konten, upload foto/CV, kotak masuk pesan

Belum dikerjakan:

- Deploy (hosting, domain, HTTPS)
- Upgrade Laravel 12 (lihat catatan keamanan di bawah)

## Catatan keamanan

`composer audit` melaporkan CVE-2026-48019 (CRLF injection di rule validasi `email`) yang
mempengaruhi semua Laravel 11. Mitigasi sementara sudah dipasang: form kontak memakai
`email:strict`, bukan rule `email` bawaan. Perbaikan sebenarnya ada di Laravel 12.60+,
jadi upgrade tetap disarankan sebelum situs dipublikasikan.

## Catatan penting soal data

Data di seeder diambil dari CV Nandi. Beberapa bagian (misalnya daftar skill teknis) dilengkapi mengikuti struktur referensi supaya portofolionya terlihat penuh — **edit sesuai kemampuan yang benar-benar kamu kuasai** sebelum dipublikasikan, biar jujur dan tidak overclaim saat wawancara kerja.

Yang masih perlu diisi manual:

- Password admin di `backend/database/seeders/DatabaseSeeder.php` (masih `ubah_password_ini`)
- URL LinkedIn di `ProfileSeeder.php` (masih placeholder)
- Nama repo project di `ProjectSeeder.php` (`kasir-caffee`, `kasir-bioskop`) — pastikan cocok dengan repo asli
