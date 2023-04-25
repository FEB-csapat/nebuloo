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
import { UserManager } from '../utils/UserManager.js';

import AllRules from '@vee-validate/rules';
import { defineRule } from 'vee-validate';


//import EventBus from './EventBus.js'

//createApp.prototype.$eventBus = EventBus


if(UserManager.getToken() == null){
    NebulooFetch.initialize(0); /*Universal token */
}else{
    NebulooFetch.initialize(UserManager.getToken());
}

Object.keys(AllRules).forEach(rule => {
    defineRule(rule, AllRules[rule]);
});

const app = createApp(App)

app.use(router)

app.mount('#app')