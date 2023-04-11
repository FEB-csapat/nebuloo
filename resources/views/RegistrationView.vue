<template>
<form @submit.prevent="Register">
    <label for="name">Felhasználó név:</label>
    <input v-model="form.name" type="text" name="name" placeholder="Username">
    <!-- <div v-if="form.errors.has('name')" v-html="form.errors.get('username')"/> -->

    <label for="email">E-mail cím:</label>
    <input v-model="form.email" type="text" name="email" placeholder="E-mail cím">
    <!-- <div v-if="form.errors.has('email')" v-html="form.errors.get('email')"/> -->

    <label for="password">Jelszó:</label>
    <input v-validate="'required|string|min:8'" v-model="form.password" type="password" name="password" placeholder="Password" ref="password">
    <!-- <div v-if="form.errors.has('password')" v-html="form.errors.get('password')"/> -->

    <label for="password_confirmation">Jelszó újra:</label>
    <input v-validate="'required|confirmed:password'" v-model="form.password_confirmation" type="password" name="password_confirmation" placeholder="Password again">

    <button type="submit">
        Regisztráció
    </button>
</form>
</template>
<script>
import Form from 'vform'
import axios from 'axios'


export default{
    data(){
        return{
            form: new Form({
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        })
        }
    },
    methods:{
        async Register(){
            const regist = axios.create({
                baseURL: "http://localhost:8881/api/",
                headers: {'Content-Type': 'application/json'}
            });

            const response = (await regist.post('register',this.form)).data;
            console.log(response);
        }
    }
}
</script>