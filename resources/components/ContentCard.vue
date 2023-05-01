<template>
    <div class="col bg-light rounded-4 mb-4 " id="card">
        <div class="d-flex justify-content-between me-2 ps-3 pt-3 pe-1" @click="navigateToDetailedView">
            <tag-list :subject="content.subject" :topic="content.topic"/>
            <p class="text-end">{{content.created_at}}</p>
        </div>

        <div class="d-flex ps-3 pe-1">
            <div class="flex-fill justify-content-between flex-column" aria-current="page" @click="navigateToDetailedView" name="contentcard">
                <div>
                    <div class="card_content_view_textarea">
                        <textarea ref="editor" name="leiras" id="leiras" class="form-control">{{content.body}}</textarea>
                    </div>
                    <div>
                        <p>Kommentek: {{content.comments_count}}</p>
                    </div>
                </div>
            </div>
    
            <div class="text-center align-items-center pb-2" style="max-width: 85px; min-width: 72px">
                <user v-if="content.creator" :user="content.creator"/>
    
                <vote :votableId="content.id" :voteCount="content.recieved_votes" :votableType="'contents'" :myVote="content.my_vote"/>
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
            splittedDate:[],
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
        navigateToDetailedView(){
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