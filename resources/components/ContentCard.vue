<template>
        <div class="row bg-light rounded-4 mb-3 shadow p-2">
            <div class="nav-link active col-sm-11" aria-current="page"
             @click="navigate">
                <div>
                    <tag v-for="tag in content.tags" :tag="tag"></tag>
                    

                    <div class="content-body">
                        <textarea ref="editor" name="leiras" id="leiras" class="form-control">{{content.body}}</textarea>
                    </div>

                    <!--
                    <p>
                        {{content.body}}
                    </p> 
                    -->
                </div>
            </div>

            <div class="col-sm-1">
                <user v-if="content.creator" :user="content.creator"></user>

                <vote :contentId="content.id" :voteCount="content.recieved_votes" :vote="null"></vote>

            </div>
        </div>
</template>

<script>
import EasyMDE from 'easymde';

import Tag from './Tag.vue';
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
        Tag,
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
            })
        }
    },
    mounted(){
        this.editor = new EasyMDE({
            element: this.$refs.editor,
            readOnly: true,
            toolbar: false,
            spellChecker: false,

            maxHeight: "160px",
            

            autoResize: true,
            scrollLock: true
        });

        this.editor.togglePreview();
    },
}
</script>


<style>
.content-body {
    overflow: hidden;

}


/* Change the background color of the editor */
.CodeMirror {
    background-color: #f5f5f5;
  }
  
  /* Change the color of the toolbar icons */
  .editor-toolbar .fa {
    color: #333;
  }

</style>