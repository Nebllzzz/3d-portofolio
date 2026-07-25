# 06 — Backend (Laravel 11 + MySQL)

Laravel berperan sebagai (1) **API** untuk frontend Vue dan (2) **admin panel** untuk Nandi mengelola konten.

## Setup

```bash
composer create-project laravel/laravel portfolio-backend
cd portfolio-backend
# set DB di .env → mysql, buat database "portfolio_nandi"
php artisan migrate
php artisan db:seed        # menjalankan seeder di database/seeders/
```

## Model & relasi

Buat model sesuai `03-DATABASE-SCHEMA.md`:

- `Profile` hasMany `Social`
- `SkillCategory` hasMany `Skill`
- `Project` hasMany `ProjectPoint`, hasMany `ProjectTag`
- `Experience` hasMany `ExperiencePoint`
- `Education`
- `Contact`

## API routes (`routes/api.php`)

Read-only untuk publik (frontend), tanpa auth:

```
GET  /api/profile          → profil + socials
GET  /api/skills           → kategori + skills (nested)
GET  /api/projects         → projects + points + tags
GET  /api/experiences      → experiences + points
GET  /api/educations       → list pendidikan
POST /api/contact          → simpan pesan (validasi: name, email, message)
```

Bungkus tiap resource dengan API Resource (`php artisan make:resource`) supaya bentuk JSON rapi dan konsisten dengan yang diharapkan Vue.

Aktifkan CORS untuk origin frontend (`config/cors.php`).

## Admin panel

Dua pilihan — pilih sesuai kenyamanan:

**Opsi A (cepat & rapi): Filament**
```bash
composer require filament/filament
php artisan filament:install --panels
php artisan make:filament-user
```
Lalu generate resource untuk tiap model:
```bash
php artisan make:filament-resource Project --generate
```
Filament memberi CRUD lengkap, upload gambar, dan reorder (`sort_order`) tanpa banyak koding. Sangat cocok karena Nandi sudah familiar Laravel.

**Opsi B (manual):** Blade + controller CRUD standar dengan middleware `auth`. Lebih banyak kerja, tapi tanpa dependency tambahan.

> Rekomendasi: **Filament**. Hemat waktu, dan Nandi cukup fokus mengisi data.

## Upload file

- Foto profil, cover project, CV → `storage/app/public`, jalankan `php artisan storage:link`.
- Simpan path di kolom `*_path`, expose via `asset('storage/...')`.

## Keamanan minimum

- Validasi semua input form kontak.
- Rate limit `POST /api/contact` (mis. `throttle:5,1`) biar tidak dispam.
- Admin panel di balik login; jangan pakai kredensial default.

## Alur data end-to-end

```
Vue (fetch) ──GET /api/*──> Laravel Controller ──> Model ──> MySQL (data seeder Nandi)
Form kontak ──POST /api/contact──> validasi ──> tabel contacts ──> muncul di admin
Nandi edit di Filament ──> update MySQL ──> frontend otomatis ikut berubah
```
