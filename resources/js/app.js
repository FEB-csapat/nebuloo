import { createApp } from 'vue'
import App from './App.vue'
import router from '../router';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../assets/style.css'

import '@fortawesome/fontawesome-free/css/all.css'
import { RequestHelper } from '../utils/RequestHelper';
import { UserManager } from '../utils/UserManager.js';

import AllRules from '@vee-validate/rules';
import { defineRule } from 'vee-validate';

RequestHelper.initialize(UserManager.getToken());

Object.keys(AllRules).forEach(rule => {
    defineRule(rule, AllRules[rule]);
});

const app = createApp(App)
app.use(router)
app.mount('#app')