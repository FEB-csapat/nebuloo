<template>
    <div class="container my-3 ">
        <h1 id="title">Tananyag megtekintése</h1>
        <div class="row bg-light shadow rounded-3 p-2">
            <div class="row">
                <div class="col-sm-11">

                    <user :user="content.creator"></user>   

                    <div class="col">
                        <p v-if="content != null">{{content?.created_at}}</p>
                    </div>
                </div>

                <div class="col-sm-1">
                    <vote :contentId="id" :voteCount="content.recieved_votes" :vote="null"></vote>
                </div>
            </div>
            
            <textarea ref="editor" name="leiras" id="leiras" class="form-control">Betöltés...</textarea>

            <button class="btn" id="button">
                Letöltés
            </button>
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

import CommentSection from '../components/CommentSection.vue';

export default{
    props:
    {
        id: {
            type: Number,
            required: true
        },
        content: {
            type: Object,
            required: true
        } 
    },
    components:{
        CommentSection,
        CommentCard,
        Vote,
        User
    },
    data() {
        return {
            content: {},
        };
    },
    methods:{
        async getDetailedContent(){
            this.isWaiting = true;

            var responseBody = (await NebulooFetch.getDetailedContent(this.id)).data;
            this.content = responseBody;

            this.editor.value(this.content.body);
            
            this.isWaiting = false;
        },
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
