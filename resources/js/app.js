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

const app = createApp(App)

app.use(router)

app.mount('#app')