<template>
    <div class="container">
        <h2 class="text-center mt-3 mb-1">Kérdések</h2>

        <div id="filter-container">
            <div class="d-flex justify-content-between">
                <div class="">
                    <tag-selector @subjectItemSelected="handleSubjectItemSelected" @topicItemSelected="handleTopicItemSelected"
                    :defaultSubjectId="subjectId" :defaultTopicId="topicId"
                    ref="tagSelector"/>
                </div>

                <div class="ms-1">
                    <label for="search" class="form-label">Rendezés:</label>
                    <select class="form-select" style="width:160px" v-model="orderBy" @change="handleOrderBy">
                        <option value="newest">Legújabbak</option>
                        <option value="oldest">Legrégebbiek</option>
                        <option value="popular">Legnépszerűbbek</option>
                    </select>
                </div>
            </div>
            <p @click="removeFilters" class="text-center text-secondary">Szürők törlése</p>    
        </div>
        
        <h3 v-if="searchTerm != ''" class="text-center mb-4">Keresési találatok: {{ $route.query.search }}</h3>

        <div class="row" v-if="isWaiting">
            <div id="loading-spinner" class="spinner-border mx-auto" role="status">
            </div>
        </div>

        <div>
            <cards :Questions="Questions"/>
        </div>

        <h3 id="no-result" v-if="Questions.length == 0 && !isWaiting" class="text-center mb-4">Nincs találat</h3>

        <paginator :links="links" :meta="meta" @paginate="handlePaginate" />

    </div>
        <div class="fab-button" @click="createQuestion()">
            <span class="m-3">Új kérdés létrehozása</span>
            <i class="fas fa-plus fa-lg"/>
        </div>

        <SnackBar ref="snackBar"/>

</template>

<script>
import Cards from '../components/Cards.vue'
import Paginator from '../components/Paginator.vue';
import router from '../router';
import { RequestHelper } from '../utils/RequestHelper';
import SnackBar from '../components/snackbars/SnackBar.vue';
import TagSelector from '../components/TagSelector.vue';

import { UserManager } from '../utils/UserManager';

export default{
components:{
        Cards,
        Paginator,
        SnackBar,
        TagSelector,
    },
    data(){
        return{
            Questions: [],
            isWaiting: true,
            searchTerm: '',
            currentPage: 1,
            orderBy: 'newest',
            subjectId: null,
            topicId: null,

            links: {}, 
            meta: {},
        }
    },
    methods:{
        async getAllQuestions(){
            this.isWaiting = true;
            this.Questions = [];
            var queires = {
                search: this.searchTerm,
                page: this.currentPage,
                orderBy: this.orderBy,
                subject: this.subjectId,
                topic: this.topicId,
            }
            var responseBody = (await RequestHelper.getAllQuestions(queires)).data;
            this.Questions = responseBody.data;
            this.links = responseBody.links;
            this.meta = responseBody.meta;
            this.isWaiting = false;
        },
        createQuestion(){
            if(!UserManager.isLoggedIn())
            {
                this.$refs.snackBar.showSnackbar('Kérdések létrehozásához, kérlek jelentkezz be!', 'Bejelentkezés', function () {
                    router.push('/login')
                });
            }
            else{
                router.push('/questions/create')
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
            this.currentPage = 1;
            this.refreshPage();         
        },
        handleTopicItemSelected(topicId) {
            this.topicId = topicId;
            this.currentPage = 1;
            this.refreshPage();
        },
        handleOrderBy() {
            this.refreshPage();
        },
        refreshPage(){
            this.getAllQuestions();
            this.$router.push({
                name: 'questions',
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

            this.$refs.tagSelector.reset();

            this.refreshPage();
        }
    },
    async mounted(){
        this.orderBy = this.$route.query.orderBy;
        this.searchTerm = this.$route.query.search;
        this.currentPage = this.$route.query.page;
        this.subjectId = this.$route.query.subject;
        this.topicId = this.$route.query.topic;
        this.getAllQuestions();
    },

    watch: {
        '$route.query.search'(newSearchTerm) {
            this.searchTerm = newSearchTerm;
            this.currentPage = 1;
            this.getAllQuestions();
        }
    }
}
</script>