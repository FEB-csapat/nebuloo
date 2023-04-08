<template>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Contents</h1>

        <h3 v-if="searchTerm != ''" class="text-center mb-4">Keresési találatok: {{ $route.query.search }}</h3>

        <div class="row" v-if="isWaiting">
            <div id="loading-spinner" class="spinner-border mx-auto" role="status">
            </div>
        </div>


        <div id='cards'>
            <cards :Contents="Contents"/>
        </div>
        
        <h3 id="no-result" v-if="Contents.length == 0 && !isWaiting" class="text-center mb-4">Nincs találat</h3>

    </div>

    <p class="text-center">
        TODO: create page chooser component
    </p>

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
            Contents: [],
            isWaiting: true,
            searchTerm: ''
        }
    },
    methods:{
        async getAllContent(){
            this.isWaiting = true;
            var queires = {
                search: this.searchTerm,
              //  orderBy: 'newest'
            }
            this.Contents = (await NebulooFetch.getAllContent(queires)).data.data;
            this.isWaiting = false;
        },
    },
    async mounted(){
        this.searchTerm = this.$route.query.search;
        this.getAllContent();
    },

    watch: {
        '$route.query.search'(newSearchTerm) {
            this.searchTerm = newSearchTerm
            this.getAllContent();
        }
    }
}
</script>