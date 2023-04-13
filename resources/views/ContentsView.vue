<template>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Contents</h1>

        <h3 v-if="searchTerm != ''" class="text-center mb-4">Keresési találatok: {{ $route.query.search }}</h3>

        <div class="row" v-if="isWaiting">
            <div id="loading-spinner" class="spinner-border mx-auto" role="status">
            </div>
        </div>


        <div>
            <cards :Contents="Contents"/>
        </div>
        
        <h3 id="no-result" v-if="Contents.length == 0 && !isWaiting" class="text-center mb-4">Nincs találat</h3>

        <div>
            <paginator :links="links" :meta="meta" @paginate="handlePaginate" />
        </div>
    </div>

    <p class="text-center">
        TODO: center this component
    </p>

    <router-link v-if="logedin" class="nav-link active" aria-current="page" to="/create/content">
        <div class="fab-button" @click="onClick">
            <span class="m-3">Create new content</span>
            <i class="fas fa-plus fa-lg"/>
        </div>
    </router-link>
</template>

<script>
import Cards from '../components/Cards.vue'
import Paginator from '../components/Paginator.vue';

import { NebulooFetch } from '../utils/https.mjs';

export default{
    components:{
        Cards,
        Paginator
    },
    data(){
        return{
            Contents: [],
            isWaiting: true,
            searchTerm: '',
            currentPage: 1,

            links: {}, 
            meta: {},
            logedin: false,
        }
    },
    methods:{
        async getAllContent(){
            this.isWaiting = true;
            this.Contents = [];
            var queires = {
                search: this.searchTerm,
                page: this.currentPage,
              //  orderBy: 'newest'
            }
            var responseBody = (await NebulooFetch.getAllContent(queires)).data;
            this.Contents = responseBody.data;
            this.links = responseBody.links;
            this.meta = responseBody.meta;

            this.isWaiting = false;
        },

        handlePaginate(url) {
            this.currentPage = url.split('page=')[1];

            this.getAllContent();
            window.scrollTo(0,0);

            this.$router.push({
                name: 'contents',
                query: { search: this.searchTerm, page: this.currentPage }
            });            
        }
    },
    mounted(){
        this.searchTerm = this.$route.query.search;
        this.currentPage = this.$route.query.page;
        this.getAllContent();
        if(NebulooFetch.token!='0') this.logedin = true;
    },

    watch: {
        '$route.query.search'(newSearchTerm) {
            this.searchTerm = newSearchTerm
            this.getAllContent();
        },
       /* '$route.query.page'(newPage) {
            this.currentPage = newPage
            this.getAllContent();
        }
        */
    }
}
</script>