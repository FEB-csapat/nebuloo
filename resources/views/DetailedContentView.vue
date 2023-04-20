<template>
    <div class="container my-3 ">
        <h1 class="text-center mb-4">Tananyag megtekintése</h1>
        <div class="row bg-light shadow rounded-3 p-2" id="contentid">
            <div class="row">
                <div class="col-11">

                    <user v-if="user!=null" :user="content.creator"></user>   

                    <div class="col">
                        <p v-if="content != null">{{content?.created_at}}</p>
                    </div>
                </div>

                <div class="col-1">
                    <vote :contentId="id" :voteCount="content.recieved_votes" :vote="null"></vote>
                </div>
            </div>

            <tag-list :subject="content.subject" :topic="content.topic"/>
                
            
            <div class="detailed_content_view_textarea">
                <textarea ref="editor" name="leiras" id="leiras" class="form-control">Betöltés...</textarea>
            </div>

            <div class="d-flex flex-row">
                <div class="col-sm-4">
                    <button class="btn" id="button" @click="downloadContent()">
                        Letöltés
                    </button>
                </div>
                <div class="col-sm-4 text-center" v-if="MyPost">
                    <button class=" btn btn-success" @click="goToEdit()">
                        Szerkesztés
                    </button>
                </div>
                <div class="col-sm-4 text-end" v-if="MyPost">
                    <button class="btn btn-danger" @click="deletePost()">
                        Tananyag törlése
                    </button> 
                </div>

            </div>
        </div>
            <comment-section :comments="content.comments" :commentable_id="content.id" :commentable_type="contents"></comment-section>
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
        TagList
    },
    data() {
        return {
            content: {},
            creator: Object
        };
    },
    methods:{
        async getDetailedContent(){
            this.isWaiting = true;
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
        MyPost(){
            const identifier = sessionStorage.getItem('Identifier');
            return identifier == this.creator.id;
            },
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
