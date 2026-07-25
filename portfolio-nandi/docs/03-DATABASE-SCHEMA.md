# 03 — Database Schema (MySQL)

Semua konten publik disimpan di database supaya bisa diedit lewat admin panel. Di bawah ini tabel + kolom. Migration Laravel mengikuti struktur ini.

## Diagram relasi (ringkas)

```
profiles (1)
socials (banyak) ─────────── milik profile
educations (banyak)
experiences (1) ── (banyak) experience_points
skill_categories (1) ── (banyak) skills
projects (1) ── (banyak) project_tags
                └─ (banyak) project_points
contacts (banyak)  ← pesan masuk dari form kontak
users              ← admin panel (bawaan Laravel)
```

## Tabel

### `profiles`
Data diri utama (hanya 1 baris).

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| full_name | varchar | "Nandi Rifki Baihaqi" |
| nickname | varchar | "Nandi" |
| headline | varchar | mis. "Aspiring Programmer · Web Developer" |
| bio | text | paragraf profil dari CV |
| birth_place | varchar | "Bandung" |
| birth_date | date | 2007-09-08 |
| address | varchar | alamat dari CV |
| phone | varchar | +62 899 1708 260 |
| email | varchar | nandizailani@gmail.com |
| photo_path | varchar nullable | foto profil |
| cv_path | varchar nullable | file CV untuk diunduh |
| timestamps | | |

### `socials`
Link sosial (GitHub, LinkedIn, dll).

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| platform | varchar | "github", "linkedin", "email", "whatsapp" |
| label | varchar | teks tampil |
| url | varchar | |
| icon | varchar | nama ikon |
| sort_order | int | urutan tampil |

### `educations`
Riwayat pendidikan (timeline).

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| level | varchar | "Elementary School", dst |
| institution | varchar | "SDN 1 Nataendah" |
| year_start | year | |
| year_end | year | |
| sort_order | int | |

### `skill_categories`
Kelompok skill (seperti "Bahasa Pemrograman", "Backend", dst di referensi).

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| name | varchar | "Bahasa Pemrograman" |
| slug | varchar | |
| sort_order | int | |

### `skills`
Item skill di dalam kategori.

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| skill_category_id | FK | |
| name | varchar | "Laravel" |
| icon | varchar nullable | nama/ikon (mis. devicon) |
| level | tinyint nullable | 1–5 opsional, untuk bar/kedalaman |
| sort_order | int | |

### `projects`
Kartu project.

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| title | varchar | "Kasir Caffee" |
| slug | varchar | |
| summary | text | deskripsi singkat |
| cover_path | varchar nullable | gambar/preview |
| source_url | varchar nullable | link GitHub |
| demo_url | varchar nullable | link live demo |
| is_featured | boolean | tampil di atas |
| sort_order | int | |
| timestamps | | |

### `project_points`
Poin fitur/bullet tiap project.

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| project_id | FK | |
| point | varchar | 1 bullet |
| sort_order | int | |

### `project_tags`
Tag teknologi per project (HTML, CSS, Laravel, dst).

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| project_id | FK | |
| tag | varchar | "Laravel" |

### `experiences`
Pengalaman (timeline utama di CV).

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| title | varchar | "Website Admin & Kasir Bioskop" |
| subtitle | varchar nullable | "Menggunakan PHP Native" |
| date_label | varchar | "12 Mei 2024" |
| sort_order | int | |

### `experience_points`
Bullet detail per pengalaman.

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| experience_id | FK | |
| point | varchar | |
| sort_order | int | |

### `contacts`
Pesan masuk dari form kontak (diisi publik, dibaca admin).

| kolom | tipe | ket |
|-------|------|-----|
| id | bigint PK | |
| name | varchar | |
| email | varchar | |
| message | text | |
| is_read | boolean default false | |
| timestamps | | |

### `users`
Bawaan Laravel — untuk login admin panel. Seed 1 akun admin.

## Catatan implementasi

- Kolom `sort_order` di mana-mana supaya urutan bisa diatur dari admin tanpa migrasi.
- Gunakan soft deletes pada `projects` dan `experiences` kalau mau aman.
- Tabel `contacts` **tidak** diseed dengan data dummy (biarkan kosong; itu pesan asli nanti).
