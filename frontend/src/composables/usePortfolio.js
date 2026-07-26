import { ref } from 'vue'
import api from './useApi'

/**
 * Ambil seluruh konten publik sekali jalan. Paralel, bukan berantai,
 * supaya hero tidak menunggu endpoint lain (target < 2 detik di 4G).
 */
export function usePortfolio() {
  const profile = ref(null)
  const skillCategories = ref([])
  const projects = ref([])
  const experiences = ref([])
  const educations = ref([])
  const loading = ref(true)
  const error = ref(null)

  async function load() {
    loading.value = true
    error.value = null

    try {
      const [p, s, pr, ex, ed] = await Promise.all([
        api.get('/api/profile'),
        api.get('/api/skills'),
        api.get('/api/projects'),
        api.get('/api/experiences'),
        api.get('/api/educations'),
      ])

      profile.value = p.data.data
      skillCategories.value = s.data.data
      projects.value = pr.data.data
      experiences.value = ex.data.data
      educations.value = ed.data.data
    } catch (e) {
      error.value =
        'Konten tidak bisa dimuat. Pastikan server API berjalan di ' + api.defaults.baseURL + '.'
    } finally {
      loading.value = false
    }
  }

  return { profile, skillCategories, projects, experiences, educations, loading, error, load }
}
