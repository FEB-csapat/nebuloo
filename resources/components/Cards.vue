<template>
    <question-card v-for="question in Questions" :question="question"></question-card>
    <content-card v-for="content in Contents" :content="content"></content-card>

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