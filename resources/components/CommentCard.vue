<template>
    <div class="d-flex bg-light shadow rounded-3 p-2 mt-2">
        <div>
            <user :user="comment.creator"></user> 
        </div>
        <div class="flex-fill">
            <p>{{comment.message}}</p>
        </div>

        <vote :contentId="10" :voteCount="10" :vote="null"></vote>

    </div>
</template>

<script>
import Vote from './Vote.vue';

import User from './User.vue';

export default{
    components:{
        Vote,
        User
    },
    props:{
        comment: Object,
    },
    mounted(){
    }
}
</script>