import './bootstrap.js'
import { createApp } from 'vue'
import router from './Router'
import { createPinia } from 'pinia'
import App from './Pages/App.vue'
import 'bootstrap/dist/css/bootstrap.min.css'
import '../../public/style.css'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
