<template>
    <div class="col mt-3">
        <h2>Kommentek:</h2>

        <h1>TODO: implement comment writing feature</h1>
        
            <p v-if="comments == null">Betöltés...</p>
            <CommentCard v-else-if="comments.length != 0" v-for="comment in comments" :key="comment.id" :comment="comment" />
            <p class="text-center" v-else>Nincs még komment</p>
        

        <div class="bg-light shadow rounded-3 mt-2 p-2">
            <label for="cim" class="form-label pt-2">Írj kommentet:</label>

            <textarea id="body" v-model="message" class="form-control" rows="2" cols="10"></textarea>

            <div class="col mt-2">
                <button type="button" class="btn" id="button" @click="AddComment()" >Küldés</button>
            </div>
        </div>
    </div>
</template>

<script>

import CommentCard from './CommentCard.vue';
import { NebulooFetch } from '../utils/https.mjs';
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
            message:""
        };
    },
    methods:{
        AddComment(){
            const data = JSON.stringify(this.comment);
                NebulooFetch.createComment(data,this.$route.path);
        },
    },
    computed:{
            comment(){
                return{
                    message:this.message
                }
            }
        },
    mounted(){
    NebulooFetch.initialize();
    },
};
</script>