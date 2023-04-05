<template>
    <div class="col">
        
        <h2>Kommentek:</h2>

        <div class="row bg-light shadow rounded-3 p-2">
            <label for="cim" class="form-label pt-2">Írj kommentet:</label>
            <input type="text" id="cim" v-model="title" class="form-control">

            <div class="col">
                <button type="button" class="btn btn-primary">Küldés</button>
            </div>
        </div>

        <div class="col">
            <CommentCard v-for="comment in comments" :key="comment.id" :comment="comment" />
        </div>
        
    </div>
    
</template>

<script>

import CommentCard from './CommentCard.vue';

export default{
    props:{
        commentable_id: {
            type: Number,
            required: true
        },
        commentable_type: {
            type: String,
            required: true
        },
    },
    components:{
        CommentCard
    },
    data() {
        return {
        comments: [
            { id: 1, body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' },
            { id: 2, body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' },
            { id: 3, body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' },
        ],
        };
    },
    mounted(){
    },
};
</script>