<template>
    <div class="container mt-4">
        <div class="row bg-light shadow rounded-3 p-2">
            <form @submit.prevent="Login">
                <label for="identifier" class="form-label mt-2">E-mail cím vagy felhasználónév</label>
                <input id="identifier_field" v-model="form.identifier" type="text" name='identifier' placeholder="Email vagy felhasználónév" class="form-control">

                <label for="password" class="form-label mt-2">Jelszó:</label>
                <input id="password_field" v-model="form.password" type="password" name="password" placeholder="Jelszó" class="form-control">

                <button type="submit" class="my-3 btn" id="button">Bejelentkezés</button>
            </form>
            <div class="col-sm-12 my-3">
                <p>
                    Nincs még felhasználód? Regisztrálj egyet!
                </p>
                <button class="btn" id="button">
                    <router-link class="nav-link active" aria-current="page" to="/registration">Regisztráció</router-link>
                </button>
            </div>
            <div class="col-sm-6 text-center" >
                <router-link class="nav-link active" aria-current="page" to="/ASZF">ÁSZF</router-link>
            </div>

            <div class="col-sm-6 text-center">
                <router-link class="nav-link active" aria-current="page" to="/about">Rólunk</router-link>
            </div>

            <SnackBar ref="snackBar" :message="'Sikeres bejelentkezés'"/>
        </div>
    </div>

</template>
<script>
import Form from 'vform'
import axios from 'axios'
import { NebulooFetch } from '../utils/https.mjs';
import router from '../router/index';

import SnackBar from '../components/SnackBar.vue';

export default{
    data(){
        return{
            form: new Form({
                identifier: '',
                password: ''
            })
        }
    },
    components: {
        SnackBar
    },
    methods:{
        async Login(){
            const login = axios.create({
                baseURL: "http://localhost:8881/api/",
                headers: {'Content-Type': 'application/json'}
            });

            login.post('login', this.form)
            .then(response=>{
                sessionStorage.setItem('userToken',response.data.token);
                sessionStorage.setItem('Identifier',response.data.user.id);
                NebulooFetch.initialize(response.data.token);
            })
            .then(response=>{
              //  alert("Sikeres bejelentkezés!");
                this.$refs.snackBar.showSnackbar();
                router.push('/contents');
            })
        }
    }
}

</script>