<template>
    <div class="col mt-3">
        <h2>Kommentek:</h2>

        <div v-if="isLoggedIn" id="comment_writer_container" class="bg-light shadow rounded-3 mt-2 p-2">
            <label for="cim" class="form-label pt-2">Írj kommentet:</label>

            <textarea id="body" v-model="message" class="form-control" rows="3" cols="10" name="commentinput"></textarea>

            <div class="col mt-2">
                <button type="button" class="btn nebuloobutton" @click="AddComment()" name="sendcomment">Küldés</button>
            </div>
        </div>

        <h4 v-else class="text-center p-2">A kommentek írásához, kérlek jelentkezz be!</h4>
        
        <p class="text-center" v-if="comments == null">Betöltés...</p>
        <div v-else-if="comments.length != 0" id="comment_cards_container">
            <CommentCard v-for="comment in comments" :key="comment.id" :comment="comment" />
        </div>

        <p class="text-center mt-2" v-else>Nincs még komment</p>
    </div>
</template>

<script>

import CommentCard from './CommentCard.vue';
import { RequestHelper } from '../utils/RequestHelper';

import { UserManager } from '../utils/UserManager';
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
        async AddComment(){
            var trimmedMessage = this.message.trim();
            if(trimmedMessage.length == ""){
                return;
            }
            if(trimmedMessage.length>300){
                window.alert("Túl hosszú a hozzászólása!");
            }
            else{
                RequestHelper.createComment(trimmedMessage, this.commentable_type, this.commentable_id)
                .then(()=>{
                    this.$emit('commentAdded');
                    this.message = "";
                });
            }
        },
    },
    computed:{
        isLoggedIn(){
            return UserManager.isLoggedIn();
        }
    }
};
</script>