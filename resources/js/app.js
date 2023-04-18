/*
import './bootstrap';
import {createApp} from "vue";
import App from "./App.vue";
import "bootstrap/scss/bootstrap.scss"
import "../css/app.scss"
import router from "./router";


import './assets/style.css'

import '@fortawesome/fontawesome-free/css/all.css'

*/


import { createApp } from 'vue'
import App from './App.vue'
import router from '../router';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../assets/style.css'

import '@fortawesome/fontawesome-free/css/all.css'
import { NebulooFetch } from '../utils/https.mjs';

if(sessionStorage.getItem('userToken')===null){
    NebulooFetch.initialize(0); /*Universal token */
}else{
    NebulooFetch.initialize(sessionStorage.getItem('userToken'));
}

const app = createApp(App)

app.use(router)

app.mount('#app')