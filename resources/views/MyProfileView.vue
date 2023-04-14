<template>
<div class="container">
    <div class="row bg-light mt-3 mb-2 rounded-3 p-3 shadow">
        <div class="col text-center">
            <img src="https://placeholder.pics/svg/60" alt="" id="profpicture">
        <p class="fs-6">{{ rank.name }}</p>
        <p class="fs-4">{{ mydata.name }}</p>
        </div>
        <h2>Bio:</h2>
    <p class="ps-5">
        {{ mydata.bio }}
    </p>

    <h2>Érdekeltségi kör:</h2>

    <ul class="ps-5">
        <li>Fizika</li>
        <li>Matematika</li>
        <li>Filozófia</li>
    </ul>
    <div class="row">
        <div class="col-sm-6">
                <button class="btn" id="button" @click="navigate">
                        Profilom szerkesztése
                </button>
        </div>
        <div class="col-sm-6 text-end">
                <button class="btn btn-danger" @click="DeleteMe()">
                        Profilom törlése
                </button>
        </div>
    </div>
                
    <div class="text-end">
                
            </div>
    </div>
    

    <h2 class="mt-5 mb-2">Kérdéseim:</h2>
    <p v-if="IHaveQuestions==false">
        Nincsenek kérdéseim.
    </p>
    <cards :Questions="mydata.questions" v-else/>

    <h2 class="mt-4 mb-2">Tananyagaim:</h2>
    <p v-if="IHaveContents==false">
        Nincsenek tananyagaim.
    </p>
    <cards :Contents="mydata.contents" v-else/>

    <h2 class="mt-4">Kommentjeim:</h2>
    <div>
        <p v-if="IHaveComments==false">
            Nincsenek kommentjeim.
        </p>
        <comment-card v-else v-for="comment in mydata.comments" :key="comment.id" :comment="comment" />
    </div>
    
    <h2 class="mt-4">Hibajegyeim:</h2>
    <p v-if="IHaveTickets==false">
        Nincsenek Hibajegyeim.
    </p>
    <cards :Tickets="mydata.tickets" v-else/>

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
        mydata:[],
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
        this.mydata = this.responseBody;
        this.rank = this.responseBody.rank;
    },
    async DeleteMe(){
        if (window.confirm("Biztosan törölni szeretné profilját?")) {
        NebulooFetch.DeleteMe();
        sessionStorage.removeItem('userToken');
      } else {
        // user clicked "Cancel"
        // do nothing
      }
    },
    navigate(){
            this.$router.push({
                name: 'edit',
                params: {
                    data:  this.mydata
                },
                props: {
                    data: this.mydata
                }
            })
        },
},
computed: { 
    IHaveQuestions(){
        return this.mydata.questions != 0;
    },
    IHaveComments(){
        return this.mydata.comments != 0;
    },
    IHaveContents(){
        return this.mydata.contents != 0;
    },
    IHaveTickets(){
        return this.mydata.tickets != 0;
    },
    
  },

async mounted(){
    this.GetMyData();
}

}
</script>