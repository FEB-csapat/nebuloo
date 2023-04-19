<template>
    <div class="d-flex mb-1 align-items-center">
        <tag v-if="subject != null" :tag="subject"/>
        
        <i v-if="topic != null" style="color:gray;" :class="['fas', 'fa-right-long', 'fa-lg']"/>

        <tag v-if="topic != null" :tag="topic"/>
    </div></template>

<script>
import Tag from './Tag.vue';

export default{
    components:{
        Tag
    },
    props:{

        subject: {
            type: String,
            required: false
        },
        topic: {
            type: String,
            required: false
        },
    },
}
</script>