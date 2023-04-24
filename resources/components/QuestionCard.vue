
<template>
    <div class="col bg-light rounded-4 mb-4 ps-3 pb-3 pt-3 pe-1" id="card">
        <div class="d-flex justify-content-between me-2">
            <tag-list :subject="question.subject" :topic="question.topic"/>
            <p class="text-end">{{question.created_at}}</p>
        </div>

        <div class="d-flex">
            <div class="nav-link active col-sm-10 col-lg-11" aria-current="page"
                @click="navigate">
                <div>
                    <h2>
                        {{ question.title }}
                    </h2>
                    <p>
                        {{ question.body }}
                    </p>
                </div>
            </div>
    
            <div class="text-center align-items-center" style="max-width: 85px; min-width: 72px">
                <user v-if="question.creator" :user="question.creator"></user> 
    
                <vote :contentId="question.id" :voteCount="question.recieved_votes" :myVote="question.my_vote"></vote>
            </div>
        </div>

    </div>   
</template>

<script>
import TagList from './TagList.vue';
import Vote from './Vote.vue';
import User from './User.vue';
import DetailedQuestionView from '../views/DetailedQuestionView.vue';
export default{
    props:{
        question: {
            type: Object,
            required: true
        },
    },
    components:{
        TagList,
        Vote,
        User,
        DetailedQuestionView
    },
    methods:{
        navigate(){
            this.$router.push({
                name: 'questionById',
                params: {
                    id: this.question.id,
                }
            })
        },
    },
    mounted(){
    }
}
</script>