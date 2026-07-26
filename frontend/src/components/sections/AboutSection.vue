<script setup>
import { computed } from 'vue'
import SectionTitle from '../ui/SectionTitle.vue'

const props = defineProps({
  profile: { type: Object, default: null },
})

const facts = computed(() => {
  if (!props.profile) return []
  return [
    { label: 'Lahir', value: `${props.profile.birth_place}, ${formatDate(props.profile.birth_date)}` },
    { label: 'Lokasi', value: 'Kab. Bandung, Jawa Barat' },
    { label: 'Fokus', value: 'Laravel · PHP · MySQL' },
  ]
})

function formatDate(iso) {
  if (!iso) return '—'
  return new Date(iso).toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric',
  })
}
</script>

<template>
  <section id="about" class="section section--lift">
    <div class="container">
      <SectionTitle eyebrow="01 — Profil" title="Siapa saya" />

      <div class="about">
        <div v-reveal class="about__portrait">
          <img
            v-if="profile?.photo_url"
            :src="profile.photo_url"
            :alt="`Foto ${profile.full_name}`"
          />
          <div v-else class="about__portrait-empty">
            <span class="eyebrow">Foto belum diunggah</span>
          </div>
        </div>

        <div class="about__text">
          <p v-reveal="{ delay: 60 }" class="about__bio">{{ profile?.bio }}</p>

          <dl v-reveal="{ delay: 120 }" class="about__facts">
            <div v-for="fact in facts" :key="fact.label" class="about__fact">
              <dt class="eyebrow">{{ fact.label }}</dt>
              <dd>{{ fact.value }}</dd>
            </div>
          </dl>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.about {
  display: grid;
  grid-template-columns: minmax(0, 320px) minmax(0, 1fr);
  gap: clamp(2rem, 5vw, 4rem);
  align-items: start;
}

.about__portrait {
  border: 1px solid var(--ink-500);
  border-radius: var(--radius-card);
  overflow: hidden;
  aspect-ratio: 4 / 5;
  box-shadow: var(--shadow-rest), var(--edge-highlight);
  transition: transform var(--dur-mid) var(--ease-out);
}

.about__portrait img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: grayscale(1) contrast(1.05);
}

.about__portrait:hover {
  transform: perspective(900px) rotateY(-4deg) rotateX(2deg);
}

.about__portrait-empty {
  width: 100%;
  height: 100%;
  display: grid;
  place-items: center;
  background: linear-gradient(160deg, var(--ink-700), var(--ink-900));
}

.about__bio {
  font-size: clamp(1.0625rem, 1.5vw, 1.1875rem);
  color: var(--fog-200);
}

.about__facts {
  margin: 2.5rem 0 0;
  display: grid;
  gap: 1.25rem;
  border-top: 1px solid var(--ink-500);
  padding-top: 2rem;
}

.about__fact {
  display: grid;
  grid-template-columns: 7rem minmax(0, 1fr);
  gap: 1rem;
  align-items: baseline;
}

.about__fact dd {
  margin: 0;
  color: var(--paper-50);
}

@media (max-width: 780px) {
  .about {
    grid-template-columns: minmax(0, 1fr);
  }

  .about__portrait {
    max-width: 260px;
  }

  .about__fact {
    grid-template-columns: minmax(0, 1fr);
    gap: 0.25rem;
  }
}

@media (prefers-reduced-motion: reduce) {
  .about__portrait:hover {
    transform: none;
  }
}
</style>
