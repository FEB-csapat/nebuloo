
<template>
    <div class="col bg-light rounded-4 mb-4" id="card">
        <div class="d-flex justify-content-between me-2 ps-3 pt-3 pe-1"
            @click="navigateToDetailedView">
            <tag-list :subject="question.subject" :topic="question.topic"/>
            <p class="text-end">{{question.created_at}}</p>
        </div>

        <div class="d-flex ps-3 pe-1">
            <div class="flex-fill justify-content-between flex-column" aria-current="page" name="questioncard"
                @click="navigateToDetailedView">
                <div>
                    <h2>
                        {{ question.title }}
                    </h2>
                    <p>
                        {{ question.body }}
                    </p>
                </div>
                <p>Kommentek: {{question.comments_count}}</p>
            </div>
    
            <div class="text-center align-items-center pb-2" style="max-width: 85px; min-width: 72px">
                <user v-if="question.creator" :user="question.creator"></user> 
    
                <vote :votableId="question.id" :voteCount="question.recieved_votes" :votableType="'questions'" :myVote="question.my_vote"></vote>
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
        navigateToDetailedView(){
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