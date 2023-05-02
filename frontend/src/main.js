import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store' 
import Notifications from '@kyvg/vue3-notification'
import "../public/assets/css/style.css";


createApp(App).use(store).use(router).use(Notifications).mount('#app')
