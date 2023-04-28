<template>
    <div class="container">
        <h2 class="text-center mt-3 mb-2">Kérdés megtekintése</h2>

        <div class="row bg-light shadow rounded-3 p-2">
            <div v-if="isWaiting" id="loading-spinner" class="spinner-border mx-auto" role="status"></div>

            <div v-else class="row">
                <div class="col-11">
                    <user :user="question.creator"></user>   
                    <div class="col">
                        <p v-if="question != null">{{question?.created_at}}</p>
                    </div>
                </div>

                <div class="col-1">
                    <vote :votableId="id" :voteCount="question.recieved_votes"></vote>
                </div>

            <tag-list v-if="question!=null" :subject="question.subject" :topic="question.topic"/>

            <h1>
                {{ question.title }}
            </h1>

            <p>{{question.body}}</p>


        </div>

        <div class="row" v-if="canEditAndDelete">
                <div class="col-sm-6">
                    <button class="btn btn-success" @click="navigate()">
                        Kérdés szerkesztése
                    </button>
                </div>
                <div class="col-sm-6 text-end">
                    <button class="btn btn-danger" @click="deletePost()">
                        Kérdés törlése
                    </button> 
                </div>
            </div>
    </div>

    <comment-section v-if="question!=null" :comments="question.comments" :commentable_id="question.id" :commentable_type="'questions'"/>

</div>
</template>

<script>
import CommentCard  from '../components/CommentCard.vue';
import CommentSection from '../components/CommentSection.vue';
import Vote from '../components/Vote.vue';
import User from '../components/User.vue';
import TagList from '../components/TagList.vue';
import { RequestHelper } from '../utils/RequestHelper';
import router from '../router';

import { UserManager } from '../utils/UserManager.js';

export default{
    data() {
        return {
            question: null,
            isWaiting: true
        };
    },
    components:{
        CommentSection,
        CommentCard,
        Vote,
        User,
        TagList
    },
    props:{
        id: {
            type: Number,
            required: true
        }
        
    },
    methods:{
        navigate(){
            this.$router.push({
                name: 'EditQuestion',
                params: {
                    id: this.question.id,
                }
            })
        },
        async getDetailedQuestion(){
            this.question = (await RequestHelper.getDetailedQuestion(this.id)).data;
            this.isWaiting=false;
        },
        deletePost(){
            if (window.confirm("Biztosan törölni szeretné kérdését?")) {
                RequestHelper.deleteQuestion(this.id)
                .then(()=>{
                    alert("Sikeres törlés!");
                    router.push('/myprofile');
                });
            }
        },
    },
    computed:{
        canEditAndDelete(){
            return (UserManager.isMine(this.question?.creator.id) || UserManager.isAdmin() || UserManager.isModerator());
        },
    },
    mounted(){
        this.getDetailedQuestion();

    },
};
</script>

