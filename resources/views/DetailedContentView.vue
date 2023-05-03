<template>
<div class="container">
    <h2 class="text-center mt-3 mb-2">Tananyag megtekintése</h2>
    <div class="row bg-light shadow rounded-3 pt-2 pb-2" id="contentid">

        <loading-spinner v-if="isWaiting"/>

        <div v-if="!isWaiting">
            <div class="row">
                <div class="col text-center ">
                    <div class="d-flex justify-content-between">
                        <div>
                            <user :user="content.creator"/>
                        </div>
                        <vote :votableId="id" :voteCount="content.recieved_votes" :votableType="'contents'" :myVote="content.my_vote" />
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-end">
                <tag-list :subject="content.subject" :topic="content.topic" name="detailedcontenttags"/>
                <p class="text-end">{{content.created_at}}</p>
            </div>
        </div>
        
        <div class="detailed_content_view_textarea">
            <textarea ref="editor" name="leiras" id="leiras" class="form-control">Betöltés...</textarea>
        </div>

        <div v-if="!isWaiting" class="d-flex flex-row">
            <div class="col-sm-4">
                <button class="btn m-1 nebuloobutton" @click="downloadContent()" name="contentdownload">
                    Letöltés
                </button>
            </div>
            <div class="col-sm-4 text-center" v-if="canEditAndDelete">
                <button class=" btn btn-success m-1" name="contentupdate" @click="navigateToEditView()">
                    Szerkesztés
                </button>
            </div>
            <div class="col-sm-4 text-end" v-if="canEditAndDelete">
                <button class="btn btn-danger m-1" name="contentdelete" @click="deletePost()">
                    Törlés
                </button> 
            </div>
        </div>
    </div>
    <comment-section v-if="content!=null" @commentAdded="commentAdded" :comments="content.comments" :commentable_id="content.id" :commentable_type="'contents'"></comment-section>
    <SnackBar ref="snackBar"/>
</div>
</template>

<script>
import { RequestHelper } from '../utils/RequestHelper';

import EasyMDE from 'easymde';
import CommentCard  from '../components/CommentCard.vue';
import Vote from '../components/Vote.vue';
import User from '../components/User.vue';
import TagList from '../components/TagList.vue';

import CommentSection from '../components/CommentSection.vue';
import html2pdf from 'html2pdf.js';
import SnackBar from '../components/snackbars/SnackBar.vue';

import LoadingSpinner from '../components/LoadingSpinner.vue';


import { UserManager } from '../utils/UserManager.js';

export default{
    props:
    {
        id: {
            type: Number,
            required: true
        },
        commentId: {
            type: Number,
        } 
    },
    components:{
        CommentSection,
        CommentCard,
        Vote,
        User,
        TagList,
        SnackBar,
        LoadingSpinner
    },
    data() {
        return {
            content: null,
            isWaiting: true
        };
    },
    methods:{
        async getDetailedContent(){
            this.content = (await RequestHelper.getDetailedContent(this.id)).data;
            this.editor.value(this.content.body);
            this.isWaiting = false;
        },
        async deletePost(){
            if (window.confirm("Biztosan törölni szeretnéd a tananyagot?")) {
                RequestHelper.deleteContent(this.id)
                .then(()=>{
                    alert("Sikeres törlés!");
                    this.$router.push({
                        name: 'userProfile',
                        params: {
                            id: this.content.creator.id   
                        },
                    });
                });
            }
        },
        navigateToEditView(){
            this.$router.push({
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
        this.getDetailedContent().then(()=>{
            if(this.commentId){
                const element = document.getElementById('comment-'+this.commentId);
                element?.scrollIntoView({ behavior: 'smooth' });
            }
        });

        this.editor = new EasyMDE({
            element: this.$refs.editor,
            readOnly: true,
            toolbar: false,
            spellChecker: false,
            
        });

        this.editor.togglePreview();
    },
    
    computed:{
        canEditAndDelete(){
            return (UserManager.isMine(this.content?.creator.id) || UserManager.isAdmin() || UserManager.isModerator());
        },
        isLoggedIn(){
            return UserManager.isLoggedIn();
        }
    },
};
</script>