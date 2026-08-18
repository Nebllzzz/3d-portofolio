<script setup>
import { reactive, ref } from 'vue'
import api from '../../composables/useApi'
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

const form = reactive({ name: '', email: '', message: '' })
const fieldErrors = ref({})
const status = ref('idle') // idle | sending | sent | error
const errorMessage = ref('')

async function submit() {
  status.value = 'sending'
  fieldErrors.value = {}
  errorMessage.value = ''

  try {
    await api.post('/api/contact', { ...form })
    status.value = 'sent'
    form.name = ''
    form.email = ''
    form.message = ''
  } catch (error) {
    status.value = 'error'
    const response = error.response

    if (response?.status === 422) {
      fieldErrors.value = response.data.errors ?? {}
      errorMessage.value = 'Periksa lagi isian di bawah.'
    } else if (response?.status === 429) {
      errorMessage.value = 'Terlalu banyak percobaan. Coba lagi sebentar lagi.'
    } else {
      errorMessage.value = 'Pesan gagal terkirim. Coba lagi, atau hubungi lewat email.'
    }
  }
}
</script>

<template>
  <section id="contact" class="section section--lift">
    <div class="container">
      <SectionTitle eyebrow="04 — Kontak" title="Mari bicara" />

      <div class="contact">
        <div v-reveal class="contact__aside">
          <p class="contact__pitch">
            Sedang mencari orang yang bisa membangun aplikasi web dari nol? Kirim pesan, saya
            balas secepatnya.
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

        <form v-reveal="{ delay: 80 }" class="contact__form" novalidate @submit.prevent="submit">
          <div class="field">
            <label class="eyebrow" for="name">Nama</label>
            <input id="name" v-model="form.name" type="text" autocomplete="name" required />
            <p v-if="fieldErrors.name" class="field__error">{{ fieldErrors.name[0] }}</p>
          </div>

          <div class="field">
            <label class="eyebrow" for="email">Email</label>
            <input id="email" v-model="form.email" type="email" autocomplete="email" required />
            <p v-if="fieldErrors.email" class="field__error">{{ fieldErrors.email[0] }}</p>
          </div>

          <div class="field">
            <label class="eyebrow" for="message">Pesan</label>
            <textarea id="message" v-model="form.message" rows="5" required />
            <p v-if="fieldErrors.message" class="field__error">{{ fieldErrors.message[0] }}</p>
          </div>

          <button class="btn btn--primary" type="submit" :disabled="status === 'sending'">
            {{ status === 'sending' ? 'Mengirim…' : 'Kirim Pesan' }}
          </button>

          <p v-if="status === 'sent'" class="form-note form-note--ok" role="status">
            Pesan terkirim — saya balas secepatnya.
          </p>
          <p v-if="status === 'error'" class="form-note form-note--bad" role="alert">
            {{ errorMessage }}
          </p>
        </form>
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

.contact__form {
  display: grid;
  gap: 1.25rem;
  justify-items: start;
}

.field {
  display: grid;
  gap: 0.5rem;
  width: 100%;
}

.field input,
.field textarea {
  width: 100%;
  padding: 0.75rem 0.9rem;
  background: var(--ink-700);
  border: 1px solid var(--ink-500);
  border-radius: var(--radius-card);
  color: var(--paper-50);
  font: inherit;
  font-size: 1rem;
  resize: vertical;
  transition: border-color var(--dur-fast) var(--ease-out);
}

.field input:hover,
.field textarea:hover {
  border-color: rgba(245, 245, 242, 0.24);
}

.field__error {
  font-size: 0.8125rem;
  color: var(--paper-50);
}

.form-note {
  font-size: 0.9375rem;
}

.form-note--ok {
  color: var(--paper-50);
}

.form-note--bad {
  color: var(--fog-200);
  border-left: 2px solid var(--paper-50);
  padding-left: 0.75rem;
}

@media (max-width: 820px) {
  .contact {
    grid-template-columns: minmax(0, 1fr);
  }
}
</style>
