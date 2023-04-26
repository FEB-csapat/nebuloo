<template>
<div class="container">
    <div class="row bg-light mt-3 mb-2 rounded-3 p-3 shadow">
            <div class="col text-end mb-4" v-if="isMyProfile">
                <button class="btn" id="button" @click="SignOut()">
                        Kijelentkezés
                </button>
            </div>
        <div class="row text-center mb-4">
            <user v-if="userData!=null" :user="userData" v-bind:showDetailed="true" :clickable="false"></user> 
        </div>


        <h5 v-if="userData!=null">Felhasználónév: {{userData.name}}</h5>

        <div class="row mb-2">
            <div class="col-sm-4">
            <h2>Statisztika:</h2>
                <div class="row">
            <div class="col-6 mb-2">
                <p>
                    Szavazások:
                </p>
                <h6 v-if="userData!=null">
                    {{this.userData.recieved_votes}}
                </h6>
            </div>
            <div class="col-6 mb-2">
                <p>
                    Kérdések:
                </p>
                <h6 v-if="userData!=null">
                    {{ this.userData.questions.length }}
                </h6>
            </div>
            <div class="col-6 mb-2">
                <p>
                    Tananyagok:
                </p>
                <h6 v-if="userData!=null">
                    {{ this.userData.contents.length }}
                </h6>
            </div>
            <div class="col-6 mb-2">
                <p>
                    Kommentek:
                </p>
                <h6 v-if="userData!=null">
                    {{ this.userData.comments.length }}
                </h6>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <h2>Bio:</h2>
    <p v-if="userData != null" class="ps-5">
        {{ userData.bio }}
    </p>
    </div>
        </div>

    <div class="row text-center" v-if="isMyProfile">
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

    <div class="row my-4" v-if="isAdmin && !isMyProfile">
        <hr>
        <h2>
            Admin panel:
        </h2>
        <div class="col-sm-6">
            <select v-model="pickedRole" class="form-select mb-2 col-12" name="roleselector">
                <option value="moderator">Moderátor</option>
                <option value="user">User</option>
            </select>
                <label for="roleselector" class="form-label col-6">Jogosultság adása:</label>
                <button class="btn btn-success col-6" @click="changeProfileRole()">Mentés</button>
            
            
            
        </div>
    </div>
    <div class="row my-2 text-center" v-if="isAdmin && !isMyProfile">
        <div class="col-6">
            <button class="btn btn-info" @click="editProfile()">Profil szerkesztése</button>
        </div>
        <div class="col-6">
            <button class="btn btn-danger" @click="banProfile()">Felhasználó tiltása</button>
        </div>
    </div>
    </div>
    

    <h2 class="mt-5 mb-2">Kérdéseim:</h2>
    <p v-if="!hasQuestions">
        Nincsenek kérdéseim.
    </p>
    <cards :Questions="userData.questions" v-else/>

    <h2 class="mt-4 mb-2">Tananyagaim:</h2>
    <p v-if="!hasContents">
        Nincsenek tananyagaim.
    </p>
    <cards :Contents="userData.contents" v-else/>

    <h2 class="mt-4">Kommentjeim:</h2>
    <div>
        <p v-if="!hasComments">
            Nincsenek kommentjeim.
        </p>
        <comment-card v-else v-for="comment in userData.comments" :key="comment.id" :comment="comment" />
    </div>
    
    <h2 class="mt-4">Hibajegyeim:</h2>
    <p v-if="!hasTickets">
        Nincsenek Hibajegyeim.
    </p>
    <cards :Tickets="userData.tickets" v-else/>

</div>
</template>
<script>
import Cards from '../components/Cards.vue'
import { NebulooFetch } from '../utils/https.mjs';
import CommentCard from '../components/CommentCard.vue';
import router from '../router';
import User from '../components/User.vue';
import { UserManager } from '../utils/UserManager';


export default{
data(){
    return{
        userData: null,
        isMyProfile: false,

        pickedRole: null
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
                role: this.pickedRole
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
    editProfile(){
        router.push({
            name: 'EditProfile',
            params: {
                id:  this.userData.id
            },
            props:{
                id: this.userData.id
            }
        }) 
    },
    
    async getMyData(){
        this.responseBody = (await NebulooFetch.getMyDatas()).data;
        this.userData = this.responseBody;
    },
    async getProfileData(){
        this.userData = (await NebulooFetch.getUserData(this.id)).data;
    },
    async deleteMe(){
        if (window.confirm("Biztosan törölni szeretné fiókját?")) {
            NebulooFetch.deleteMyProfile()
            .then(()=>{
                UserManager.logout();
                alert("Sikeres törlés!",router.push('/'));
            })
        }
    },
    navigate(){
            this.$router.push({
                name: 'EditProfile',
                params: {
                    id:  this.userData.id
                },
                props: {
                    id: this.userData.id
                }
            })
        },
        SignOut(){
            UserManager.logout();
            router.push('/');
        },
},
computed: { 
    hasQuestions(){
        return this.userData != null && this.userData.questions != 0;
    },
    hasComments(){
        return this.userData != null && this.userData.comments != 0;
    },
    hasContents(){
        return this.userData != null && this.userData.contents != 0;
    },
    hasTickets(){
        return this.userData != null && this.userData.tickets != 0;
    },
    isAdmin(){
        return UserManager.isAdmin();
    }
},

async mounted(){
    console.log(this.id);
    
    if(this.id==null) //MyProfile
    {
        this.getMyData();
        this.isMyProfile = true;
    }else if(this.id== UserManager.getUser().id)
    {
        this.$router.push('/myprofile',);
        this.getMyData();
        this.isMyProfile = true;
    }
    else{
        this.getProfileData();
        this.isMyProfile = false;
    }
}

}
</script>