<template>
    <div class="d-flex bg-light shadow rounded-3 p-2 mt-2">
        <div class="col-sm-2 col-xs-2">
            <user :user="comment.creator"></user> 
        </div>
        <div class="flex-fill col-sm-9 col-xs-9">
            <p>{{comment.message}}</p>
        </div>
        <div class="col-sm-1 col-xs-1">
            <vote :contentId="10" :voteCount="10" :vote="null"></vote>
        </div>

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