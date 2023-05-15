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
import { defineRule, configure } from 'vee-validate';
import hu from '@vee-validate/i18n/dist/locale/hu.json';
import { setLocale, localize } from '@vee-validate/i18n';

RequestHelper.initialize(UserManager.getToken());

Object.keys(AllRules).forEach(rule => {
    defineRule(rule, AllRules[rule]);
});

configure({
    generateMessage: localize({
      hu: {
        messages: hu.messages,
        names:{
            username: "felhasználó név",
            email: "e-mail cím",
            password: 'jelszó',
            password_confirmation: "jelszó ellenőrző",
            aszf: "általános szerződési feltételek",
            identifier: "név / e-mail cím"
        },
      }
    }),
  });
  
  setLocale('hu');

const app = createApp(App)
app.use(router)
app.mount('#app')