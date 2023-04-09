<template>
<div class="container">
    <div class="row bg-light mt-3 rounded-3 p-3 shadow">
        <div class="col text-center">
            <img src="https://placeholder.pics/svg/60" alt="">
        <p class="fs-6">{{ myrank.name}}</p>
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
    <div class="text-end">
                <button class="btn" id="button"><router-link class="nav-link active" aria-current="page" to="/myprofile/edit">Profilom szerkesztése</router-link></button>
            </div>
    </div>
    

    <h2 class="mt-4 mb-2">Kérdéseim:</h2>
    <p v-if="IHaveQuestions==false">
        Nincsenek kérdéseim.
    </p>
    <cards :Questions="MyQuestions" v-else/>

    <h2 class="mt-4 mb-2">Tananyagaim:</h2>
    <p v-if="IHaveContents==false">
        Nincsenek tananyagaim.
    </p>
    <cards :Contents="MyContents" v-else/>

    <h2 class="mt-4">Kommentjeim:</h2>
    <div class="row bg-light mt-3 rounded-3 p-3 shadow">
        
        <p class="ps-5">
            Quisque iaculis ex risus, et pellentesque risus facilisis id. Integer urna quam, condimentum quis purus quis, accumsan vulputate urna. Fusce feugiat nisi eu molestie posuere. Ut eget interdum dui. Proin dapibus ex sit amet diam placerat semper. Nullam quis volutpat ante. Integer ut urna risus.
        </p>
    
    </div>
    
    <h2 class="mt-4">Hibajegyeim:</h2>
    <p v-if="IHaveTickets==false">
        Nincsenek Hibajegyeim.
    </p>
    <cards :Tickets="MyTickets" v-else/>

</div>
</template>
<script>
import Cards from '../components/Cards.vue'
import { NebulooFetch } from '../utils/https.mjs';
export default{
data(){
    return{
        mydata:[],
        MyQuestions:[],
        MyComments:[],
        MyContents:[],
        MyTickets:[],
        myrank:Object,

        token: "1|dO0npLTfqUQyZjodFAjpfCDVgoYAIqwoyh3kSeSM"
    }
},
components:{
    Cards
},
methods:{
    
    async GetMyData(){
        this.mydata = (await NebulooFetch.getMyDatas()).data;
        console.log(this.mydata);
        this.MyQuestions = this.mydata.questions;
        this.MyComments = this.mydata.comments;
        this.MyContents = this.mydata.contents;
        this.myrank = this.mydata.rank;
        this.MyTickets = this.mydata.tickets;
    }
},
computed: { 
    IHaveQuestions(){
        return this.MyQuestions.length != 0;
    },
    IHaveComments(){
        return this.MyComments.length != 0;
    },
    IHaveContents(){
        return this.MyContents.length != 0;
    },
    IHaveTickets(){
        return this.MyTickets.length != 0;
    },
  },
async mounted(){
    NebulooFetch.initialize(this.token);
    this.GetMyData();
}
}
</script>