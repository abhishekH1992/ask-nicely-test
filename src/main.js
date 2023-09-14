import { createApp } from 'vue'
import Index from './Index.vue'
import store from './store'
import Notifications from '@kyvg/vue3-notification'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'

const app = createApp(Index)
app.use(store)
app.use(Notifications)

app.mount('#app')