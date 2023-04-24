<template>
    <div class="d-flex justify-content-center bg-light shadow rounded-3 p-2 mt-2 commentcard">
        <div class="mx-1">
            <user class="text-center" :user="comment.creator"></user> 
        </div>
        <div class="mx-1">
            <p style="margin-left: 5px;" v-if="!isEditing">{{comment.message}}</p>
            <textarea id="body" v-model="commentbody" v-if="isEditing" class="form-control" rows="3" cols="10"></textarea>

            <div class="text-end" v-if="MyComment==true">
                <button class="btn btn-success m-2" @click="editModeOff()" v-if="isEditing"> 
                    Szerkeszt
                </button>
                <button class="btn btn-info mx-1" @click="editModeOn()" v-if="!isEditing">
                    Szerkesztés
                </button>
                <button class="btn btn-danger mx-1" @click="deleteComment()" v-if="!isEditing"> 
                    Törlés
                </button>
            </div>

        </div>
        <div class="mx-1">
            <vote :contentId="comment.id" :voteCount="comment.recieved_votes" :myVote="comment.my_vote"></vote>
        </div>
    </div>
</template>

<script>
import Vote from './Vote.vue';
import { NebulooFetch } from '../utils/https.mjs';
import User from './User.vue';

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
        MyComment(){
            const identifier = sessionStorage.getItem('Identifier');
            return identifier == this.comment.creator.id;
            },
            commentData(){
            return{
                message:this.commentbody
            }
        }
    }
}
</script>