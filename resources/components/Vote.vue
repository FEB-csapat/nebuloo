<template>
    <div class="row">
        <div class="col">
            <i id="upvote" @click="toggleUpvote" class="fas fa-up-long fa-lg"/>
            <p id="votecount" class="text-center">{{voteCount + voteState}}</p>
            <i id="downvote" @click="toggleDownvote" class="fas fa-down-long fa-lg"/>
        </div>
    </div>
</template>

<script>
import { NebulooFetch } from '../utils/https.mjs';

export default{
    props:{
        contentId: Number, 
        vote: {
            type: Object,
            required: true
        },
        voteCount: Number
    },
    components:{
        
    },
    data(){
        return {
            voteCount: 0,
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
        this.voteState = this.vote?.direction ?? 0;
    }
}
</script>


<style>
.fa-arrow-up{
    color: blue;
}

</style>
