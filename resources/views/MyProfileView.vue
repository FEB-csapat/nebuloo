<template>
<div class="container">
    
    <div class="row bg-light mt-3 mb-2 rounded-3 p-3 shadow">
        <div class="row">
            <div class="col text-end">
                <button class="btn" id="button" @click="SignOut()">
                        Kijelentkezés
                </button>
            </div>
        </div>
        <div class="row text-center">

            <user v-if="mydata!=null" :user="mydata" v-bind:showDetailed="true"></user>




            
        <!--
            <img src="https://placeholder.pics/svg/60" alt="" id="profpicture">

            <p v-if="mydata.rank != null" class="fs-6">{{ mydata.rank.name }}</p>
            <p v-if="mydata.roles != null" class="fs-6">{{ mydata.roles[0]}}</p>
            <p class="fs-4">{{ mydata.name }}</p>
        -->
            
        </div>
        <h2>Bio:</h2>
    <p v-if="mydata != null" class="ps-5">
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
                <button class="btn btn-danger" @click="deleteMe()">
                        Fiókom törlése
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
import router from '../router';
import User from '../components/User.vue';
export default{
data(){
    return{
        mydata: null,
    }
},
components:{
    Cards,
    CommentCard,
    User
},
methods:{
    
    async GetMyData(){
        this.responseBody = (await NebulooFetch.getMyDatas()).data;

        this.mydata = this.responseBody;
    },
    async deleteMe(){
        if (window.confirm("Biztosan törölni szeretné fiókját?")) {
            NebulooFetch.deleteMyProfile()
            .then(()=>{
                sessionStorage.removeItem('userToken');
                alert("Sikeres törlés!",router.push('/'));
            })
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
        SignOut(){
            sessionStorage.clear();
            router.push('/');
        },
},
computed: { 
    IHaveQuestions(){
        return this.mydata != null && this.mydata.questions != 0;
    },
    IHaveComments(){
        return this.mydata != null && this.mydata.comments != 0;
    },
    IHaveContents(){
        return this.mydata != null && this.mydata.contents != 0;
    },
    IHaveTickets(){
        return this.mydata != null && this.mydata.tickets != 0;
    },
    
  },

async mounted(){
    this.GetMyData();
}

}
</script>