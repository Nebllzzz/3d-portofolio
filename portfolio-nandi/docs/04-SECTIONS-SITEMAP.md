# 04 — Sections & Sitemap

Halaman publik = single-page scroll dengan nav sticky. Section mengikuti referensi yang kamu kasih (Skill Teknis, Projek, Kontak) **plus tambahan** agar terlihat lebih penuh dan impresif.

## Navigasi (sticky top)

```
[ N ]   Home · About · Skills · Projects · Journey · Contact       [ Unduh CV ]
```

Logo "N" bisa jadi objek 3D mini yang ikut berputar. Nav item aktif ditandai cahaya putih di bawahnya (bukan warna).

## Urutan section

### 1. Hero
- Objek 3D signature (lihat design system) + nama besar "NANDI RIFKI BAIHAQI".
- Sub: headline ("Aspiring Programmer · Web Developer, Bandung").
- Dua tombol: "Lihat Project" (scroll) + "Unduh CV".
- Sumber data: `profiles`.

### 2. About / Profil
- Foto profil (grayscale, sedikit tilt 3D saat hover).
- Paragraf bio dari CV.
- Info ringkas: lahir, lokasi, status.
- Soft skill sebagai chip mono kecil.
- Sumber: `profiles`.

### 3. Skill Teknis
Kelompokkan seperti referensi — grid 2 kolom berisi kartu kategori, tiap kartu berisi ikon-ikon skill:
- **Bahasa Pemrograman**
- **Backend Teknologi**
- **Front End Teknologi**
- **Alat Pengembang (Tools)**

Setiap ikon skill saat hover: naik sedikit di sumbu Z + rim light. Sumber: `skill_categories` + `skills`.

### 4. Projects
Grid kartu project. Tiap kartu:
- Judul + ringkasan
- Beberapa bullet fitur (`project_points`)
- Baris tag teknologi mono (`project_tags`)
- Tombol "Source Code" (+ "Live Demo" jika ada)
- Hover: tilt 3D + bayangan tumbuh.

Sumber: `projects` + relasinya.

### 5. Journey (Experience + Education digabung timeline)
Timeline vertikal 1 garis. Node bisa dipilih (Pengalaman / Pendidikan) via filter chip.
- **Experience:** website bioskop (PHP), website caffee (Laravel), OSIS.
- **Education:** SD → SMP → SMK.
- Saat scroll, node "menyala" satu per satu. Garis timeline punya sedikit kesan 3D (kedalaman/bayangan).

Sumber: `experiences` + `experience_points`, `educations`.

### 6. Contact
- Kiri: ajakan singkat + link sosial (`socials`).
- Kanan: form (Nama, Email, Pesan) → simpan ke tabel `contacts` via API Laravel.
- Setelah kirim: state sukses jelas ("Pesan terkirim — aku balas secepatnya."), state error jelas.

### 7. Footer
- Nama, tahun, "Built with Vue + Laravel".
- Link cepat + tombol "kembali ke atas" (scroll halus).

## Ide section tambahan (opsional, kalau mau lebih "wow")

- **Stats mini** di hero/about: jumlah project, tahun mulai ngoding, bahasa dikuasai — ditampilkan sebagai angka mono besar (bukan template gradient).
- **"Now" / Sedang belajar:** kartu kecil apa yang lagi dipelajari Nandi (Vue, 3D, dll) — memperkuat kesan "mau terus belajar".
- **Playground 3D:** satu section kosong dengan objek 3D interaktif murni (drag untuk memutar) sebagai unjuk kemampuan.

## Prinsip konten (copywriting)

- Tulis dari sisi pengunjung, aktif, ringkas. Tombol bilang aksinya: "Lihat Project", "Kirim Pesan".
- Hindari kalimat menjual berlebihan. Spesifik > pintar. Contoh baik: "Aplikasi kasir caffee dengan hak akses per-level user."
