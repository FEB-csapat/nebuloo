<template>
<form @submit.prevent="Login">
    <label for="email">E-mail cím</label>
    <input v-model="form.email" type="text" name='email' placeholder="Email">

    <label for="password">Jelszó:</label>
    <input v-model="form.password" type="password" name="password" placeholder="Jelszó">

    <button type="submit">Bejelentkezés</button>
</form>

<router-link class="nav-link active" aria-current="page" to="/ASZF">ÁSZF</router-link>
<router-link class="nav-link active" aria-current="page" to="/about">Rólunk</router-link>
</template>
<script>
import Form from 'vform'
import axios from 'axios'
import { NebulooFetch } from '../utils/https.mjs';
import router from '../router/index';

export default{
    data(){
        return{
            form: new Form({
                email: '',
                password: ''
            })
        }
    },
    methods:{
        async Login(){
            const login = axios.create({
                baseURL: "http://localhost:8881/api/",
                headers: {'Content-Type': 'application/json'}
            });

            login.post('login',this.form)
            .then(response=>{
                sessionStorage.setItem('userToken',response.data.token);
                NebulooFetch.initialize(response.data.token);
            })
            .then(response=>{
                alert("Sikeres bejelentkezés!");
                router.push('/');
            })
        }
    }
}

</script>