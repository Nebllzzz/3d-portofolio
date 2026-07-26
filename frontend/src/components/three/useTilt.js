const prefersReducedMotion = () =>
  window.matchMedia('(prefers-reduced-motion: reduce)').matches

const MAX_DEG = 6

/**
 * v-tilt — kartu miring mengikuti kursor (maks 6°) + cahaya tepi ikut posisi.
 * Ini pengganti "warna hover" di design system monokrom.
 * Otomatis no-op kalau prefers-reduced-motion atau perangkat sentuh.
 */
export const vTilt = {
  mounted(el) {
    const isTouch = window.matchMedia('(hover: none)').matches
    if (prefersReducedMotion() || isTouch) return

    const onMove = (event) => {
      const rect = el.getBoundingClientRect()
      const px = (event.clientX - rect.left) / rect.width
      const py = (event.clientY - rect.top) / rect.height

      el.style.setProperty('--tilt-x', `${(0.5 - py) * 2 * MAX_DEG}deg`)
      el.style.setProperty('--tilt-y', `${(px - 0.5) * 2 * MAX_DEG}deg`)
      el.style.setProperty('--pointer-x', `${px * 100}%`)
      el.style.setProperty('--pointer-y', `${py * 100}%`)
    }

    const onLeave = () => {
      el.style.setProperty('--tilt-x', '0deg')
      el.style.setProperty('--tilt-y', '0deg')
    }

    el.addEventListener('pointermove', onMove)
    el.addEventListener('pointerleave', onLeave)
    el._tiltCleanup = () => {
      el.removeEventListener('pointermove', onMove)
      el.removeEventListener('pointerleave', onLeave)
    }
  },

  unmounted(el) {
    el._tiltCleanup?.()
  },
}
