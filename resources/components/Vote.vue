<template>
    <div id="vote_container" class="row text-center">
        <div v-if="isLoggedIn" class="col">
            <i id="upvote" @click="toggleUpvote" :class="['fas', 'fa-up-long', 'fa-lg', {'upvoted': voteState === 1}]" name="upvote_arrow"/>
            <p id="votecount" class="pt-3 text-center">{{voteCounted + voteState}}</p>
            <i id="downvote" @click="toggleDownvote" :class="['fas', 'fa-down-long', 'fa-lg', {'downvoted': voteState === -1}]" name="downvote_arrow"/>
        </div>
        <div v-else class="col">
            <i :class="['fas', 'fa-up-long', 'fa-lg', 'is-guest']" @click="NotLoggedInVote()" name="unauthupvote_arrow"/>
            <p class="pt-3 text-center" style="margin-left: 3px;">{{voteCounted + voteState}}</p>
            <i :class="['fas', 'fa-down-long', 'fa-lg', 'is-guest']" @click="NotLoggedInVote()" name="unauthdownvote_arrow"/>
        </div>
    </div>
</template>

<script>
import { string } from 'yup';
import { RequestHelper } from '../utils/RequestHelper';
import { UserManager } from '../utils/UserManager';

export default{
    props:{
        votableId: Number, 
        votableType:String,
        myVote: String,
        voteCount: {
            type: Number,
            default: 0
        }
    },
    components:{
        
    },
    data(){
        return {
            voteCounted: 0,
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
            RequestHelper.synchronizeVote(this.votableId, this.votableType, this.voteState);
        },
        NotLoggedInVote(){
            if(!UserManager.isLoggedIn()){
                window.alert("Szavazáshoz kérlek jelentkezz be!");
            }
        },
    },
    computed: {
        isLoggedIn(){
            return UserManager.isLoggedIn();
        }
    },
    mounted(){
        this.voteCounted = this.voteCount;

        if(this.myVote == 'up'){
            this.voteState = 1;
            this.voteCounted--;
        }else if(this.myVote == 'down'){
            this.voteState = -1;
            this.voteCounted++;
        }else{
            this.voteState = 0;
        }
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

.is-guest{
    color: grey;
}

</style>
