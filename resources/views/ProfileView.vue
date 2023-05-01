<template>
<div class="container">
    <loading-spinner v-if="isWaiting"/>

    <div v-if="!isWaiting" >
        <div class="row bg-light mt-3 mb-2 rounded-3 p-3 shadow">
            <div class="col text-end" v-if="isMyProfile">
                <button class="btn nebuloobutton" name="logout" @click="signOut()">
                    Kijelentkezés
                </button>
            </div>
                
            <div class="row text-center mb-4">
                
                <user v-if="userData!=null" :user="userData" v-bind:showDetailed="true" :clickable="false"></user> 
            </div>
    
            <h5 v-if="userData!=null">Felhasználónév: {{userData.username}}</h5>
    
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Statisztika:</h2>
                    <div class="row">
                <div class="col-6 mb-2 text-center">
                    <p>Szavazások:</p>
                    <h5 v-if="userData!=null" name="votescore">{{this.userData.recieved_votes}}</h5>
                </div>
                <div class="col-6 mb-2 text-center">
                    <p>Kérdések:</p>
                    <h5 v-if="userData!=null">{{ this.userData.questions.length }}</h5>
                </div>
                <div class="col-6 mb-2 text-center">
                    <p>Tananyagok:</p>
                    <h5 v-if="userData!=null">{{ this.userData.contents.length }}</h5>
                </div>
                <div class="col-6 mb-2 text-center">
                    <p>Kommentek:</p>
                    <h5 v-if="userData!=null">{{ this.userData.comments.length }}</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <h2>Bio:</h2>
            <p v-if="userData != null" class="ps-5">{{ userData.bio }}</p>
        </div>
        </div>
    
        <div class="row text-center" v-if="isMyProfile">
            <div class="col-6">
                <button class="btn btn-info" name="editprofile"  @click="navigateToEditProfileView()">
                    Profilom szerkesztése
                </button>
            </div>
            <div class="col-6">
                <button class="btn btn-danger" name="deleteprofile" @click="deleteMe()">
                    Fiókom törlése
                </button>
            </div>
        </div>
    
        <div v-if="(isAdmin && !userIsAdmin && !isMyProfile) || (isMod && !userIsAdmin && !userIsMod && !isMyProfile) ">
            <h2 v-if="isAdmin">
                Admin panel:
            </h2>
            <h2 v-if="isMod">
                Moderátor panel:
            </h2>
            <hr>
            <div class="row my-4" v-if="isAdmin">
                
                <div class="col-sm-6">
                    <label for="roleselector" class="form-label col-6">Jogosultság adása:</label>
        
                    <select v-model="pickedRole" class="form-select mb-2 col-12" name="roleselector">
                        <option value="moderator">Moderátor</option>
                        <option value="user">User</option>
                    </select>
                    <button class="btn btn-success col-6" @click="changeProfileRole()">Mentés</button>                       
                </div>
            </div>
        
            <div class="row my-2 text-center">
                <div class="col-4">
                    <button class="btn btn-info" name="edituserprofile" @click="navigateToEditProfileView()">Profil szerkesztése</button>
                </div>
                <div class="col-4">
                    <button v-if="!userData.banned" name="banuserprofile" class="btn btn-danger" @click="banUser()">Felhasználó bannolása</button>
                    <button v-else class="btn btn-danger" @click="unbanUser()">Felhasználó bannolás feloldása</button>
                </div>
                <div class="col-4" v-if="isAdmin">
                    <button class="btn btn-danger" name="deleteuserprofile" @click="deleteUser()">Felhasználó törlése</button>
                </div>
            </div>
        </div>
        </div>
        
        <div>
            <h2 class="mt-5 mb-2">Kérdéseim:</h2>
            <p v-if="!hasQuestions">
                Nincsenek kérdéseim.
            </p>
            <question-card v-else v-for="question in userData.questions" :question="question" :key="question.id"/>
        
            <h2 class="mt-4 mb-2">Tananyagaim:</h2>
            <p v-if="!hasContents">
                Nincsenek tananyagaim.
            </p>
            <content-card v-else v-for="content in userData.contents" :content="content" :key="content.id"/>
        
            <h2 class="mt-4">Kommentjeim:</h2>
            <div>
                <p v-if="!hasComments">
                    Nincsenek kommentjeim.
                </p>
                <comment-card v-else v-for="comment in userData.comments" :comment="comment" :key="comment.id"/>
            </div>
            
            <h2 class="mt-4">Hibajegyeim:</h2>
            <p v-if="!hasTickets">
                Nincsenek Hibajegyeim.
            </p>
            <ticket-card v-else v-for="ticket in userData.tickets" :ticket="ticket" :key="ticket.id"/>
        </div>
    </div>

    
