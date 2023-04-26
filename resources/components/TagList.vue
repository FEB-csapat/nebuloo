<template>
    <div class="d-flex mb-1 align-items-center">
        <tag v-if="subject != null" :subject="subject"/>
        
        <i v-if="topic != null" style="color:gray;" :class="['fas', 'fa-right-long', 'fa-lg']"/>

        <tag v-if="topic != null" :topic="topic"/>
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