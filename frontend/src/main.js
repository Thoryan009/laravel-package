import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import { registerGlobalComponents } from '@/registerGlobalComponents'
import  queryClient  from '@/config/queryClient'

import { VueQueryPlugin } from '@tanstack/vue-query'

// --- toast ---
import Toast from 'vue-toastification'
import { toastOptions } from '@/shared/config/toastConfig'

import 'vue-toastification/dist/index.css'
// --- / toast ---

const app = createApp(App)

registerGlobalComponents(app)

app.use(createPinia())
app.use(router).use(Toast, toastOptions)

app.use(VueQueryPlugin, {
  queryClient,
})


app.mount('#app')
