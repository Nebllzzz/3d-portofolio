<script setup>
defineProps({
  profile: { type: Object, default: null },
})

const year = new Date().getFullYear()
</script>

<template>
  <footer class="footer">
    <div class="container footer__inner">
      <div>
        <p class="footer__name">{{ profile?.full_name ?? 'Maulana Husein' }}</p>
        <p class="eyebrow">© {{ year }} · Dibangun dengan Vue + Laravel</p>
      </div>

      <a href="#home" class="footer__top eyebrow">Kembali ke atas ↑</a>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  border-top: 1px solid var(--ink-500);
  padding-block: 3rem;
  box-shadow: var(--edge-highlight);
}

.footer__inner {
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem;
  align-items: end;
  justify-content: space-between;
}

.footer__name {
  font-family: var(--font-display);
  color: var(--paper-50);
  margin-bottom: 0.4rem;
}

.footer__top {
  color: var(--fog-400);
  transition: color var(--dur-fast) var(--ease-out);
}

.footer__top:hover {
  color: var(--paper-50);
}
</style>
