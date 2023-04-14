
<template>
    <div class="row bg-light rounded-4 mb-3 p-3" id="card">
        <div class="nav-link active col-sm-10" aria-current="page"
            @click="navigate">
            <div>
                <tag v-for="tag in question.tags" :tag="tag"></tag>
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

        <div class="col-sm-2 text-center">
            <p>{{question.created_at}}</p>
            <user v-if="question.creator" :user="question.creator"></user>

            <vote :contentId="question.id" :voteCount="question.recieved_votes" :myVote="question.my_vote"></vote>
        </div>
    </div>
    
</template>

<script>
import Tag from './Tag.vue';
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
        Tag,
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
                    question:  this.question
                },
                props: {
                    question: this.question
                }
            })
        },
    },
    mounted(){
    }
}
</script>