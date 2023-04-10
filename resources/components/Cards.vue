<template>
    <question-card v-for="question in Questions" :question="question"></question-card>
    <content-card v-for="content in Contents" :content="content"></content-card>
    <ticket-card v-for="ticket in Tickets" :ticket="ticket"></ticket-card>
</template>

<script>
import ContentCard from './ContentCard.vue';
import QuestionCard from './QuestionCard.vue';
import TicketCard from './TicketCard.vue';
export default{
    props:{
        Questions: Array,
        Contents: Array,
        Tickets: Array
    },
    components:{
        ContentCard,
        QuestionCard,
        TicketCard
    }
}
</script>