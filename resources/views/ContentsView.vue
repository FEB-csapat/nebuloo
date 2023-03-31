<template>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Contents</h1>
        <cards :Contents="Contents"/>
    </div>

    <router-link class="nav-link active" aria-current="page" to="/create/content">
        <div class="fab-button" @click="onClick">
            <span class="m-3">Create new content</span>
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
            Contents: []
        }
    },
    methods:{
        async getAllContent(){
            this.Contents = (await NebulooFetch.getAllContent()).data.data;
        },
    },
    async mounted(){
        NebulooFetch.initialize();
        this.getAllContent();
    }
}
</script>