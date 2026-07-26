# 02 — Design System: "Monochrome Depth"

Konsep desain: **kedalaman tanpa warna.** Semua yang biasanya dilakukan warna (menarik perhatian, memisahkan section, menandai interaktif) di sini dilakukan oleh cahaya, bayangan, blur, dan gerak 3D. Layar terasa seperti ruang gelap dengan objek melayang yang terkena satu sumber cahaya putih.

## Palet warna (dikunci grayscale)

Jangan pakai warna lain. Kedinamisan datang dari kontras nilai (value), bukan hue.

| Token | Hex | Pakai untuk |
|-------|-----|-------------|
| `--ink-900` | `#0A0A0B` | Background utama (hampir hitam, sedikit hangat) |
| `--ink-700` | `#161618` | Panel / kartu dasar |
| `--ink-500` | `#2A2A2E` | Border, garis pemisah |
| `--fog-400` | `#6E6E76` | Teks sekunder, caption |
| `--fog-200` | `#B9B9C0` | Teks body |
| `--paper-50` | `#F5F5F2` | Teks utama / heading (putih hangat, bukan #FFF) |
| `--glow` | `rgba(245,245,242,0.08)` | Cahaya ambient, rim light objek 3D |

Aksen "warna" satu-satunya = **putih terang** yang muncul sebagai cahaya/highlight pada elemen aktif. Elemen interaktif ditandai dengan *lebih banyak cahaya*, bukan dengan hue berbeda.

## Tipografi

Hindari font default AI (Inter/Arial polos). Pairing yang diusulkan:

- **Display (heading, nama Nandi):** `Space Grotesk` atau `Clash Display` — geometris, sedikit teknikal, cocok untuk developer. Dipakai besar & berani, tapi jarang.
- **Body:** `Inter Tight` atau `Satoshi` — netral, enak dibaca panjang.
- **Mono (tag teknologi, angka, label kode):** `JetBrains Mono` — memperkuat identitas "programmer".

Skala tipe (desktop):

```
Hero name    72–96px  display, weight 600, letter-spacing -0.03em
Section head 40–56px  display, weight 500
Card title   22–26px  display, weight 500
Body         16–18px  body, weight 400, line-height 1.6
Caption/tag  12–13px  mono, uppercase, letter-spacing 0.08em
```

## Layout & struktur

- Grid 12 kolom, max-width konten `1200px`, gutter lega (`24–32px`).
- **Radius:** kecil dan konsisten (`8px` untuk kartu, `4px` untuk tag). Jangan campur banyak radius.
- Pemisah section: bukan garis warna, tapi **pergeseran kedalaman** — section berikutnya terasa "lebih dekat/jauh" lewat bayangan dan sedikit perubahan gelap-terang background.
- Panel kartu pakai efek **glass tipis**: `background: var(--ink-700)` + `backdrop-filter: blur(8px)` + border `1px solid var(--ink-500)` + inner highlight `inset 0 1px 0 rgba(255,255,255,0.04)`.

## Signature element (yang bikin diingat)

**Objek 3D di hero** yang merespons kursor. Pilihan (ambil satu, jangan semua):

1. **Wireframe monolith** — bongkahan geometris low-poly abu gelap, permukaan reflektif matte, berputar pelan, rim light putih di tepinya. Saat kursor gerak, objek sedikit miring mengikuti (tilt).
2. **Particle field bernama** — ribuan titik putih membentuk teks "NANDI" di 3D, buyar jadi awan partikel saat hover lalu merakit lagi.
3. **Grid terrain** — bidang grid mono yang beriak seperti gelombang mengikuti kursor (gaya "depth map").

Rekomendasi: **opsi 1 (monolith)** — paling gampang perform di HP dan paling "mahal" secara visual untuk portofolio hitam-putih.

## Motion (deliberate, jangan norak)

- **Page load:** hero fade + objek 3D "menyala" dari gelap (0.8s, ease-out). Teks nama muncul huruf-per-huruf halus.
- **Scroll reveal:** tiap section naik `24px` + fade saat masuk viewport (IntersectionObserver / GSAP ScrollTrigger). Stagger antar kartu `60ms`.
- **Hover kartu project:** tilt 3D ringan (max 6°) mengikuti kursor + bayangan membesar + highlight tepi menyala. Ini pengganti "warna hover".
- **Depth parallax:** layer background objek 3D bergerak lebih lambat dari konten (`translateZ` / scroll factor).
- Semua motion **wajib** dibungkus cek `@media (prefers-reduced-motion: reduce)` → matikan tilt & parallax, sisakan fade sederhana.

## Aturan kualitas (quality floor)

- Responsif penuh sampai `360px`.
- Focus keyboard terlihat (outline putih tebal, jangan dihapus).
- Objek 3D punya **fallback**: kalau WebGL tidak didukung / device lemah, tampilkan gambar statis grayscale.
- Kontras teks utama vs background lolos WCAG AA.

## Yang HARUS dihindari

- Warna neon / gradient ungu-biru (justru itu yang mau kita lawan).
- Terlalu banyak animasi berbeda di satu layar (Chanel rule: kurangi satu efek sebelum "keluar rumah").
- Font system default polos tanpa karakter.
