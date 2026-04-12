import { createApp } from 'vue'
import router from './Router'
import { createPinia } from 'pinia'
import App from './Pages/App.vue'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
