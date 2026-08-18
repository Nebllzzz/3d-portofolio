<script setup>
import SectionTitle from '../ui/SectionTitle.vue'

defineProps({
  profile: { type: Object, default: null },
})

// Tampilkan alamat sebenarnya, bukan mengulang nama platform.
function readableTarget(url) {
  return String(url)
    .replace(/^mailto:/, '')
    .replace(/^https?:\/\//, '')
    .replace(/\/$/, '')
}

</script>

<template>
  <section id="contact" class="section section--lift">
    <div class="container">
      <SectionTitle eyebrow="04 — Kontak" title="Mari bicara" />

      <div class="contact">
        <div v-reveal class="contact__aside">
          <p class="contact__pitch">
            Sedang mencari orang yang bisa membangun aplikasi web dari nol? Hubungi saya lewat
            email atau WhatsApp.
          </p>

          <ul v-if="profile?.socials?.length" class="contact__links">
            <li v-for="social in profile.socials" :key="social.id">
              <a :href="social.url" target="_blank" rel="noopener" class="contact__link">
                <span class="eyebrow">{{ social.label }}</span>
                <span class="contact__target">{{ readableTarget(social.url) }}</span>
              </a>
            </li>
          </ul>
        </div>

        <div v-reveal="{ delay: 80 }" class="contact__actions" aria-label="Pilihan kontak">
          <a class="btn btn--primary" :href="`mailto:${profile?.email}`">Kirim Email</a>
          <a class="btn btn--ghost" href="https://wa.me/628976321037" target="_blank" rel="noopener">
            Chat WhatsApp
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.contact {
  display: grid;
  grid-template-columns: minmax(0, 0.85fr) minmax(0, 1fr);
  gap: clamp(2rem, 5vw, 4rem);
  align-items: start;
}

.contact__pitch {
  font-size: clamp(1.0625rem, 1.5vw, 1.1875rem);
  color: var(--fog-200);
  max-width: 34ch;
}

.contact__links {
  list-style: none;
  margin: 2.5rem 0 0;
  padding: 0;
  border-top: 1px solid var(--ink-500);
}

.contact__link {
  display: grid;
  grid-template-columns: 6rem minmax(0, 1fr);
  gap: 1rem;
  align-items: baseline;
  padding: 0.9rem 0;
  border-bottom: 1px solid var(--ink-500);
  color: var(--fog-200);
  transition:
    color var(--dur-fast) var(--ease-out),
    padding-left var(--dur-fast) var(--ease-out);
}

.contact__link:hover {
  color: var(--paper-50);
  padding-left: 0.5rem;
}

.contact__target {
  font-family: var(--font-mono);
  font-size: 0.8125rem;
  overflow-wrap: anywhere;
}

.contact__actions {
  display: grid;
  gap: 0.75rem;
  justify-items: start;
  align-content: start;
}

@media (max-width: 820px) {
  .contact {
    grid-template-columns: minmax(0, 1fr);
  }
}
</style>
