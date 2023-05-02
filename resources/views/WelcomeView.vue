<template>
    <div class="row bg-primary bg-opacity-75 pt-4 pb-4 text-center text-light">
        <img class="mx-auto border border-5 rounded-circle border-dark" style="width: 200px; padding:0;" v-bind:src="logo" alt="logo"/>

        <h1 id="welcome-title" class="pb-2">Nebuloo</h1>
        <h2 id="welcome-subtitle" class="py-3">Tananyag megosztó fórum</h2>
        <h5 id="welcome-motto" class="pt-3 fs-4">Mert a tudás mindenkit megillet</h5>
    </div>

    <div class="container bg-light rounded-4 mt-4 mx-auto text-center py-2 px-4 shadow">
        <h4 class="m-3">Nem érted a Viète-formulákat? Kérdezz nyugodtan! Pont hogy érted? Oszd meg a tudást a többiekkel!</h4>
        <h5>Mászd meg a tudás ranglétráját és vállj bölcsé!</h5>
        
        <h5 class="text-start mt-4">Rangok:</h5>
        <h5>Szerezz szavazatokat a feltöltött tananyagaiddal, kérdéseiddel és hozzászolásaiddal!</h5>
        
        <div class="row justify-content-evenly align-items-end" >
            <div class="col-4 col-md-2">
                <div class="d-flex justify-content-center mb-2 flex-column" style="letter-spacing: 4px">        
                    <p class="text-secondary"><br>alap</p>
                    <user :user="zoldfulu" :clickable="false" :showDetailed="true"/>
                </div>
            </div>
            <div class="col-4 col-md-2">
                <div class="d-flex justify-content-center mb-2 flex-column" style="letter-spacing: 4px">
                    <p class="text-secondary">10 szavazat fölött</p>
                    <user :user="okostojas" :clickable="false" :showDetailed="true"/>
                </div>
            </div>
            <div class="col-4 col-md-2">
                <div class="d-flex justify-content-center mb-2 flex-column" style="letter-spacing: 4px">
                    <p class="text-secondary">25 szavazat fölött</p>
                    <user :user="zseni" :clickable="false" :showDetailed="true"/>
                </div>
            </div>
            <div class="col-4 col-md-2">
                <div class="d-flex justify-content-center mb-2 flex-column" style="letter-spacing: 4px">
                    <p class="text-secondary">50 szavazat fölött</p>
                    <user :user="langesz" :clickable="false" :showDetailed="true"/>
                </div>
            </div>
            <div class="col-4 col-md-2">
                <div class="d-flex justify-content-center mb-2 flex-column" style="letter-spacing: 4px">
                    <p class="text-secondary">100 szavazat fölött</p>
                    <user :user="bolcs" :clickable="false" :showDetailed="true"/>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mx-auto m-4">
        <div v-if="token==null" class="container bg-light rounded-3 shadow">
            <h2 class="text-center" >Folytatás</h2>
            
            <div class="row p-3 d-flex justify-content-center text-center">
                <div class="col-md-4">
                    <router-link class="nav-link active" aria-current="page" :to="{ name: 'login'}">
                        <button class="btn nebuloobutton">Fiókkal</button>
                    </router-link>
                </div>
                <p class="col-md-4 align-self-center">Vagy</p>
                <div class="col-md-4">
                    <router-link class="nav-link active" aria-current="page" :to="{ name: 'contents'}">
                        <button class="btn nebuloobutton" name="enterasguest">Fiók nélkül</button>
                    </router-link>
                </div>
            </div>
        </div>

        <div v-else class="container bg-light rounded-3 p-1 shadow">
            <h4 class="text-center" >Már be vagy jelentkezve:</h4>

            <div class="text-center">
                <user v-if="user != null" :user="user"/>
            </div>

            <router-link class="text-center nav-link active mb-2" aria-current="page" :to="{ name: 'contents'}">
                <button class="btn shadow" style="background-color: #ffffff; color: #4285f4;">Folytatás</button>
            </router-link>
        </div>
    </div>
</template>

<script>
import User from '../components/User.vue';
import logo from '../assets/images/logo.png';

import { UserManager } from '../utils/UserManager';
export default {
    data(){
        return{
            token: '',
            zoldfulu: {
                display_name: 'Zöldfülű',
                rank: { id: 1},
            },
            okostojas: {
                display_name: 'Okostojás',
                rank: { id: 2},
            },
            zseni: {
                display_name: 'Zseni',
                rank: { id: 3},
            },
            langesz: {
                display_name: 'Lángész',
                rank: { id: 4},
            },
            bolcs: {
                display_name: 'Bölcs',
                rank: { id: 5},
            },
        }
    },
    components:{
        User
    },
    async mounted(){
        this.token = UserManager.getToken();
    },
    computed: {
        user(){
            return UserManager.getUser();
        },
        logo: function(){
            return logo;
        }
    }
}
</script>
