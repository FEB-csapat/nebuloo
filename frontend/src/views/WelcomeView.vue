<template>
    <div class="row h-100 bg-primary bg-opacity-75 py-5 text-center text-light">
        <h1 id="welcome-title" class="pt-3 pb-3">Nebuloo</h1>
        <h4 id="welcome-subtitle" class="py-3">Tananyag megosztó fórum</h4>
        <h5 id="welcome-motto" class="pb-5 pt-3 fs-6">Mert a tudás mindenkit megillet</h5>
    </div>
        <div class="container bg-light rounded-4 mt-4 mx-auto text-center py-2 px-4 shadow">
            <div class="row">
                <h4 class="m-3">Nem érted a Viète-formulákat? Kérdezz nyugodtan! Pont hogy érted? Oszdd meg a tudást a többiekkel!</h4>
                <h5>Mászd meg a tudás ranglétráját és vállj bölcsé!</h5>
                <p class="text-start">Rangok:</p>
                <div class="row text-center">
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>tanuló</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>okostojás</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>oktató</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>tanár</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>professzor</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>bölcs</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 mx-auto m-4">
            <div class="container bg-light rounded-3 shadow">
                <h2 class="text-center">Tovább</h2>
                
                <div class="row p-3 d-flex justify-content-center text-center">
                    <div class="col-md-4"><button class="btn shadow" style="background-color: #ffffff; color: #4285f4;" @click="fetchData"><img src="../assets/images/google.png" alt="Button Image"></button> </div>
                    <p class="col-md-4 align-self-center">Vagy</p>
                    <div class="col-md-4">
                        <router-link class="nav-link active" aria-current="page" to="/contents">
                            <button class="btn shadow" style="background-color: #ffffff; color: #4285f4;">Bejelentkezés nélkül</button>
                        </router-link>
                    </div>
                </div>
                    <div class="form-check text-center">
                        <input class="check-input" type="checkbox" value="" id="aszf">
                        <label class="form-check-label ms-1" for="aszf">
                          Elfogadom az ÁSZF-et
                        </label>
                    </div>
                    <div class="row text-center">
                        <div class="col">
                            <router-link class="nav-link active" aria-current="page" to="/ASZF">ÁSZF</router-link>

                        </div>
                        <div class="col">
                            <router-link class="nav-link active" aria-current="page" to="/about">Rólunk</router-link>
                        </div>
                    </div>
            </div>
        </div>
        
</template>

<script>
import axios from 'axios';

export default {
    methods: {
        fetchData() {
            axios.get('http://localhost:8881/api/login/google')
            .then(response => {
                console.log(response.data);

                console.log(response.request.responseURL);

                window.location.href = response.request.responseURL;
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
} 
</script>
