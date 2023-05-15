<template>
    <div class="d-flex mb-1 align-items-center">

        <router-link aria-current="page" :to="{ path: '/contents', query: { subject: subject.id } }">
            <tag v-if="subject != null" :subject="subject"/>
        </router-link>

        <i v-if="topic != null" :class="['fas', 'fa-right-long', 'fa-lg']"/>

        
        <router-link aria-current="page" :to="{ path: '/contents', query: { subject: subject.id, topic: topic.id } }">
            <tag v-if="topic != null" :topic="topic"/>
        </router-link>
    </div>
</template>

<script>
import Tag from './Tag.vue';

export default{
    components:{
        Tag
    },
    props:{

        subject: {
            type: Object,
            required: false
        },
        topic: {
            type: Object,
            required: false
        },
    },
}
</script>