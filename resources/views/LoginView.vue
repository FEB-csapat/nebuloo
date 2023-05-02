<template>
    <div class="container mt-4">
        <div class="row bg-light shadow rounded-3 p-2">
            <Form @submit="Login">
                <label for="identifier" class="form-label mt-2">E-mail cím vagy felhasználónév</label>
                <Field id="identifier_field" type="text" name='identifier' placeholder="Email vagy felhasználónév" class="form-control"/>

                <label for="password" class="form-label mt-2">Jelszó:</label>
                <Field id="password_field" type="password" name="password" placeholder="Jelszó" class="form-control"/>

                <button type="submit" class="my-3 btn nebuloobutton" name="login">Bejelentkezés</button>

                <div v-if="errorMessage" name="errormessage" class="error-message bg-opacity-25 border border-danger p-2 d-flex">{{errorMessage}}</div>
            </Form>

            <loading-spinner v-if="isWaiting"/>

            <div class="col-sm-12 my-3">
                <hr>
                <p>
                    Nincs még felhasználód? Regisztrálj egyet!
                </p>
                <button class="btn nebuloobutton">
                    <router-link class="nav-link active" aria-current="page" :to="{ name: 'registration'}">Regisztráció</router-link>
                </button>
            </div>
        </div>

            <SnackBar ref="snackBar" :message="'Sikeres bejelentkezés'"/>
        </div>
    

</template>
<script>
import { Form ,Field } from 'vee-validate';
import axios from 'axios'
import { RequestHelper } from '../utils/RequestHelper';
import router from '../router/index';

import SnackBar from '../components/snackbars/SnackBar.vue';
import LoadingSpinner from '../components/LoadingSpinner.vue';

import { UserManager } from '../utils/UserManager';

export default{
    data(){
        return{
            errorMessage: null,
            isWaiting: false
        }
    },
    components: {
        SnackBar,Field, Form, LoadingSpinner
    },
    methods:{
        async Login(values){
            this.isWaiting = true;
            this.errorMessage = null;

            const login = axios.create({
                baseURL: "http://localhost:8881/api/",
                headers: {'Content-Type': 'application/json'}
            });

            login.post('login', values)
            .then(response=>{
                UserManager.login(response.data.token, response.data.user);

                RequestHelper.initialize(response.data.token);
            })
            .then(response=>{
                this.$router.push({name: 'contents'});
            })
            .catch(error=>{
                console.log(error);
                this.isWaiting = false;
                this.errorMessage = error.response.data.message;
            })
        }
    }
}
</script>