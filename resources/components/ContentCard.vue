<template>
    <div class="row bg-light rounded-4 mb-3 p-3" id="card">
        <div class="nav-link active col-xs-8 col-md-10" aria-current="page"
            @click="navigate">
            <div>
                <tag-list :subject="content.subject" :topic="content.topic"/>
                
                <div class="card_content_view_textarea">
                    <textarea ref="editor" name="leiras" id="leiras" class="form-control">{{content.body}}</textarea>
                </div>
            </div>
        </div>

        <div class="col-xs-4 col-md-2  text-center p-2">
            <p >{{content.created_at}}</p>
            <user v-if="content.creator" :user="content.creator"></user>

            <vote :contentId="content.id" :voteCount="content.recieved_votes" :myVote="content.my_vote"></vote>
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
    props:{
        content: {
            type: Object,
            required: true
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
    },
}
</script>


<style>


</style>