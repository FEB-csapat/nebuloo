<template>
    <div class="container mt-4">
        <h1 class="text-center mb-2">Tananyagok</h1>

        <div id="filter-container">
            <label for="search" class="form-label">Rendezés:</label>
            <select class="form-select" style="width:160px" v-model="orderBy" @change="handleOrderBy">
                <option value="newest">Legújabbak</option>
                <option value="oldest">Legrégebbiek</option>
                <option value="popular">Legnépszerűbbek</option>
            </select>
    
            <tag-selector @subjectItemSelected="handleSubjectItemSelected" @topicItemSelected="handleTopicItemSelected"
                :defaultSubjectId="subjectId" :defaultTopicId="topicId"
                ref="tagSelector"/>
            <p @click="removeFilters" class="text-center text-secondary">Szürők törlése</p>    
        </div>

        <h3 v-if="searchTerm != ''" class="text-center mb-4">Keresési találatok: {{ $route.query.search }}</h3>
    
            <div class="row" v-if="isWaiting">
                <div id="loading-spinner" class="spinner-border mx-auto" role="status">
                </div>
            </div>
        
        <div>
            <cards :Contents="Contents"/>
        </div>
        
        <h3 id="no-result" v-if="Contents.length == 0 && !isWaiting" class="text-center mb-4">Nincs találat</h3>

        <paginator :links="links" :meta="meta" @paginate="handlePaginate" />
        
    </div>


    <div class="fab-button" @click="createContent">
        <span class="m-3">Új tananyag létrehozása</span>
        <i class="fas fa-plus fa-lg"/>
    </div>

    <SnackBar ref="snackBar" :message="'Sikeres bejelentkezés'"/>

</template>

<script>
import Cards from '../components/Cards.vue'
import Paginator from '../components/Paginator.vue';
import router from '../router';

import { NebulooFetch } from '../utils/https.mjs';

import Snackbar from '../components/snackbars/SnackBar.vue';
import TagSelector from '../components/TagSelector.vue';
export default{
    components:{
        Cards,
        Paginator,
        Snackbar,
        TagSelector,
    },
    data(){
        return{
            Contents: [],
            isWaiting: true,
            searchTerm: '',
            currentPage: 1,
            orderBy: 'newest',
            subjectId: null,
            topicId: null,

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
                orderBy: this.orderBy,
                subject: this.subjectId,
                topic: this.topicId,
            }
            var responseBody = (await NebulooFetch.getAllContent(queires)).data;
            this.Contents = responseBody.data;
            this.links = responseBody.links;
            this.meta = responseBody.meta;

            this.isWaiting = false;
        },

        

        createContent(){
            if(localStorage.getItem('userToken')==0) //Unauthenticated
            {
               // this.$refs.snackBar.showSnackbar();
                alert('Tartalmak feltöltéséhez, kérlek jelentkezz be!', router.push('/login'))
            }
            else{
                /*
                this.$refs.snackBar.showSnackbar('Sikertelen szerkesztés', null, function () {
                    console.log('callback');
                });
                */
                router.push('/contents/create')
            }            
        },

        handlePaginate(url) {
            this.currentPage = url.split('page=')[1];

            window.scrollTo(0,0);

            this.refreshPage();          
        },


        handleSubjectItemSelected(subjectId) {
            this.topicId = null;
            this.subjectId = subjectId;
            this.refreshPage();         
        },
        handleTopicItemSelected(topicId) {
            this.topicId = topicId;
            this.refreshPage();
        },
        handleOrderBy() {
            this.refreshPage();
        },

        refreshPage(){
            this.getAllContent();

            this.$router.push({
                name: 'contents',
                query: { orderBy: this.orderBy, search: this.searchTerm,
                    subject: this.subjectId, topic: this.topicId,  page: this.currentPage }
            });


            window.scrollTo(0,0); 
        },

        removeFilters(){
            this.searchTerm = '';
            this.subjectId = null;
            this.topicId = null;
            this.currentPage = 1;
            this.orderBy = 'newest';

            this.$refs.tagSelector.reset()

            this.refreshPage();
        }

    },
    mounted(){
        this.orderBy = this.$route.query.orderBy;
        this.searchTerm = this.$route.query.search;
        this.currentPage = this.$route.query.page;
        this.subjectId = this.$route.query.subject;
        this.topicId = this.$route.query.topic;
        this.getAllContent().then(() => {
            
        });

        // WHat is this abomination?
        // TODO: fix whatever this is
        if(NebulooFetch.token!='0') this.logedin = true;
    },

    watch: {
        '$route.query.search'(newSearchTerm) {
            this.searchTerm = newSearchTerm
            this.getAllContent();
        },
    }
}
</script>