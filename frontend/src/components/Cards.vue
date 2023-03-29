<template>

      
        <question-card v-for="question in Questions" :id="question.id" :creator_user_id="question.creator_user_id" :title="question.title" :body="question.body"></question-card>
        <content-card v-for="content in Contents" :id="content.id" :creator_user_id="content.creator_user_id" :body="content.body"></content-card>

</template>

<script>
import ContentCard from './ContentCard.vue';
import QuestionCard from './QuestionCard.vue';
export default{
    props:{
        Questions: Array,
        Contents: Array
    },
    components:{
        ContentCard,
        QuestionCard
    }
}
</script>