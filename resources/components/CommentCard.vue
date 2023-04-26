<template>
    <div class="d-flex justify-content-between bg-light shadow rounded-3 p-2 mt-2 commentcard" id="card">
        
        <div class="align-items-center" style="max-width: 85px; min-width: 72px">
            <user id="text-overflow" :user="comment.creator"></user>
        </div>

        <div class="flex-fill">
            <p style="margin-left: 5px;" v-if="!isEditing">{{comment.message}}</p>
            <textarea id="body" v-model="commentbody" v-if="isEditing" class="form-control" rows="3" cols="10"></textarea>

            <div class="text-end" v-if="isMyComment==true">
                <button class="btn btn-success m-2" @click="editModeOff()" v-if="isEditing"> 
                    Mentés
                </button>
                <button class="btn btn-info mx-1" @click="editModeOn()" v-if="!isEditing">
                    Szerkesztés
                </button>
                <button class="btn btn-danger mx-1" @click="deleteComment()" v-if="!isEditing"> 
                    Törlés
                </button>
            </div>

        </div>
        <div class="" style="width=20px">
            <vote :contentId="comment.id" :voteCount="comment.recieved_votes" :myVote="comment.my_vote"></vote>
        </div>
    </div>
</template>

<script>
import Vote from './Vote.vue';
import { NebulooFetch } from '../utils/https.mjs';
import User from './User.vue';

import { UserManager } from '../utils/UserManager';

export default{
    data(){
        return{
            isEditing:false,
            commentbody:""
        };
    },
    components:{
        Vote,
        User
    },
    props:{
        comment: Object,
    },
    mounted(){
    },
    methods:{
        deleteComment(){
            if (window.confirm("Biztosan törölni szeretné hozzászólását?")) {
                NebulooFetch.deleteMyComment(this.comment.id)
                .then(()=>{
                    alert("Sikeres törlés!");
                    window.location.reload();
                });
            }
        },
        editModeOn(){
            this.isEditing = true;
            this.commentbody = this.comment.message;
        },
        async editModeOff(){
            if (window.confirm("Biztosan szerkeszteni szeretné hozzászólását?")) {
                this.editComment();
                this.isEditing = false;
            }
            else{
                this.isEditing = false;
            }
        },
        async editComment(){
            const data = JSON.stringify(this.commentData);
            var response = (await NebulooFetch.editComment(data,this.comment.id));
            window.location.reload();
        },
    },
    computed:{
        isMyComment(){
            return (UserManager.getUser()?.id == this.comment.creator.id || UserManager.isAdmin());
        },
        commentData(){
            return{
                message:this.commentbody
            }
        }
    }
}
</script>