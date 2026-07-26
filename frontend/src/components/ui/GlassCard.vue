<script setup>
defineProps({
  tilt: { type: Boolean, default: false },
})
</script>

<template>
  <div v-tilt="tilt || undefined" class="glass-card" :class="{ 'glass-card--tilt': tilt }">
    <div class="glass-card__sheen" aria-hidden="true" />
    <div class="glass-card__body">
      <slot />
    </div>
  </div>
</template>

<style scoped>
.glass-card {
  position: relative;
  background: var(--ink-700);
  border: 1px solid var(--ink-500);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-rest), var(--edge-highlight);
  backdrop-filter: blur(8px);
  transition:
    transform var(--dur-fast) var(--ease-out),
    box-shadow var(--dur-fast) var(--ease-out),
    border-color var(--dur-fast) var(--ease-out);
  transform-style: preserve-3d;
}

.glass-card__body {
  position: relative;
  z-index: 1;
  padding: clamp(1.25rem, 2.5vw, 1.75rem);
  height: 100%;
}

/* Cahaya mengikuti kursor — penanda interaktif tanpa hue. */
.glass-card__sheen {
  position: absolute;
  inset: 0;
  border-radius: inherit;
  opacity: 0;
  transition: opacity var(--dur-fast) var(--ease-out);
  background: radial-gradient(
    340px circle at var(--pointer-x, 50%) var(--pointer-y, 50%),
    rgba(245, 245, 242, 0.07),
    transparent 65%
  );
  pointer-events: none;
}

.glass-card--tilt {
  transform: perspective(800px) rotateX(var(--tilt-x, 0deg)) rotateY(var(--tilt-y, 0deg));
}

.glass-card:hover {
  border-color: rgba(245, 245, 242, 0.18);
  box-shadow: var(--shadow-lift), var(--edge-highlight);
}

.glass-card:hover .glass-card__sheen {
  opacity: 1;
}

@media (prefers-reduced-motion: reduce) {
  .glass-card--tilt {
    transform: none;
  }
}
</style>
