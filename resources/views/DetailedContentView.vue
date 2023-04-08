<!-- TODO: fix content property not being passed to this component from the ContentCard's router-link --->

<template>
    <div class="container my-3 ">
        <h1 id="title">Tananyag megtekintése</h1>
        <div class="row bg-light shadow rounded-3 p-2">
            <div class="row">
                <div class="col-sm-11">

                <!-- <user :user="content.creator"></user> -->    

                    <img style="width:100px; height:70px" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimg.favpng.com%2F25%2F7%2F23%2Fcomputer-icons-user-profile-avatar-image-png-favpng-LFqDyLRhe3PBXM0sx2LufsGFU.jpg&f=1&nofb=1&ipt=c5a94872939138fcc06ee18319a0597d58d783928d3c834f2bd4dcad8c94662a&ipo=images" alt="avatar">
                    <div class="col">
                    <!-- <h4>Név: {{content.creator.name}}</h4> -->  
                      <!--  <p>date: {{content.created_at}}</p> --> 
                    </div>
                </div>

                <div class="col-sm-1">
    
                    <vote :contentId="3" :voteCount="10" :vote="null"></vote>
    
                </div>
            </div>
            
            <textarea ref="editor" name="leiras" id="leiras" class="form-control">content.body</textarea>

            <button class="btn" id="button">
                Letöltés
            </button>
        </div>

        <h2>Kommentek:</h2>
        <div class="col">
            <CommentCard v-for="comment in comments" :key="comment.id" :comment="comment" />
        </div>
        
    </div>
    
</template>

<script>
import EasyMDE from 'easymde';
import CommentCard  from '../components/CommentCard.vue';
import Vote from '../components/Vote.vue';

import User from '../components/User.vue';

export default{
    props: //['content'],
    {
        content: {
            type: Object,
            required: true
        }
        
    },
    components:{
        CommentCard,
        Vote,
        User
    },
    data() {
        return {
        comments: [
            { id: 1, body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' },
            { id: 2, body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' },
            { id: 3, body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' },
        ],
        };
    },
    mounted(){
        this.editor = new EasyMDE({
            element: this.$refs.editor,
            readOnly: true,
            toolbar: false,
            spellChecker: false,
        });

        this.editor.togglePreview();

       // console.log('fikusz1: ' + this.content.id);

       // console.log("fikusz     " + this.content.creator);
    },
};
</script>

<style>
.easymde-container.CodeMirror {
    border: none;
    background-color: green;
    overflow: hidden;
}
.easymde-preview img {
    max-width: 100%;
    height: auto;
}
</style>
