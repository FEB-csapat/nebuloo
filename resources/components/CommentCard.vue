<template>
    <div class="d-flex justify-content-between bg-light shadow rounded-3 p-2 mt-2 commentcard" id="card">
        
        <div class="align-items-center text-overflow text-center" style="max-width: 85px; min-width: 72px">
            <user :user="comment.creator"/>
        </div>

        <div class="flex-fill">
            <p style="margin-left: 5px;" v-if="!isEditing" name="commentbody">{{comment.message}} </p>
            <textarea id="body" v-model="commentbody" v-if="isEditing" class="form-control" rows="3" cols="10" name="editcommentbody"></textarea>

            <div class="text-end" v-if="canEditAndDelete">
                <button class="btn btn-success  m-2" @click="editModeOff()" v-if="isEditing" name="savecomment"> 
                    Mentés
                </button>
                <button class="btn btn-outline-info btn-sm mx-1" @click="editModeOn()" v-if="!isEditing" name="editcomment">
                    Szerkesztés
                </button>
                <button class="btn btn-outline-danger btn-sm mx-1" @click="deleteComment()" v-if="!isEditing" name="deletecomment"> 
                    Törlés
                </button>
            </div>

        </div>
        <div class="" style="width=20px">
            <vote :votableId="comment.id" :voteCount="comment.recieved_votes" :myVote="comment.my_vote"></vote>
        </div>
    </div>
</template>

<script>
import Vote from './Vote.vue';
import { RequestHelper } from '../utils/RequestHelper';
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
                RequestHelper.deleteMyComment(this.comment.id)
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
            
            this.comment.message = this.commentbody;
            var response = (await RequestHelper.editComment(data,this.comment.id));
        },
    },
    computed:{
        canEditAndDelete(){
            return (UserManager.isMine(this.comment?.creator.id) || UserManager.isAdmin() || UserManager.isModerator());
        },
        commentData(){
            return{
                message:this.commentbody
            }
        }
    }
}
</script>