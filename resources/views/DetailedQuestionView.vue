<template>
    <div class="container my-3 ">
        <h1 id="title">Kérdés megtekintése</h1>
        <div class="row bg-light shadow rounded-3 p-2">
            <div class="row">
                <div class="col-11">

                    <user :user="question.creator"></user>   

                    <div class="col">
                        <p v-if="question != null">{{question?.created_at}}</p>
                    </div>
                </div>

                <div class="col-1">
                    <vote :contentId="id" :voteCount="question.recieved_votes" :vote="null"></vote>
                </div>
            <h1>
                {{ question.title }}
            </h1>

            <p>{{question.body}}</p>


        </div>

        <div class="row" v-if="MyPost==true">
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

    <comment-section :comments="question.comments" :commentable_id="question.id" :commentable_type="questions"/>

</div>
</template>

<script>
import CommentCard  from '../components/CommentCard.vue';
import CommentSection from '../components/CommentSection.vue';
import Vote from '../components/Vote.vue';
import User from '../components/User.vue';
import { NebulooFetch } from '../utils/https.mjs';
import router from '../router';

export default{
    data() {
        return {
            question: {},
            creator: Object
        };
    },
    components:{
        CommentSection,
        CommentCard,
        Vote,
        User
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
            var responseBody = (await NebulooFetch.getDetailedQuestion(this.id)).data;
            this.question = responseBody;
            console.log(this.question);
            this.creator = this.question.creator;
        },
        DeletePost(){
            if (window.confirm("Biztosan törölni szeretné kérdését?")) {
                NebulooFetch.deleteMyPost(this.$route.path)
                .then(()=>{
                    alert("Sikeres törlés!");
                    router.push('/myprofile');
                });
            }
        },
    },
    computed:{
        MyPost(){
            const identifier = sessionStorage.getItem('Identifier');
            return identifier == this.creator.id;
            },
    },
    mounted(){
        this.getDetailedQuestion();
    },
};
</script>

