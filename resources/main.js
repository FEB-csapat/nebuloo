import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './assets/style.css'

import '@fortawesome/fontawesome-free/css/all.css';

import Vue from 'vue'
import VueGoogleOAuth2 from 'vue-google-oauth2'




const app = createApp(App)

app.use(router)


Vue.use(VueGoogleOAuth2, {
    clientId: '696699163899-v5cqgj49pei5ou6nbb2i9kr8bpeh8coe.apps.googleusercontent.com',
    scope: 'profile email'
  })


app.mount('#app')
