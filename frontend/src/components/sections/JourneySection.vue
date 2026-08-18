<script setup>
import { computed, ref } from 'vue'
import SectionTitle from '../ui/SectionTitle.vue'

const props = defineProps({
  experiences: { type: Array, default: () => [] },
  educations: { type: Array, default: () => [] },
})

const filters = [
  { key: 'all', label: 'Semua' },
  { key: 'experience', label: 'Pengalaman' },
  { key: 'education', label: 'Pendidikan' },
]

const active = ref('all')

const nodes = computed(() => {
  const fromExperience = props.experiences.map((item) => ({
    id: `exp-${item.id}`,
    type: 'experience',
    title: item.title,
    subtitle: item.subtitle,
    points: item.points ?? [],
  }))

  const fromEducation = props.educations.map((item) => ({
    id: `edu-${item.id}`,
    type: 'education',
    title: item.institution,
    subtitle: `${item.level} · ${item.year_start} – ${item.year_end}`,
    points: [],
  }))

  const all = [...fromExperience, ...fromEducation]
  return active.value === 'all' ? all : all.filter((node) => node.type === active.value)
})
</script>

<template>
  <section id="journey" class="section">
    <div class="container">
      <SectionTitle
        eyebrow="03 — Perjalanan"
        title="Pengalaman & pendidikan"
        lead="Pengalaman yang membentuk cara saya membangun dan merawat aplikasi web."
      />

      <div v-reveal class="journey__filters" role="group" aria-label="Saring perjalanan">
        <button
          v-for="filter in filters"
          :key="filter.key"
          class="journey__chip"
          :class="{ 'is-active': active === filter.key }"
          :aria-pressed="active === filter.key"
          @click="active = filter.key"
        >
          {{ filter.label }}
        </button>
      </div>

      <ol class="journey">
        <li
          v-for="(node, i) in nodes"
          :key="node.id"
          v-reveal="{ delay: i * 60 }"
          class="journey__node"
        >
          <span class="journey__marker" aria-hidden="true" />
          <h3 class="journey__title">{{ node.title }}</h3>
          <p v-if="node.subtitle" class="journey__subtitle">{{ node.subtitle }}</p>
          <ul v-if="node.points.length" class="journey__points">
            <li v-for="point in node.points" :key="point">{{ point }}</li>
          </ul>
        </li>
      </ol>
    </div>
  </section>
</template>

<style scoped>
.journey__filters {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 3rem;
}

.journey__chip {
  padding: 0.4rem 0.85rem;
  border: 1px solid var(--ink-500);
  border-radius: var(--radius-tag);
  background: transparent;
  font-family: var(--font-mono);
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--fog-400);
  transition:
    color var(--dur-fast) var(--ease-out),
    border-color var(--dur-fast) var(--ease-out),
    background-color var(--dur-fast) var(--ease-out);
}

.journey__chip:hover {
  color: var(--paper-50);
  border-color: rgba(245, 245, 242, 0.28);
}

.journey__chip.is-active {
  color: var(--ink-900);
  background: var(--paper-50);
  border-color: var(--paper-50);
}

.journey {
  list-style: none;
  margin: 0;
  padding: 0 0 0 2rem;
  position: relative;
}

/* Garis timeline dengan kesan kedalaman, bukan garis rata. */
.journey::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0.5rem;
  bottom: 0.5rem;
  width: 1px;
  background: linear-gradient(180deg, transparent, var(--ink-500) 12%, var(--ink-500) 88%, transparent);
  box-shadow: 1px 0 0 rgba(255, 255, 255, 0.02);
}

.journey__node {
  position: relative;
  padding-bottom: 3rem;
}

.journey__node:last-child {
  padding-bottom: 0;
}

.journey__marker {
  position: absolute;
  left: calc(-2rem - 4px);
  top: 0.45rem;
  width: 9px;
  height: 9px;
  border-radius: 50%;
  background: var(--ink-900);
  border: 1px solid var(--fog-400);
  transition:
    box-shadow var(--dur-mid) var(--ease-out),
    border-color var(--dur-mid) var(--ease-out);
}

/* Node "menyala" saat masuk viewport. */
.journey__node.is-visible .journey__marker {
  border-color: var(--paper-50);
  box-shadow: 0 0 0 3px rgba(245, 245, 242, 0.07), 0 0 12px rgba(245, 245, 242, 0.35);
}

.journey__title {
  font-size: var(--type-card);
  font-weight: 500;
  margin-top: 0.5rem;
  letter-spacing: -0.01em;
}

.journey__subtitle {
  margin-top: 0.25rem;
  color: var(--fog-400);
}

.journey__points {
  margin: 1rem 0 0;
  padding: 0;
  list-style: none;
  display: grid;
  gap: 0.4rem;
}

.journey__points li {
  position: relative;
  padding-left: 1.25rem;
  font-size: 0.9375rem;
}

.journey__points li::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0.6em;
  width: 5px;
  height: 1px;
  background: var(--fog-400);
}
</style>
