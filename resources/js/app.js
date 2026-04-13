import './bootstrap.js'
import { createApp } from 'vue'
import router from './Router'
import { createPinia } from 'pinia'
import App from './Pages/App.vue'
import 'bootstrap/dist/css/bootstrap.min.css'
import '../../public/style.css'
import {useUserStore} from "../stores/user.js";

const app = createApp(App)

app.use(createPinia())
await useUserStore().userAuthCheck()
app.use(router)

app.mount('#app')
