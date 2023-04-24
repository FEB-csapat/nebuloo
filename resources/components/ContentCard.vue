<template>
    <div class="col bg-light rounded-4 mb-4 ps-3 pb-3 pt-3 pe-1" id="card">
        <div class="d-flex justify-content-between me-2">
            <tag-list :subject="content.subject" :topic="content.topic"/>
            <p class="text-end">{{content.created_at}}</p>
        </div>

        <div class="d-flex">
            <div class="nav-link active" aria-current="page"
                @click="navigate">
                <div>
                    <div class="card_content_view_textarea">
                        <textarea ref="editor" name="leiras" id="leiras" class="form-control">{{content.body}}</textarea>
                    </div>
                </div>
            </div>
    
            <div class="text-center align-items-center" style="max-width: 85px; min-width: 72px">
                <user v-if="content.creator" :user="content.creator"></user>
    
                <vote :contentId="content.id" :voteCount="content.recieved_votes" :myVote="content.my_vote"></vote>
            </div>
        </div>
    </div>

    
</template>

<script>
import EasyMDE from 'easymde';

import TagList from './TagList.vue';
import Vote from './Vote.vue';
import User from './User.vue';
import DetailedContentView from '../views/DetailedContentView.vue';

export default{
    data(){
        return{
            splittedDate:[]
        }
    },
    props:{
        content: {
            type: Object,
            required: true,
        },
    },
    components:{
        TagList,
        Vote,
        User,
        DetailedContentView
    },
    methods:{
        navigate(){
            this.$router.push({
                name: 'contentById',
                params: {
                    id: this.content.id,
                    content:  this.content
                },
                props: {
                    content: this.content
                }
            })
        },
        splitDate(){
            this.splittedDate = this.content.created_at.split(" ");
            console.log(this.splittedDate);
        }
    },

    mounted(){
        this.editor = new EasyMDE({
            element: this.$refs.editor,
            readOnly: true,
            toolbar: false,
            spellChecker: false,
        });

        this.editor.togglePreview();
        this.splitDate();
    }
}
</script>


<style>


</style>