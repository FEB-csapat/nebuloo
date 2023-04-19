<template>
<div class="container">
    
    <div class="row bg-light mt-3 mb-2 rounded-3 p-3 shadow">
            <div class="col text-end mb-4" v-if="myprofile">
                <button class="btn" id="button" @click="SignOut()">
                        Kijelentkezés
                </button>
            </div>
        <div class="row text-center mb-4">
            <user v-if="userdata!=null" :user="userdata" v-bind:showDetailed="true"></user> 
        </div>
        <div class="row mb-2">
            <div class="col-sm-4">
            <h2>Statisztika:</h2>
                <div class="row">
            <div class="col-6 mb-2">
                <p>
                    votescore
                </p>
                <h6 v-if="userdata!=null">
                    {{this.userdata.recieved_votes}}
                </h6>
            </div>
            <div class="col-6 mb-2">
                <p>
                    questions
                </p>
                <h6 v-if="userdata!=null">
                    {{ this.userdata.questions.length }}
                </h6>
            </div>
            <div class="col-6 mb-2">
                <p>
                    contents
                </p>
                <h6 v-if="userdata!=null">
                    {{ this.userdata.contents.length }}
                </h6>
            </div>
            <div class="col-6 mb-2">
                <p>
                    comments
                </p>
                <h6 v-if="userdata!=null">
                    {{ this.userdata.comments.length }}
                </h6>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <h2>Bio:</h2>
    <p v-if="userdata != null" class="ps-5">
        {{ userdata.bio }}
    </p>
    </div>
        </div>

    <h2>Érdekeltségi kör:</h2>

    <ul class="ps-5">
        <li>Fizika</li>
        <li>Matematika</li>
        <li>Filozófia</li>
    </ul>
    <div class="row text-center" v-if="myprofile">
        <div class="col-6">
                <button class="btn btn-info"  @click="navigate">
                        Profilom szerkesztése
                </button>
        </div>
        <div class="col-6">
                <button class="btn btn-danger" @click="deleteMe()">
                        Fiókom törlése
                </button>
        </div>
    </div>
    <div class="row my-4" v-if="admin">
        <h2>
            Admin panel:
        </h2>
        <div class="col-sm-6">
            <select v-model="pickedrole" class="form-select mb-2 col-12" name="roleselector">
                <option value="moderator">Moderátor</option>
                <option value="user">User</option>
            </select>
                <label for="roleselector" class="form-label col-6">Jogosultság adása:</label>
                <button class="btn btn-success col-6" @click="changeProfileRole()">Mentés</button>
            
            
            
        </div>
    </div>
    <div class="row my-2 text-center" v-if="admin">
        <div class="col-6">
            <button class="btn btn-info" @click="editProfile()">Profil szerkesztése</button>
        </div>
        <div class="col-6">
            <button class="btn btn-danger" @click="banProfile()">Felhasználó tiltása</button>
        </div>
    </div>
    </div>
    

    <h2 class="mt-5 mb-2">Kérdéseim:</h2>
    <p v-if="IHaveQuestions==false">
        Nincsenek kérdéseim.
    </p>
    <cards :Questions="userdata.questions" v-else/>

    <h2 class="mt-4 mb-2">Tananyagaim:</h2>
    <p v-if="IHaveContents==false">
        Nincsenek tananyagaim.
    </p>
    <cards :Contents="userdata.contents" v-else/>

    <h2 class="mt-4">Kommentjeim:</h2>
    <div>
        <p v-if="IHaveComments==false">
            Nincsenek kommentjeim.
        </p>
        <comment-card v-else v-for="comment in userdata.comments" :key="comment.id" :comment="comment" />
    </div>
    
    <h2 class="mt-4">Hibajegyeim:</h2>
    <p v-if="IHaveTickets==false">
        Nincsenek Hibajegyeim.
    </p>
    <cards :Tickets="userdata.tickets" v-else/>

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
        userdata: null,
        myprofile: false,
        admin: false,

        pickedrole: null
    }   
},
components:{
    Cards,
    CommentCard,
    User
},
props:{
    id: {
        type: Number,
        required: false
    }
        
},
methods:{
    async changeProfileRole(){
        if(window.confirm("Biztosan megakarja változtatni a felhasználó jogosultságait?")){
            var data={
                role: this.pickedrole
            };
            NebulooFetch.changeUserRole(this.id,data)
            .then(()=>{
                alert("Sikeresen megváltoztatva!");
            })
            .catch(error=>{
                console.log(error) //TODO: Handle error
            });
        }
    },
    async banProfile(){
        if(window.confirm("Biztosan tiltani akarja a felhasználót?")){
            NebulooFetch.banUser(this.id)
            .then(()=>{
                alert("A felhasználó sikeresen kitiltva!")
            })
            .catch(error=>{
                console.log(error)
            });
        }
    },
    async editProfile(){

    },
    
    async GetMyData(){
        this.responseBody = (await NebulooFetch.getMyDatas()).data;

        this.userdata = this.responseBody;
    },
    async getProfileData(){
        this.userdata = (await NebulooFetch.getUserData(this.id)).data;
    },
    async deleteMe(){
        if (window.confirm("Biztosan törölni szeretné fiókját?")) {
            NebulooFetch.deleteMyProfile()
            .then(()=>{
                sessionStorage.removeItem('userToken');
                alert("Sikeres törlés!",router.push('/'));
            })
        }
    },
    navigate(){
            this.$router.push({
                name: 'edit',
                params: {
                    data:  this.userdata
                },
                props: {
                    data: this.userdata
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
        return this.userdata != null && this.userdata.questions != 0;
    },
    IHaveComments(){
        return this.userdata != null && this.userdata.comments != 0;
    },
    IHaveContents(){
        return this.userdata != null && this.userdata.contents != 0;
    },
    IHaveTickets(){
        return this.userdata != null && this.userdata.tickets != 0;
    },
    
  },

async mounted(){
    console.log(this.id);
    if(this.id==null) //MyProfile
    {
        this.GetMyData();
        this.myprofile = true;
    }
    else{
        this.getProfileData();
        this.myprofile = false;
    }
    if(sessionStorage.getItem('userRole')==='admin'){
        this.admin= true;
    }
}

}
</script>