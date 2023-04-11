<template>
    <div class="col">
        <h2>Kommentek:</h2>

        <h1>TODO: implement comment writing feature</h1>

        <div class="row bg-light shadow rounded-3 p-2">
            <label for="cim" class="form-label pt-2">Írj kommentet:</label>
            <input type="text" id="cim" v-model="title" class="form-control">

            <div class="col">
                <button type="button" class="btn btn-primary">Küldés</button>
            </div>
        </div>

        <div class="col">
            <p v-if="comments == null">Betöltés...</p>
            <CommentCard v-else-if="comments.length != 0" v-for="comment in comments" :key="comment.id" :comment="comment" />
            <p v-else>Nincs még komment</p>
        </div>
    </div>
</template>

<script>

import CommentCard from './CommentCard.vue';

export default{
    props:{
        comments: {
            type: Array,
            required: true
        },
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
            
        };
    },
    mounted(){
        
    },
};
</script>