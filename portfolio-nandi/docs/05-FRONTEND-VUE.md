# 05 — Frontend (Vue 3)

## Setup

```bash
npm create vite@latest portfolio-frontend -- --template vue
cd portfolio-frontend
npm install three gsap @vueuse/core axios
# opsional: pinia (state), vue-router (kalau butuh multi-page)
```

## Struktur folder yang disarankan

```
src/
├── assets/styles/
│   ├── tokens.css        # variabel dari 02-DESIGN-SYSTEM.md
│   └── base.css
├── components/
│   ├── layout/
│   │   ├── TheNav.vue
│   │   └── TheFooter.vue
│   ├── three/
│   │   ├── HeroScene.vue      # objek 3D signature (Three.js)
│   │   └── useTilt.js         # composable tilt 3D untuk kartu
│   ├── sections/
│   │   ├── HeroSection.vue
│   │   ├── AboutSection.vue
│   │   ├── SkillsSection.vue
│   │   ├── ProjectsSection.vue
│   │   ├── JourneySection.vue
│   │   └── ContactSection.vue
│   └── ui/
│       ├── GlassCard.vue      # kartu glass mono reusable
│       ├── TechTag.vue        # tag teknologi mono
│       └── SectionTitle.vue
├── composables/
│   ├── useApi.js              # axios ke Laravel
│   └── useReveal.js           # scroll reveal (IntersectionObserver/GSAP)
├── App.vue
└── main.js
```

## Token CSS (taruh di `tokens.css`)

```css
:root{
  --ink-900:#0A0A0B; --ink-700:#161618; --ink-500:#2A2A2E;
  --fog-400:#6E6E76; --fog-200:#B9B9C0; --paper-50:#F5F5F2;
  --glow:rgba(245,245,242,0.08);
  --radius-card:8px; --radius-tag:4px;
}
```

## Hero 3D (Three.js) — panduan implementasi

Buat di `HeroScene.vue`:
- Scene gelap `--ink-900`, satu directional light putih dari kanan-atas + ambient sangat redup.
- Geometri: `IcosahedronGeometry` atau `DodecahedronGeometry` low-poly, material `MeshStandardMaterial` abu gelap (`#1c1c20`), `metalness ~0.2`, `roughness ~0.7`. Tambah `wireframe` tipis versi kedua di atasnya untuk efek monolith.
- Rotasi pelan otomatis (`requestAnimationFrame`), dan tilt mengikuti posisi mouse (lerp biar halus).
- **Perf:** batasi `pixelRatio` ke `Math.min(devicePixelRatio, 2)`, pause render saat tab tidak aktif / hero keluar viewport.
- **Fallback:** kalau `!window.WebGLRenderingContext` atau device lemah → tampilkan `<img>` grayscale statis.

> Catatan: THREE r128 tidak punya `OrbitControls` bawaan & `CapsuleGeometry`. Kalau butuh orbit, import addon terpisah atau pakai versi Three terbaru dari npm.

## Kartu dengan tilt 3D (`useTilt.js`)

Composable yang menerima ref elemen, hitung rotasi dari posisi kursor relatif ke tengah kartu, clamp maksimal 6°, apply lewat `transform: perspective(800px) rotateX() rotateY()`. Wajib cek `prefers-reduced-motion` → return no-op.

## Ambil data dari Laravel

`useApi.js` baca base URL dari `import.meta.env.VITE_API_URL`. Section memanggil endpoint (lihat `06-BACKEND-LARAVEL.md`), mis:

```js
const { data } = await api.get('/api/projects')
```

Selama backend belum jadi, boleh mock dari JSON lokal yang isinya sama dengan seeder, lalu ganti ke API.

## Reveal on scroll (`useReveal.js`)

Pakai `IntersectionObserver`; saat elemen masuk, tambah class `.is-visible` (translateY + opacity via CSS transition). Alternatif: GSAP ScrollTrigger untuk stagger antar-kartu.

## Aturan wajib

- Semua animasi hormati `prefers-reduced-motion`.
- Fokus keyboard terlihat.
- Layout aman sampai lebar 360px (grid → 1 kolom di mobile).
