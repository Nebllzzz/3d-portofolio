<script setup>
defineProps({
  label: { type: String, required: true },
})
</script>

<template>
  <span class="tech-tag">{{ label }}</span>
</template>

<style scoped>
.tech-tag {
  display: inline-block;
  padding: 0.25rem 0.5rem;
  border: 1px solid var(--ink-500);
  border-radius: var(--radius-tag);
  background: rgba(245, 245, 242, 0.02);
  font-family: var(--font-mono);
  font-size: 0.75rem;
  letter-spacing: 0.04em;
  color: var(--fog-400);
  white-space: nowrap;
}
</style>
