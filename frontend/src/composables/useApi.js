import axios from 'axios'

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000',
  headers: { Accept: 'application/json' },
  timeout: 10000,
})

export function useApi() {
  return api
}

export default api
