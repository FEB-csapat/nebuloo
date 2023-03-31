<template>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Questions</h1>
        <div class="row" v-if="isWaiting">

            <div class="spinner-border mx-auto" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <cards :Questions="Questions"/>
    </div>
    <router-link class="nav-link active" aria-current="page" to="/create/question">
        <div class="fab-button" @click="onClick">
            <span class="m-3">Create new question</span>
            <i class="fas fa-plus fa-lg"/>
        </div>
    </router-link>
</template>

<script>
import Cards from '../components/Cards.vue'

import { NebulooFetch } from '../utils/https.mjs';

export default{
components:{
        Cards
    },
    data(){
        return{
            Questions: [],
            isWaiting: true
        }
    },
    methods:{
        async getAllQuestions(){
            this.Questions = (await NebulooFetch.getAllQuestions()).data.data;
            isWaiting = false;

        },
    },
    async mounted(){
        
        NebulooFetch.initialize();
        this.getAllQuestions();
        isWaiting = false;
    }
}
</script>