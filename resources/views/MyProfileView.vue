<template>
<div class="container">
    <div class="row bg-light mt-3 mb-2 rounded-3 p-3 shadow">
        <div class="col text-center">
            <img src="https://placeholder.pics/svg/60" alt="">
        <p class="fs-6">{{ rank.name}}</p>
        <p class="fs-4">{{ name }}</p>
        </div>
        <h2>Bio:</h2>
    <p class="ps-5">
        {{ bio }}
    </p>

    <h2>Érdekeltségi kör:</h2>

    <ul class="ps-5">
        <li>Fizika</li>
        <li>Matematika</li>
        <li>Filozófia</li>
    </ul>

    <div class="text-end">
                <button class="btn" id="button">
                    <router-link class="nav-link active" aria-current="page" to="/myprofile/edit">Profilom szerkesztése</router-link>
                </button>
            </div>
    </div>
    

    <h2 class="mt-5 mb-2">Kérdéseim:</h2>
    <p v-if="IHaveQuestions==false">
        Nincsenek kérdéseim.
    </p>
    <cards :Questions="questions" v-else/>

    <h2 class="mt-4 mb-2">Tananyagaim:</h2>
    <p v-if="IHaveContents==false">
        Nincsenek tananyagaim.
    </p>
    <cards :Contents="contents" v-else/>

    <h2 class="mt-4">Kommentjeim:</h2>
    <div>
        <p v-if="IHaveComments==false">
            Nincsenek kommentjeim.
        </p>
        <comment-card v-else v-for="comment in comments" :key="comment.id" :comment="comment" />
    </div>
    
    <h2 class="mt-4">Hibajegyeim:</h2>
    <p v-if="IHaveTickets==false">
        Nincsenek Hibajegyeim.
    </p>
    <cards :Tickets="tickets" v-else/>

</div>
</template>
<script>
import Cards from '../components/Cards.vue'
import { NebulooFetch } from '../utils/https.mjs';

import CommentCard from '../components/CommentCard.vue';
export default{
data(){
    return{
        name: '',
        bio: '',
        questions:[],
        comments:[],
        contents:[],
        tickets:[],
        rank: Object,
    }
},
components:{
    Cards,
    CommentCard
},
methods:{
    
    async GetMyData(){
        this.responseBody = (await NebulooFetch.getMyDatas()).data;
        this.questions = this.responseBody.questions;
        this.comments = this.responseBody.comments;
        this.contents = this.responseBody.contents;
        this.rank = this.responseBody.rank;
        this.tickets = this.responseBody.tickets;
    }
},
computed: { 
    IHaveQuestions(){
        return this.questions.length != 0;
    },
    IHaveComments(){
        return this.comments.length != 0;
    },
    IHaveContents(){
        return this.contents.length != 0;
    },
    IHaveTickets(){
        return this.tickets.length != 0;
    },
  },
async mounted(){
    NebulooFetch.initialize(this.token);
    this.GetMyData();
}
}
</script>