<script setup>
import { computed } from 'vue'
import HeroScene from '../three/HeroScene.vue'

const props = defineProps({
  profile: { type: Object, default: null },
})

// Nama dipecah per huruf untuk reveal berurutan; spasi tetap jadi pemisah kata
// supaya baris bisa membungkus dengan benar di layar sempit.
const words = computed(() => {
  const name = props.profile?.full_name ?? ''
  let index = 0
  return name.split(' ').map((word) => ({
    word,
    chars: [...word].map((char) => ({ char, index: index++ })),
  }))
})
</script>

<template>
  <section id="home" class="hero">
    <HeroScene />

    <div class="container hero__inner">
      <p class="eyebrow hero__eyebrow">Portofolio · 2026</p>

      <h1 class="hero__name" :aria-label="profile?.full_name">
        <span v-for="(item, w) in words" :key="w" class="hero__word" aria-hidden="true">
          <span
            v-for="c in item.chars"
            :key="c.index"
            class="hero__char"
            :style="{ '--i': c.index }"
            >{{ c.char }}</span
          >
        </span>
      </h1>

      <p v-if="profile" class="hero__headline">{{ profile.headline }}</p>
      <p v-if="profile" class="eyebrow hero__meta">
        {{ profile.birth_place }} · Indonesia
      </p>

      <div class="hero__actions">
        <a class="btn btn--primary" href="#projects">Lihat Project</a>
        <a v-if="profile?.cv_url" class="btn btn--ghost" :href="profile.cv_url" download>
          Unduh CV
        </a>
      </div>
    </div>

    <a class="hero__scroll eyebrow" href="#about">Gulir</a>
  </section>
</template>

<style scoped>
.hero {
  position: relative;
  min-height: 100svh;
  display: flex;
  align-items: center;
  overflow: hidden;
}

/* Vignette lembut supaya teks tetap kontras di atas objek 3D. */
.hero::after {
  content: '';
  position: absolute;
  inset: 0;
  pointer-events: none;
  background: radial-gradient(120% 90% at 50% 50%, transparent 30%, var(--ink-900) 100%);
}

.hero__inner {
  position: relative;
  z-index: 1;
  padding-block: 8rem 6rem;
}

.hero__eyebrow {
  margin-bottom: 1.5rem;
}

.hero__name {
  font-size: var(--type-hero);
  font-weight: 600;
  letter-spacing: -0.03em;
  line-height: 0.95;
  text-transform: uppercase;
  max-width: 14ch;
}

.hero__word {
  display: inline-block;
  margin-right: 0.28em;
}

.hero__char {
  display: inline-block;
  opacity: 0;
  animation: char-in 0.6s var(--ease-out) forwards;
  animation-delay: calc(var(--i) * 32ms + 120ms);
}

@keyframes char-in {
  from {
    opacity: 0;
    transform: translateY(0.35em);
    filter: blur(6px);
  }
  to {
    opacity: 1;
    transform: none;
    filter: none;
  }
}

.hero__headline {
  margin-top: 1.75rem;
  font-size: clamp(1.0625rem, 1.6vw, 1.3125rem);
  color: var(--fog-200);
  max-width: 42ch;
}

.hero__meta {
  margin-top: 0.75rem;
}

.hero__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
  margin-top: 2.5rem;
}

.hero__scroll {
  position: absolute;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  z-index: 1;
  color: var(--fog-400);
  transition: color var(--dur-fast) var(--ease-out);
}

.hero__scroll::after {
  content: '';
  display: block;
  width: 1px;
  height: 2rem;
  margin: 0.5rem auto 0;
  background: linear-gradient(180deg, var(--fog-400), transparent);
}

.hero__scroll:hover {
  color: var(--paper-50);
}

@media (prefers-reduced-motion: reduce) {
  .hero__char {
    opacity: 1;
    animation: none;
  }
}
</style>
