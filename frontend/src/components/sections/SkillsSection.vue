<script setup>
import GlassCard from '../ui/GlassCard.vue'
import SectionTitle from '../ui/SectionTitle.vue'

defineProps({
  categories: { type: Array, default: () => [] },
})
</script>

<template>
  <section id="skills" class="section">
    <div class="container">
      <SectionTitle
        eyebrow="02 — Skill Teknis"
        title="Yang saya pakai untuk membangun"
        lead="Teknologi yang saya gunakan untuk membangun, merawat, dan mengintegrasikan aplikasi web."
      />

      <div class="skills">
        <GlassCard
          v-for="(category, i) in categories"
          :key="category.id"
          v-reveal="{ delay: i * 60 }"
          class="skills__card"
        >
          <h3 class="skills__name">{{ category.name }}</h3>
          <ul class="skills__list">
            <li v-for="skill in category.skills" :key="skill.id" class="skills__item">
              {{ skill.name }}
            </li>
          </ul>
        </GlassCard>
      </div>
    </div>
  </section>
</template>

<style scoped>
.skills {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: clamp(1rem, 2vw, 1.5rem);
}

.skills__name {
  font-size: var(--type-card);
  font-weight: 500;
  letter-spacing: -0.01em;
}

.skills__list {
  list-style: none;
  margin: 1.5rem 0 0;
  padding: 0;
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.skills__item {
  font-family: var(--font-mono);
  font-size: 0.8125rem;
  padding: 0.4rem 0.65rem;
  border: 1px solid var(--ink-500);
  border-radius: var(--radius-tag);
  background: rgba(245, 245, 242, 0.02);
  color: var(--fog-200);
  transition:
    transform var(--dur-fast) var(--ease-out),
    border-color var(--dur-fast) var(--ease-out),
    color var(--dur-fast) var(--ease-out);
}

/* Hover = naik sedikit + tepi menyala. Tidak ada perubahan hue. */
.skills__item:hover {
  transform: translateY(-3px);
  border-color: rgba(245, 245, 242, 0.32);
  color: var(--paper-50);
}

@media (max-width: 720px) {
  .skills {
    grid-template-columns: minmax(0, 1fr);
  }
}

@media (prefers-reduced-motion: reduce) {
  .skills__item:hover {
    transform: none;
  }
}
</style>
