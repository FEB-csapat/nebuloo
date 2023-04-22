<template>
    <div class="container mt-4">
        <div class="row bg-light shadow rounded-3 p-2">
            <Form @submit="Login">
                <label for="identifier" class="form-label mt-2">E-mail cím vagy felhasználónév</label>
                <Field id="identifier_field" type="text" name='identifier' placeholder="Email vagy felhasználónév" class="form-control"/>

                <label for="password" class="form-label mt-2">Jelszó:</label>
                <Field id="password_field" type="password" name="password" placeholder="Jelszó" class="form-control"/>

                <button type="submit" class="my-3 btn" id="button">Bejelentkezés</button>

                <div v-if="errorMessage" class="error-message bg-danger text-white bg-opacity-25 border border-danger p-2">{{errorMessage}}</div>
            </Form>
            <div class="col-sm-12 my-3">
                <p>
                    Nincs még felhasználód? Regisztrálj egyet!
                </p>
                <button class="btn" id="button">
                    <router-link class="nav-link active" aria-current="page" to="/registration">Regisztráció</router-link>
                </button>
            </div>
            </div>

            <SnackBar ref="snackBar" :message="'Sikeres bejelentkezés'"/>
        </div>
    

</template>
<script>
import { Form ,Field } from 'vee-validate';
import axios from 'axios'
import { NebulooFetch } from '../utils/https.mjs';
import router from '../router/index';

import SnackBar from '../components/snackbars/SnackBar.vue';

export default{
    data(){
        return{
            errorMessage: null
        }
    },
    components: {
        SnackBar,Field, Form
    },
    methods:{
        async Login(values){
            const login = axios.create({
                baseURL: "http://localhost:8881/api/",
                headers: {'Content-Type': 'application/json'}
            });

            login.post('login', values)
            .then(response=>{
                sessionStorage.setItem('userToken',response.data.token);
                sessionStorage.setItem('Identifier',response.data.user.id);
                sessionStorage.setItem('userRole',response.data.user.role);
                sessionStorage.setItem('userRank',response.data.user.rank.id);
                sessionStorage.setItem('userName',response.data.user.name);
                NebulooFetch.initialize(response.data.token);
            })
            .then(response=>{
              //  alert("Sikeres bejelentkezés!");
                this.$refs.snackBar.showSnackbar();
                router.push('/contents');
            })
            .catch(error=>{
                this.errorMessage = error.response.data.message;
            })
        }
    }
}
</script>