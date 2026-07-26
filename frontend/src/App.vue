<script setup>
import { onMounted } from 'vue'
import TheNav from './components/layout/TheNav.vue'
import TheFooter from './components/layout/TheFooter.vue'
import HeroSection from './components/sections/HeroSection.vue'
import AboutSection from './components/sections/AboutSection.vue'
import SkillsSection from './components/sections/SkillsSection.vue'
import ProjectsSection from './components/sections/ProjectsSection.vue'
import JourneySection from './components/sections/JourneySection.vue'
import ContactSection from './components/sections/ContactSection.vue'
import { usePortfolio } from './composables/usePortfolio'

const { profile, skillCategories, projects, experiences, educations, loading, error, load } =
  usePortfolio()

onMounted(load)
</script>

<template>
  <TheNav :cv-url="profile?.cv_url" />

  <main>
    <HeroSection :profile="profile" />

    <div v-if="error" class="container state state--error" role="alert">
      <p class="eyebrow">Gagal memuat</p>
      <p>{{ error }}</p>
      <button class="btn btn--ghost btn--sm" @click="load">Coba lagi</button>
    </div>

    <template v-else-if="!loading">
      <AboutSection :profile="profile" />
      <SkillsSection :categories="skillCategories" />
      <ProjectsSection :projects="projects" />
      <JourneySection :experiences="experiences" :educations="educations" />
      <ContactSection :profile="profile" />
    </template>

    <p v-else class="container state eyebrow">Memuat konten…</p>
  </main>

  <TheFooter :profile="profile" />
</template>

<style scoped>
.state {
  padding-block: 6rem;
  display: grid;
  gap: 0.75rem;
  justify-items: start;
}

.state--error {
  color: var(--fog-200);
}
</style>
