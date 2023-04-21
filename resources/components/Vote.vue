<template>
    <div id="vote_container" class="row text-center">
        <div class="col">
            <i id="upvote" @click="toggleUpvote" :class="['fas', 'fa-up-long', 'fa-lg', {'upvoted': voteState === 1}]"/>
            <p id="votecount" class="pt-3 text-center" style="margin-left: 3px;">{{voteCount + voteState}}</p>
            <i id="downvote" @click="toggleDownvote" :class="['fas', 'fa-down-long', 'fa-lg', {'downvoted': voteState === -1}]"/>
        </div>
    </div>
</template>

<script>
import { NebulooFetch } from '../utils/https.mjs';

export default{
    props:{
        contentId: Number, 
        myVote: String,
        voteCount: Number
    },
    components:{
        
    },
    data(){
        return {
           // voteCount: 0,
            voteState: 0
        }
    },
    methods:{
        toggleUpvote(){
            if(this.voteState == 1){
                this.voteState = 0;
            }else{
                this.voteState = 1;
            }
            this.synchronizeVote();
        },
        toggleDownvote(){
            if(this.voteState == -1){
                this.voteState = 0;
            }else{
                this.voteState = -1;
            }
            this.synchronizeVote();
        },
        synchronizeVote(){
            NebulooFetch.synchronizeVote(this.contentId, 'contents', this.voteState);
        }
    },
    mounted(){
        this.voteState = this.myVote == 'up' ? 1 : this.myVote == 'down' ? -1 : 0;
    }
}
</script>


<style>

#vote_container{
    min-width: 50px;
}
fa-up-long{
    color: blue;
    transition: transform 1s ease-in-out;
  }
  #upvote:hover{
    color: #0000FF;
    transform: scale(1.2);
    transition: transform 0.1s ease-in-out;
  }
  #downvote:hover{
    color: #FF0000;
    transform: scale(1.2);
    transition: transform 0.1s ease-in-out;
  }
  .upvoted {
    color: blue;
    transform: scale(1.2);
  }

  .downvoted {
    color: red;
    transform: scale(1.2);
  }

</style>
