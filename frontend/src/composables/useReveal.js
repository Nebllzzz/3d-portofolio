const prefersReducedMotion = () =>
  window.matchMedia('(prefers-reduced-motion: reduce)').matches

/**
 * v-reveal — elemen naik 24px + fade saat masuk viewport.
 * v-reveal="{ delay: 60 }" untuk stagger antar kartu.
 */
export const vReveal = {
  mounted(el, binding) {
    if (prefersReducedMotion() || !('IntersectionObserver' in window)) {
      el.classList.add('reveal', 'is-visible')
      return
    }

    el.classList.add('reveal')
    el.style.setProperty('--reveal-delay', `${binding.value?.delay ?? 0}ms`)

    const observer = new IntersectionObserver(
      ([entry]) => {
        if (!entry.isIntersecting) return
        el.classList.add('is-visible')
        observer.disconnect()
      },
      { threshold: 0.15, rootMargin: '0px 0px -8% 0px' },
    )

    observer.observe(el)
    el._revealObserver = observer
  },

  unmounted(el) {
    el._revealObserver?.disconnect()
  },
}
