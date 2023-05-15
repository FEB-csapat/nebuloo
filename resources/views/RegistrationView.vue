<template>
    <div class="container mt-4">
        <div class="row bg-light shadow rounded-3 p-2">
            <Form @submit="Register">

                <label for="username" class="form-label mt-2">Felhasználó név:</label>
                <Field rules="required|alpha_num" type="text" name="username" placeholder="Felhasználó név" class="form-control" />
                <ErrorMessage name="username" class="alert alert-danger d-flex p-2 mt-2" />
                <span v-if="possibError.name"
                    class="d-inline-flex mt-2 error-message bg-danger text-white bg-opacity-25 border border-danger p-2">{{ possibError.name }}</span>

                <label for="email" class="form-label mt-2 d-flex">E-mail cím:</label>
                <Field rules="required|email" type="text" name="email" placeholder="E-mail cím" class="form-control" />
                <ErrorMessage name="email" class="alert alert-danger d-flex p-2 mt-2" />
                <span v-if="possibError.email"
                    class="d-inline-flex mt-2 error-message bg-danger text-white bg-opacity-25 border border-danger p-2">{{ possibError.email }}</span>

                <label for="password" class="form-label mt-2 d-flex">Jelszó:</label>
                <Field :rules="{ required: true, regex: /^(?=.*?[A-ZÁÉŐÚÜŰÓÖÜÍ])(?=.*?[a-zóöüúőáéí])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/ }" type="password"
                    name="password" placeholder="Jelszó" ref="password" class="form-control" />
                <ErrorMessage name="password" class="alert alert-danger d-flex p-2 mt-2" />
                <p class="text-muted ms-1">
                    A jelszónak <b>legalább 8 karakter</b> hosszúnak kell lennie, és <b>tartalmaznia kell</b> az alábbiakat:
                    Legalább 1 <b>Nagybetű</b>, <b>Kisbetű</b>, <b>Szám</b>, és <b>Speciális karakter</b>.
                </p>

                <label for="password_confirmation" class="form-label mt-2">Jelszó újra:</label>
                <Field rules="required|confirmed:@password" type="password" name="password_confirmation" placeholder="Jelszó újra"
                    class="form-control" />
                <ErrorMessage name="password_confirmation" class="alert alert-danger d-flex p-2 mt-2" />


                <div class="form-check mt-2">
                    <Field rules="required" class="form-check-input" type="checkbox" id="aszf" name="aszf" value="false" />
                    <label class="form-check-label ms-1" for="aszf">
                        Elfogadom az ÁSZF-et
                    </label>                    
                </div>
                <ErrorMessage name="aszf" class="alert alert-danger d-flex p-2 mt-2"/>

                <div class="col my-2">
                    <button class="btn btn-primary">
                        <router-link class="nav-link active" aria-current="page" :to="{ name: 'aszf' }">ÁSZF</router-link>
                    </button>
                </div>

                <div class="form-check mt-2">
                    <Field class="form-check-input" type="checkbox" name="notify_by_email" id="notify_by_email"
                        value="true" />
                    <label class="form-check-label ms-1" for="notify_by_email">
                        Kérek értesítést e-mailben új tartalmakról
                    </label>
                </div>

                <button type="submit" class="btn nebuloobutton" id="registrationbutton">
                    Regisztráció
                </button>
            </Form>

            <loading-spinner v-if="isWaiting" />

            <div class="col-sm-12 my-3">
                <hr>
                <p>Van már fiókod? Jelentkezz be!</p>
                <button class="btn nebuloobutton">
                    <router-link class="nav-link active" aria-current="page"
                        :to="{ name: 'login' }">Bejelentkezés</router-link>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import router from "../router/index.js";
import { Form, Field, ErrorMessage } from 'vee-validate';
import axios from 'axios';
import SnackBar from "../components/snackbars/SnackBar.vue";
import LoadingSpinner from "../components/LoadingSpinner.vue";

export default {
    data() {
        return {
            possibError: {
                name: '',
                email: ''
            },
            isWaiting: false,
        }
    },
    components: {
        SnackBar, Field, Form, ErrorMessage, LoadingSpinner
    },
    methods: {
        async Register(values) {
            this.isWaiting = true;

            const regist = axios.create({
                baseURL: "http://localhost:8881/api/",
                headers: { 'Content-Type': 'application/json' }
            });

            regist.post('register', values)
                .then(response => {
                    this.$router.push({ name: 'login' });
                    alert("Sikeres regisztráció");
                })
                .catch(errors => {
                    this.possibError.name = errors.response.data.errors.name[0];
                    this.possibError.email = errors.response.data.errors.email[0];
                    this.isWaiting = false;
                })
        }
    }
}
</script>