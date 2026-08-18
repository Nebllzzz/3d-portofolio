<script setup>
import TheNav from './components/layout/TheNav.vue'
import TheFooter from './components/layout/TheFooter.vue'
import HeroSection from './components/sections/HeroSection.vue'
import AboutSection from './components/sections/AboutSection.vue'
import SkillsSection from './components/sections/SkillsSection.vue'
import JourneySection from './components/sections/JourneySection.vue'
import ContactSection from './components/sections/ContactSection.vue'
import { educations, experiences, profile, skillCategories } from './data/portfolio'
</script>

<template>
  <TheNav :cv-url="profile?.cv_url" />

  <main>
    <HeroSection :profile="profile" />

    <AboutSection :profile="profile" />
    <SkillsSection :categories="skillCategories" />
    <JourneySection :experiences="experiences" :educations="educations" />
    <ContactSection :profile="profile" />
  </main>

  <TheFooter :profile="profile" />
</template>
