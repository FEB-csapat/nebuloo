<template>
    <div class="container">
        <h2 class="text-center mt-3 mb-2">Tananyag megtekintése</h2>
        <div class="row bg-light shadow rounded-3 pt-2 pb-2" id="contentid">
            <div v-if="isWaiting" id="loading-spinner" class="spinner-border mx-auto" role="status"></div>

            <div class="row">
                <div class="col text-center ">
                    <div class="d-flex justify-content-between">
                    <div class="">
                        <user v-if="content!=null" :user="content.creator"></user>  

                        <div v-if="content!=null" class="">
                            <p v-if="content != null">{{contentCreationDate}}</p>
                            <p v-if="content != null">{{contentCreationTime}}</p>
                        </div>
                    </div>
                        <vote v-if="content!=null" :contentId="id" :voteCount="content.recieved_votes" :myVote="content.my_vote"></vote>
                    </div>
                </div>
            </div>

            <tag-list v-if="content!=null" :subject="content.subject" :topic="content.topic"/>

            <div class="detailed_content_view_textarea">
                <textarea ref="editor" name="leiras" id="leiras" class="form-control">Betöltés...</textarea>
            </div>

            <div class="d-flex flex-row">
                <div class="col-sm-4">
                    <button class="btn" id="button" @click="downloadContent()">
                        Letöltés
                    </button>
                </div>
                <div class="col-sm-4 text-center" v-if="isMyContent">
                    <button class=" btn btn-success" @click="goToEdit()">
                        Szerkesztés
                    </button>
                </div>
                <div class="col-sm-4 text-end" v-if="isMyContent">
                    <button class="btn btn-danger" @click="deletePost()">
                        Tananyag törlése
                    </button> 
                </div>

            </div>
        </div>
        <comment-section v-if="content!=null" @commentAdded="commentAdded" :comments="content.comments" :commentable_id="content.id" :commentable_type="contents"></comment-section>
        <SnackBar ref="snackBar"/>
    </div>
</template>

<script>
import { NebulooFetch } from '../utils/https.mjs';

import EasyMDE from 'easymde';
import CommentCard  from '../components/CommentCard.vue';
import Vote from '../components/Vote.vue';
import User from '../components/User.vue';
import TagList from '../components/TagList.vue';

import CommentSection from '../components/CommentSection.vue';
import router from '../router';
import html2pdf from 'html2pdf.js';
import SnackBar from '../components/snackbars/SnackBar.vue';


import { UserManager } from '../utils/UserManager.js';

export default{
    props:
    {
        id: {
            type: Number,
            required: true
        } 
    },
    components:{
        CommentSection,
        CommentCard,
        Vote,
        User,
        TagList,
        SnackBar,

    },
    data() {
        return {
            content: null,
            creator: Object,
            isWaiting: true
        };
    },
    methods:{
        async getDetailedContent(){
            var responseBody = (await NebulooFetch.getDetailedContent(this.id)).data;
            this.content = responseBody;
            this.creator = this.content.creator;
            this.editor.value(this.content.body);
            this.isWaiting = false;
        },
        async deletePost(){
            if (window.confirm("Biztosan törölni szeretné posztját?")) {
        
                NebulooFetch.deleteMyPost(this.$route.path)
                .then(()=>{
                    alert("Sikeres törlés!");
                    router.push('/myprofile');
                });
            }
        },
        goToEdit(){
            router.push({
                name: 'editContent',
                params:{id: this.id}
            })
        },
        downloadContent(){
            html2pdf(document.getElementById('contentid'), {image : {type: 'jpeg', quality: 1}, filename: 'Tananyag.pdf'});
        },

        commentAdded(){
            this.$refs.snackBar.showSnackbar('Sikeres komment hozzáadás!');
            this.getDetailedContent();
        }
    },
    
    async mounted(){
        this.getDetailedContent();

        this.editor = new EasyMDE({
            element: this.$refs.editor,
            readOnly: true,
            toolbar: false,
            spellChecker: false,
            
        });

        this.editor.togglePreview();
    },
    
    computed:{
        isMyContent(){
            return (UserManager.isMine(this.creator.id) || UserManager.isAdmin());
        },
        contentCreationDate: function(){
            return this.content.created_at.split(' ')[0];
        },
        contentCreationTime: function(){
            return this.content.created_at.split(' ')[1];
        },
        isLoggedIn(){
            return UserManager.isLoggedIn();
        }
    },
};
</script>

<style>
.easymde-container.CodeMirror {
    border: none;
    overflow: hidden;
}
.easymde-preview img {
    max-width: 100%;
    height: auto;
}
</style>
