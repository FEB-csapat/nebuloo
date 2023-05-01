<template>
<div class="container">
    <h2 class="text-center mt-3 mb-2">Kérdés megtekintése</h2>

    <div class="row bg-light shadow rounded-3 p-2">
        
        <loading-spinner v-if="isWaiting"/>

        <div v-else>
            <div class="row">
                <div class="col text-center ">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <user :user="question.creator"></user>  
                        </div>
                        <vote :votableId="id" :voteCount="question.recieved_votes" :myVote="question.my_vote"></vote>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-end">
                <tag-list :subject="question.subject" :topic="question.topic" name="detailedquestiontags"/>
                <p class="text-end">{{question.created_at}}</p>
            </div>
            
            <div>
                <h1>{{ question.title }}</h1>
                <p>{{question.body}}</p>
            </div>
            
            <div class="row" v-if="canEditAndDelete">
                <div class="col-sm-6">
                    <button class="btn btn-success" name="questionupdate" @click="navigateToEditView()">
                        Kérdés szerkesztése
                    </button>
                </div>
                <div class="col-sm-6 text-end">
                    <button class="btn btn-danger" name="questiondelete" @click="deletePost()">
                        Kérdés törlése
                    </button> 
                </div>
            </div>
        </div>
    </div>

    <comment-section v-if="question!=null" @commentAdded="commentAdded" :comments="question.comments" :commentable_id="question.id" :commentable_type="'questions'"/>
    <SnackBar ref="snackBar"/>
</div>
</template>

<script>
import CommentCard  from '../components/CommentCard.vue';
import CommentSection from '../components/CommentSection.vue';
import Vote from '../components/Vote.vue';
import User from '../components/User.vue';
import TagList from '../components/TagList.vue';
import { RequestHelper } from '../utils/RequestHelper';
import SnackBar from '../components/snackbars/SnackBar.vue';
import { UserManager } from '../utils/UserManager.js';

import LoadingSpinner from '../components/LoadingSpinner.vue';

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
        TagList,
        SnackBar,
        LoadingSpinner
    },
    props:{
        id: {
            type: Number,
            required: true
        }
    },
    methods:{
        navigateToEditView(){
            this.$router.push({
                name: 'editQuestion',
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
                    this.$router.push({
                        name: 'myUserProfile'
                    });
                });
            }
        },
        commentAdded(){
            this.$refs.snackBar.showSnackbar('Sikeres komment hozzáadás!');
            this.getDetailedQuestion();
        }
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

