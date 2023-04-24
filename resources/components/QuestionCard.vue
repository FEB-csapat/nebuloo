
<template>
    <div class="row bg-light rounded-4 mb-4 ps-3 pb-3 pt-3 pe-1" id="card">
        <div class="nav-link active col-sm-10 col-lg-11" aria-current="page"
            @click="navigate">
            <div>
                <tag-list :subject="question.subject" :topic="question.topic"/>
                <div>
                    <h1>
                        {{ question.title }}
                    </h1>
                    <p>
                        {{ question.body }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-2 col-lg-1 text-center align-items-center">
            <p>{{question.created_at}}</p>
            <user v-if="question.creator" :user="question.creator"></user> 

            <vote :contentId="question.id" :voteCount="question.recieved_votes" :myVote="question.my_vote"></vote>
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