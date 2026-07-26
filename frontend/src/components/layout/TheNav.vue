<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue'

defineProps({
  cvUrl: { type: String, default: null },
})

const links = [
  { id: 'home', label: 'Home' },
  { id: 'about', label: 'About' },
  { id: 'skills', label: 'Skills' },
  { id: 'projects', label: 'Projects' },
  { id: 'journey', label: 'Journey' },
  { id: 'contact', label: 'Contact' },
]

const activeId = ref('home')
const scrolled = ref(false)
let observer = null

function onScroll() {
  scrolled.value = window.scrollY > 24
}

onMounted(() => {
  observer = new IntersectionObserver(
    (entries) => {
      const visible = entries
        .filter((entry) => entry.isIntersecting)
        .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0]
      if (visible) activeId.value = visible.target.id
    },
    { rootMargin: '-45% 0px -45% 0px', threshold: [0, 0.25, 0.5] },
  )

  links.forEach(({ id }) => {
    const el = document.getElementById(id)
    if (el) observer.observe(el)
  })

  window.addEventListener('scroll', onScroll, { passive: true })
  onScroll()
})

onBeforeUnmount(() => {
  observer?.disconnect()
  window.removeEventListener('scroll', onScroll)
})
</script>

<template>
  <header class="nav" :class="{ 'nav--scrolled': scrolled }">
    <div class="container nav__inner">
      <a href="#home" class="nav__logo" aria-label="Ke atas">N</a>

      <nav class="nav__links" aria-label="Navigasi utama">
        <a
          v-for="link in links"
          :key="link.id"
          :href="`#${link.id}`"
          class="nav__link"
          :class="{ 'is-active': activeId === link.id }"
          :aria-current="activeId === link.id ? 'true' : undefined"
        >
          {{ link.label }}
        </a>
      </nav>

      <a v-if="cvUrl" class="btn btn--ghost btn--sm nav__cv" :href="cvUrl" download>Unduh CV</a>
    </div>
  </header>
</template>

<style scoped>
.nav {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
  transition:
    background-color var(--dur-mid) var(--ease-out),
    border-color var(--dur-mid) var(--ease-out),
    backdrop-filter var(--dur-mid) var(--ease-out);
  border-bottom: 1px solid transparent;
}

.nav--scrolled {
  background: rgba(10, 10, 11, 0.72);
  backdrop-filter: blur(12px);
  border-bottom-color: var(--ink-500);
}

.nav__inner {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  height: 4.5rem;
}

.nav__logo {
  font-family: var(--font-display);
  font-size: 1.125rem;
  font-weight: 600;
  width: 2.25rem;
  height: 2.25rem;
  display: grid;
  place-items: center;
  flex-shrink: 0;
  border: 1px solid var(--ink-500);
  border-radius: var(--radius-tag);
  box-shadow: var(--edge-highlight);
  transition:
    border-color var(--dur-fast) var(--ease-out),
    box-shadow var(--dur-fast) var(--ease-out);
}

.nav__logo:hover {
  border-color: rgba(245, 245, 242, 0.35);
  box-shadow: 0 0 16px rgba(245, 245, 242, 0.12), var(--edge-highlight);
}

.nav__links {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  margin-right: auto;
  overflow-x: auto;
  scrollbar-width: none;
}

.nav__links::-webkit-scrollbar {
  display: none;
}

.nav__link {
  position: relative;
  font-size: 0.9375rem;
  color: var(--fog-400);
  white-space: nowrap;
  padding-block: 0.5rem;
  transition: color var(--dur-fast) var(--ease-out);
}

/* Item aktif ditandai cahaya di bawahnya — bukan warna berbeda. */
.nav__link::after {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 1px;
  background: var(--paper-50);
  opacity: 0;
  transform: scaleX(0.4);
  transition:
    opacity var(--dur-fast) var(--ease-out),
    transform var(--dur-fast) var(--ease-out);
}

.nav__link:hover {
  color: var(--fog-200);
}

.nav__link.is-active {
  color: var(--paper-50);
}

.nav__link.is-active::after {
  opacity: 1;
  transform: none;
  box-shadow: 0 0 10px rgba(245, 245, 242, 0.6);
}

.nav__cv {
  flex-shrink: 0;
}

@media (max-width: 700px) {
  .nav__inner {
    gap: 1rem;
  }

  /* Nav digeser horizontal di layar sempit — tepi memudar sebagai penanda. */
  .nav__links {
    gap: 1.125rem;
    mask-image: linear-gradient(90deg, #000 88%, transparent 100%);
  }

  .nav__link {
    font-size: 0.875rem;
  }
}
</style>
