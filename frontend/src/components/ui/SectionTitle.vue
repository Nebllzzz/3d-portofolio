<script setup>
defineProps({
  eyebrow: { type: String, default: '' },
  title: { type: String, required: true },
  lead: { type: String, default: '' },
})
</script>

<template>
  <header v-reveal class="section-title">
    <p v-if="eyebrow" class="eyebrow">{{ eyebrow }}</p>
    <h2>{{ title }}</h2>
    <p v-if="lead" class="section-title__lead">{{ lead }}</p>
  </header>
</template>

<style scoped>
.section-title {
  margin-bottom: clamp(2.5rem, 5vw, 4rem);
  max-width: 60ch;
}

.section-title h2 {
  font-size: var(--type-section);
  font-weight: 500;
  letter-spacing: -0.02em;
  line-height: 1.05;
  margin-top: 0.75rem;
}

.section-title__lead {
  margin-top: 1rem;
  color: var(--fog-400);
  max-width: 52ch;
}
</style>
