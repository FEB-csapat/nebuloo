<template>
    <div class="row h-100 bg-primary bg-opacity-75 py-5 text-center text-light">
        <h1 id="welcome-title" class="pt-3 pb-3">Nebuloo</h1>
        <h4 id="welcome-subtitle" class="py-3">Tananyag megosztó fórum</h4>
        <h5 id="welcome-motto" class="pb-5 pt-3 fs-6">Mert a tudás mindenkit megillet</h5>
    </div>
        <div class="container bg-light rounded-4 mt-4 mx-auto text-center py-2 px-4 shadow">
                <h4 class="m-3">Nem érted a Viète-formulákat? Kérdezz nyugodtan! Pont hogy érted? Oszdd meg a tudást a többiekkel!</h4>
                <h5>Mászd meg a tudás ranglétráját és vállj bölcsé!</h5>
                <p class="text-start">Rangok:</p>

                <div class="d-flex justify-content-evenly">

                    <div class="col-xs-2">
                        <div class="d-flex justify-content-center">
                            <user :user="zoldfulu" :clickable="false"/>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="d-flex justify-content-center">
                            <user :user="okostojas" :clickable="false"/>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="d-flex justify-content-center">
                            <user :user="zseni" :clickable="false"/>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="d-flex justify-content-center">
                            <user :user="langesz" :clickable="false"/>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="d-flex justify-content-center">
                            <user :user="bolcs" :clickable="false"/>
                        </div>
                    </div>
                    
                </div>
        </div>

        <div class="col-sm-6 mx-auto m-4">
            <div v-if="token==null" class="container bg-light rounded-3 shadow">
                <h2 class="text-center" >Folytatás</h2>
                
                <div class="row p-3 d-flex justify-content-center text-center">
                    <div class="col-md-4">
                        <router-link class="nav-link active" aria-current="page" to="/login">
                            <button class="btn shadow" style="background-color: #ffffff; color: #4285f4;">Fiókkal</button>
                        </router-link>
                    </div>
                    <p class="col-md-4 align-self-center">Vagy</p>
                    <div class="col-md-4">
                        <router-link class="nav-link active" aria-current="page" to="/contents">
                            <button class="btn shadow" style="background-color: #ffffff; color: #4285f4;">Fiók nélkül</button>
                        </router-link>
                    </div>
                </div>
            </div>
            <div v-else class="container bg-light rounded-3 shadow">
                <h3 class="text-center" >Már be vagy jelentkezve</h3>

                <div class="text-center">
                    <router-link class="nav-link active" aria-current="page" to="/contents">

                        <button class="btn shadow" style="background-color: #ffffff; color: #4285f4;">Folytatás</button>
                    </router-link>
                </div>
                

            </div>
        </div>
</template>

<script>
import { NebulooFetch } from '../utils/https.mjs';
import User from '../components/User.vue';
export default {
    data(){
        return{
            token: '',
            zoldfulu: {
                name: 'Zöldfülű',
                rank: { id: 1},
            },
            okostojas: {
                name: 'Okostojás',
                rank: { id: 2},
            },
            zseni: {
                name: 'Zseni',
                rank: { id: 3},
            },
            langesz: {
                name: 'Lángész',
                rank: { id: 4},
            },
            bolcs: {
                name: 'Bölcs',
                rank: { id: 5},
            },
        }
    },
    components:{
        User
    },
    async mounted(){
        this.token = sessionStorage.getItem('userToken');
    }

}
</script>
