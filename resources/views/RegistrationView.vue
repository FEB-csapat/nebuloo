<template>
    <div class="container mt-4">
        <div class="row bg-light shadow rounded-3 p-2">
            <form @submit.prevent="Register">
    <label for="name" class="form-label mt-2">Felhasználó név:</label>
    <input v-model="form.name" type="text" name="name" placeholder="Username" class="form-control">
    <!-- <div v-if="form.errors.has('name')" v-html="form.errors.get('username')"/> -->

    <label for="email" class="form-label mt-2">E-mail cím:</label>
    <input v-model="form.email" type="text" name="email" placeholder="E-mail cím" class="form-control">
    <!-- <div v-if="form.errors.has('email')" v-html="form.errors.get('email')"/> -->

    <label for="password" class="form-label mt-2">Jelszó:</label>
    <input v-validate="'required|string|min:8'" v-model="form.password" type="password" name="password" placeholder="Password" ref="password" class="form-control">
    <!-- <div v-if="form.errors.has('password')" v-html="form.errors.get('password')"/> -->

    <label for="password_confirmation" class="form-label mt-2">Jelszó újra:</label>
    <input v-validate="'required|confirmed:password'" v-model="form.password_confirmation" type="password" name="password_confirmation" placeholder="Password again" class="form-control">

    <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="notify_by_email" id="notify_by_email" value="true" v-model="form.notify_by_email">
        <label class="form-check-label" for="notify_by_email">
            Kérek értesítést e-mailben új tartalmakról
        </label>
    </div>


    <button type="submit" class="my-3 btn" id="button">
        Regisztráció
    </button>
</form>
        </div>
    </div>

</template>
<script>
import router from "../router/index.js";
import Form from 'vform'
import axios from 'axios'


export default{
    data(){
        return{
            form: new Form({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            notify_by_email: true
        })
        }
    },
    methods:{
        async Register(){
            const regist = axios.create({
                baseURL: "http://localhost:8881/api/",
                headers: {'Content-Type': 'application/json'}
            });

            console.log(this.form);
            const response = (await regist.post('register',this.form)).data;
            console.log(response);
            router.push('/login');
        }
    }
}
</script>