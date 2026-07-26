<script setup>
import GlassCard from '../ui/GlassCard.vue'
import SectionTitle from '../ui/SectionTitle.vue'
import TechTag from '../ui/TechTag.vue'

defineProps({
  projects: { type: Array, default: () => [] },
})
</script>

<template>
  <section id="projects" class="section section--lift">
    <div class="container">
      <SectionTitle
        eyebrow="03 — Project"
        title="Yang sudah saya bangun"
        lead="Dua aplikasi kasir yang saya kerjakan dari skema database sampai laporan penjualan."
      />

      <div class="projects">
        <GlassCard
          v-for="(project, i) in projects"
          :key="project.id"
          v-reveal="{ delay: i * 60 }"
          tilt
          class="projects__card"
        >
          <article class="projects__body">
            <h3 class="projects__title">{{ project.title }}</h3>
            <p class="projects__summary">{{ project.summary }}</p>

            <ul v-if="project.points?.length" class="projects__points">
              <li v-for="point in project.points" :key="point">{{ point }}</li>
            </ul>

            <div v-if="project.tags?.length" class="projects__tags">
              <TechTag v-for="tag in project.tags" :key="tag" :label="tag" />
            </div>

            <div class="projects__actions">
              <a
                v-if="project.source_url"
                class="btn btn--ghost btn--sm"
                :href="project.source_url"
                target="_blank"
                rel="noopener"
              >
                Source Code
              </a>
              <a
                v-if="project.demo_url"
                class="btn btn--primary btn--sm"
                :href="project.demo_url"
                target="_blank"
                rel="noopener"
              >
                Live Demo
              </a>
            </div>
          </article>
        </GlassCard>
      </div>
    </div>
  </section>
</template>

<style scoped>
.projects {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: clamp(1rem, 2vw, 1.5rem);
}

.projects__body {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.projects__title {
  font-size: var(--type-card);
  font-weight: 500;
  letter-spacing: -0.01em;
}

.projects__summary {
  margin-top: 0.875rem;
  color: var(--fog-400);
}

.projects__points {
  margin: 1.5rem 0 0;
  padding: 0;
  list-style: none;
  display: grid;
  gap: 0.5rem;
}

.projects__points li {
  position: relative;
  padding-left: 1.25rem;
  font-size: 0.9375rem;
  color: var(--fog-200);
}

.projects__points li::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0.6em;
  width: 5px;
  height: 1px;
  background: var(--fog-400);
}

.projects__tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.4rem;
  margin-top: 1.75rem;
}

.projects__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-top: auto;
  padding-top: 1.75rem;
}

@media (max-width: 860px) {
  .projects {
    grid-template-columns: minmax(0, 1fr);
  }
}
</style>
