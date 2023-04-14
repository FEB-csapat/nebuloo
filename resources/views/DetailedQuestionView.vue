<template>
    <div class="container my-3 ">
        <h1 id="title">Kérdés megtekintése</h1>
        <div class="row bg-light shadow rounded-3 p-2">
            <h1>
                {{ question.title }}
            </h1>

            <p>{{question.body}}</p>

        </div>
        <CommentSection :commentable_id="question.id" :commentable_type="'questions'"/>


    </div>
    
</template>

<script>
import CommentCard  from '../components/CommentCard.vue';
import CommentSection from '../components/CommentSection.vue';
import Vote from '../components/Vote.vue';
import User from '../components/User.vue';
import { NebulooFetch } from '../utils/https.mjs';
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
        },
        question: {
            type: Object,
            required: true
        }
        
    },
    methods:{
        async getDetailedQuestion(){
            var responseBody = (await NebulooFetch.getDetailedQuestion(this.id)).data;
            this.question = responseBody;
            console.log(this.question);
            this.creator = this.question.creator;
        },
        DeletePost(){
            if (window.confirm("Biztosan törölni szeretné posztját?")) {
        
                NebulooFetch.DeleteMyPost(this.$route.path);
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

