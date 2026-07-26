<script setup>
import { onBeforeUnmount, onMounted, ref, shallowRef } from 'vue'

const canvasEl = ref(null)
const wrapEl = ref(null)
const supported = ref(true)
const ctx = shallowRef(null)

const prefersReducedMotion = () =>
  window.matchMedia('(prefers-reduced-motion: reduce)').matches

function hasWebGL() {
  try {
    const canvas = document.createElement('canvas')
    return Boolean(window.WebGLRenderingContext && canvas.getContext('webgl'))
  } catch {
    return false
  }
}

async function initScene() {
  // Import dinamis: three keluar dari bundle utama, hero tetap cepat tampil.
  const {
    AmbientLight,
    DirectionalLight,
    Group,
    IcosahedronGeometry,
    MathUtils,
    Mesh,
    MeshBasicMaterial,
    MeshStandardMaterial,
    PerspectiveCamera,
    Scene,
    WebGLRenderer,
  } = await import('three')

  const canvas = canvasEl.value
  const wrap = wrapEl.value
  if (!canvas || !wrap) return

  const scene = new Scene()

  const camera = new PerspectiveCamera(45, 1, 0.1, 100)
  camera.position.set(0, 0, 6.4)

  const renderer = new WebGLRenderer({ canvas, antialias: true, alpha: true })
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

  // Monolith: inti gelap matte + cangkang wireframe tipis di atasnya.
  const monolith = new Group()

  const core = new Mesh(
    new IcosahedronGeometry(1.5, 0),
    new MeshStandardMaterial({
      color: 0x26262b,
      metalness: 0.25,
      roughness: 0.55,
      flatShading: true,
    }),
  )

  const shell = new Mesh(
    new IcosahedronGeometry(1.54, 0),
    new MeshBasicMaterial({
      color: 0xf5f5f2,
      wireframe: true,
      transparent: true,
      opacity: 0.22,
    }),
  )

  monolith.add(core, shell)
  monolith.rotation.set(0.4, 0.6, 0)
  scene.add(monolith)

  // Cahaya: satu key light yang MENGIKUTI KURSOR, rim di belakang, ambient sangat redup.
  const key = new DirectionalLight(0xffffff, 4.2)
  key.position.set(3, 2.5, 3)

  const rim = new DirectionalLight(0xffffff, 2.6)
  rim.position.set(-3, 1.5, -2.5)

  scene.add(key, rim, new AmbientLight(0xffffff, 0.1))

  // Fade-in: objek "menyala" dari gelap saat load.
  let intro = 0
  const reduced = prefersReducedMotion()
  if (reduced) intro = 1

  const pointer = { x: 0, y: 0 }
  const smoothed = { x: 0, y: 0 }

  function onPointerMove(event) {
    const rect = wrap.getBoundingClientRect()
    pointer.x = ((event.clientX - rect.left) / rect.width) * 2 - 1
    pointer.y = ((event.clientY - rect.top) / rect.height) * 2 - 1
  }

  function resize() {
    const { clientWidth: w, clientHeight: h } = wrap
    if (!w || !h) return
    camera.aspect = w / h
    // Di layar sempit objek jadi latar penuh, jadi kamera mundur supaya
    // tidak menindih teks hero.
    camera.position.z = window.innerWidth < 900 ? 9.5 : 6.4
    camera.updateProjectionMatrix()
    renderer.setSize(w, h, false)
  }

  let frame = null
  let visible = true

  function render() {
    frame = requestAnimationFrame(render)

    intro = Math.min(intro + 0.012, 1)
    const eased = 1 - Math.pow(1 - intro, 3)

    if (!reduced) {
      smoothed.x = MathUtils.lerp(smoothed.x, pointer.x, 0.05)
      smoothed.y = MathUtils.lerp(smoothed.y, pointer.y, 0.05)

      monolith.rotation.y += 0.0022
      monolith.rotation.x = 0.4 + smoothed.y * 0.22
      monolith.rotation.z = smoothed.x * -0.12

      // Sapuan cahaya: key light bergerak di sekitar objek mengikuti kursor.
      key.position.set(smoothed.x * 4 + 1.5, -smoothed.y * 3 + 2, 3)
    }

    key.intensity = 4.2 * eased
    rim.intensity = 2.6 * eased
    shell.material.opacity = 0.22 * eased
    monolith.scale.setScalar(0.94 + eased * 0.06)

    renderer.render(scene, camera)
  }

  function start() {
    if (frame === null) render()
  }

  function stop() {
    if (frame !== null) {
      cancelAnimationFrame(frame)
      frame = null
    }
  }

  // Perf: berhenti render saat tab tidak aktif atau hero keluar viewport.
  const onVisibility = () => (document.hidden || !visible ? stop() : start())

  const io = new IntersectionObserver(
    ([entry]) => {
      visible = entry.isIntersecting
      onVisibility()
    },
    { threshold: 0 },
  )

  const ro = new ResizeObserver(resize)

  resize()
  ro.observe(wrap)
  io.observe(wrap)
  document.addEventListener('visibilitychange', onVisibility)
  if (!reduced) window.addEventListener('pointermove', onPointerMove, { passive: true })
  start()

  ctx.value = {
    dispose() {
      stop()
      io.disconnect()
      ro.disconnect()
      document.removeEventListener('visibilitychange', onVisibility)
      window.removeEventListener('pointermove', onPointerMove)
      core.geometry.dispose()
      core.material.dispose()
      shell.geometry.dispose()
      shell.material.dispose()
      renderer.dispose()
    },
  }
}

onMounted(() => {
  if (!hasWebGL()) {
    supported.value = false
    return
  }
  initScene()
})

onBeforeUnmount(() => ctx.value?.dispose())
</script>

<template>
  <div ref="wrapEl" class="hero-scene" aria-hidden="true">
    <canvas v-if="supported" ref="canvasEl" class="hero-scene__canvas" />
    <!-- Fallback tanpa WebGL: bentuk geometris statis, tetap monokrom. -->
    <div v-else class="hero-scene__fallback" />
  </div>
</template>

<style scoped>
/* Objek menempati paruh kanan supaya nama punya ruang bernapas.
   Di layar sempit ia jadi latar penuh dengan opacity lebih rendah. */
.hero-scene {
  position: absolute;
  inset: 0;
  z-index: 0;
  opacity: 0.35;
}

@media (min-width: 900px) {
  .hero-scene {
    left: 46%;
    opacity: 1;
  }
}

.hero-scene__canvas {
  width: 100%;
  height: 100%;
  display: block;
}

.hero-scene__fallback {
  position: absolute;
  top: 50%;
  left: 50%;
  width: min(38vmin, 260px);
  aspect-ratio: 1;
  transform: translate(-50%, -50%) rotate(12deg);
  background:
    linear-gradient(145deg, rgba(245, 245, 242, 0.16), transparent 55%),
    linear-gradient(325deg, var(--ink-700), var(--ink-900));
  border: 1px solid rgba(245, 245, 242, 0.1);
  clip-path: polygon(50% 0%, 93% 25%, 93% 75%, 50% 100%, 7% 75%, 7% 25%);
}
</style>
