import { createApp } from 'vue'
import App from './App.vue'
import { vReveal } from './composables/useReveal'
import { vTilt } from './components/three/useTilt'
import './assets/styles/base.css'

createApp(App).directive('reveal', vReveal).directive('tilt', vTilt).mount('#app')