</div>
</template>
<script>
import { RequestHelper } from '../utils/RequestHelper';
import CommentCard from '../components/CommentCard.vue';
import User from '../components/User.vue';
import { UserManager } from '../utils/UserManager';

import TicketCard from '../components/TicketCard.vue';
import ContentCard from '../components/ContentCard.vue';
import QuestionCard from '../components/QuestionCard.vue';
import LoadingSpinner from '../components/LoadingSpinner.vue';



export default{
data(){
    return{
        userData: null,
        isMyProfile: false,

        pickedRole: null,
        isWaiting: true
    }   
},
components:{
    ContentCard,
    QuestionCard,
    CommentCard,
    User,
    TicketCard,
    LoadingSpinner
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
            RequestHelper.changeUserRole(this.id, this.pickedRole)
            .then(()=>{
                alert("Sikeresen megváltoztatva!");
                this.fetchUserData();
            })
            .catch(error=>{
                console.log(error)
            });
        }
    },
    async banUser(){
        if(window.confirm("Biztosan bannolni akarja a felhasználót?")){
            RequestHelper.banUser(this.id)
            .then(()=>{
                alert("A felhasználó sikeresen kitiltva!");
                this.fetchUserData();
            })
            .catch(error=>{
                console.log(error)
            });
        }
    },
    async unbanUser(){
        if(window.confirm("Biztosan fel akarja oldani a bannolást a felhasználóról?")){
            RequestHelper.unbanUser(this.id)
            .then(()=>{
                alert("Bannolás visszavonva!");
                this.fetchUserData();
            })
            .catch(error=>{
                console.log(error)
            });
        }
    },
    navigateToEditProfileView(){
        this.$router.push({
            name: 'editUserProfile',
            params: {
                id:  this.userData.id
            }
        });
    },
    async deleteUser(){
        if(window.confirm("Biztosan törölni akarja a felhasználót?")){
            RequestHelper.deleteUser(this.id)
            .then(()=>{
                alert("A felhasználó sikeresen kitiltva!");
                this.$router.push({
                    name: 'contents'
                });
            })
            .catch(error=>{
                console.log(error)
            });
        }
    },
    
    async getMyData(){
        this.isWaiting=true;
        this.responseBody = (await RequestHelper.getMyDatas()).data;
        this.userData = this.responseBody;
        this.isWaiting=false;
    },
    async getProfileData(){
        this.isWaiting=true;
        this.userData = (await RequestHelper.getUserData(this.id)).data;
        this.isWaiting=false;
    },

    async fetchUserData(){
        if(this.id == null){
            this.isMyProfile = true;
            this.getMyData();
        }
        else{
            this.isMyProfile = false;
            this.getProfileData();
            
        }
    },


    async deleteMe(){
        if (window.confirm("Biztosan törölni szeretné fiókját?")) {
            RequestHelper.deleteMe()
            .then(()=>{
                UserManager.logout();
                alert("Sikeres törlés!", this.$router.push({name: 'welcome'}));
            })
        }
    },
    signOut(){
        UserManager.logout();
        this.$router.push({name: 'welcome'});
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
    },
    isMod(){
        return UserManager.isModerator();
    },

    userIsAdmin(){
        return this.userData?.role == "admin";
    },
    userIsMod(){
        return this.userData?.role == "moderator";
    }
},

async mounted(){
    if(this.id==null) //MyProfile
    {
        this.getMyData();
        this.isMyProfile = true;
    }else if(UserManager.isMine(this.id))
    {
        this.$router.push({
            name: 'myUserProfile',
        });
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