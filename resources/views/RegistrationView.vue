<template>
    <div class="container mt-4">
        <div class="row bg-light shadow rounded-3 p-2">
            <Form @submit="Register">
                
    <label for="name" class="form-label mt-2">Felhasználó név:</label>
    <Field rules="alpha_num" type="text" name="name" placeholder="Felhasználó név" class="form-control"/>
    <ErrorMessage name="name" class="bg-opacity-25 border border-danger p-2 d-flex" />

    <label for="email" class="form-label mt-2">E-mail cím:</label>
    <Field rules="email" type="text" name="email" placeholder="E-mail cím" class="form-control"/>
    <ErrorMessage name="email" class="bg-opacity-25 border border-danger p-2 d-flex" />

    <label for="password" class="form-label mt-2">Jelszó:</label>
    <Field :rules="{ regex: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/ }" type="password" name="password" placeholder="Jelszó" ref="password" class="form-control"/>
    <ErrorMessage name="password" class="bg-opacity-25 border border-danger p-2 d-flex" />
    <p class="text-muted ms-1">
        A jelszónak <b>legalább 8 karakter</b> hosszúnak kell lennie, és <b>tartalmaznia kell</b> az alábbiakat: Legalább 1 <b>Nagybetű</b>, <b>Kisbetű</b>, <b>Szám</b>, és <b>Speciális karakter</b>.
    </p>

    <label for="password_confirmation" class="form-label mt-2">Jelszó újra:</label>
    <Field rules="confirmed:@password" type="password" name="password_confirmation" placeholder="Jelszó újra" class="form-control"/>
    <ErrorMessage name="password_confirmation" class="bg-opacity-25 border border-danger p-2 d-flex" />

    
    <div class="form-check mt-2">
        <Field rules="required" class="form-check-input" type="checkbox" id="aszf" name="aszf" value="false"/>
        <label class="form-check-label ms-1" for="aszf">
            Elfogadom az ÁSZF-et
        </label>
        <ErrorMessage name="aszf"/>
    </div>
    
    <div class="col my-2">
        <button class="btn btn-primary">
            <router-link class="nav-link active" aria-current="page" to="/ASZF">ÁSZF</router-link>
        </button>
    </div> 

    <div class="form-check mt-2">
        <Field class="form-check-input" type="checkbox" name="notify_by_email" id="notify_by_email" value="true"/>
        <label class="form-check-label ms-1" for="notify_by_email">
            Kérek értesítést e-mailben új tartalmakról
        </label>
    </div>

    <button type="submit" class="my-3 btn btn-primary" id="registrationbutton">
        Regisztráció
    </button>
    
    </Form>
        
    <div v-if="isWaiting" id="loading-spinner" class="spinner-border mx-auto" role="status"></div>
    <router-link class="nav-link active btn btn-success my-3 p-2" aria-current="page" to="login">Bejelentkezés</router-link>

        </div>
    </div>
    
</template>
<script>
import router from "../router/index.js";
import { Form ,Field, ErrorMessage } from 'vee-validate';
import axios from 'axios';
import SnackBar from "../components/snackbars/SnackBar.vue";


export default{
    data(){
        return{
            errors:{
            name: "A felhasználónév már foglalt!",
            email: "Ez az email cím már foglalt!",
            password: "A jelszónak legalább 8 karakter hosszúnak kell lennie!",
            password_confirmation: "A két jelszó nem megegyező"
            },
            isWaiting: false,
        }
    },
    components:{
        SnackBar,Field, Form, ErrorMessage
    },
    methods:{
        async Register(values){
            this.isWaiting = true;

            const regist = axios.create({
                baseURL: "http://192.168.1.8:8881/api/",
                headers: {'Content-Type': 'application/json'}
            });

            regist.post('register',values)
            .then(response=>{
                router.push('/login');
                alert("Sikeres regisztráció");                
            })
            .catch(errors=>{
                this.errors = errors;
            })
        }
    }
}
</script>