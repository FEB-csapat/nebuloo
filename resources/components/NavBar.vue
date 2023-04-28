<template>
  <nav class="navbar navbar-expand-lg bg-primary bg-opacity-75 rounded-bottom">
    <div class="container-fluid ">
      <router-link class="navbar-brand text-light" id="nebuloo-title" :to="{ name: 'welcome'}">
        <h1>Nebuloo</h1>
      </router-link>
      
      <div class=" show navbar-collapse" id="navbarSupportedContent">


        <div class="me-auto mb-2 ">
          <button v-if="showContentsButton" style="width: 110px;" class="btn ms-2 mt-2" id="button">
            <router-link class="nav-link active" aria-current="page" :to="{ name: 'contents'}" name="navcontents">Tananyagok</router-link>
          </button>
        
          <button v-if="showQuestionsButton" style="width: 110px;" class="btn ms-2  mt-2   " id="button">
            <router-link class="nav-link active" aria-current="page" :to="{ name: 'questions'}" name="navquestions">Kérdések</router-link>
          </button>
        </div>

        <form v-if="showSearchBar" class="d-flex pe-2" @submit.prevent="search">
          <input v-model="searchTerm" style="max-width: 160px" class="form-control me-1" type="search" placeholder="Keresés" aria-label="Search"/>
          
          <button class="btn btn-outline-light" type="submit">
            <i class="fa-solid fa-magnifying-glass"/>
          </button>
        </form>

        <div v-if="showProfile" class="row h-100">
          <div class="col text-center">
              <router-link class="nav-link active" aria-current="page" :to="{ name: 'myUserProfile'}" name="navprofile">

                <user :user="user" :clickable="false"/>
              </router-link>
          </div>
        </div>

        <button v-if="!showProfile && !isLoggedIn" style="width: 130px;" class="btn ms-2 text-center" id="button">
          <router-link class="nav-link active" aria-current="page" :to="{ name: 'login'}" name="navlogin">Bejelentkezés</router-link>
        </button>

      </div>
    </div>
</nav>
</template>

<script>
import { RouterLink } from 'vue-router';
import User from './User.vue';
import { UserManager } from '../utils/UserManager';
export default{
    name:"NavBar",
    components:{
        RouterLink,
        User
    },
    computed: {
      showContentsButton() {
        return !(this.$route.path == '/contents'
        || this.$route.path == '/login' || this.$route.path == '/registration');
      },
      showQuestionsButton() {
        return !(this.$route.path == '/questions'
        || this.$route.path == '/login' || this.$route.path == '/registration');
      },
      showSearchBar() {
        return this.$route.path == '/questions' || this.$route.path == '/contents';
      },
      showProfile() {
        return this.user != null && this.$route.path != '/myprofile'
            && this.$route.path != '/login' && this.$route.path != '/registration';
      },
      isLoggedIn() {
        return this.user != null;
      },

      user: function(){return UserManager.getUser() }
    },

    data() {
      return {
        searchTerm: '',
        // user: null,
      }
    },

    methods: {
      search() {
        if(this.searchTerm != null){
          if(this.$route.path == '/contents'){
            this.$router.push({
              name: 'contents',
              query: { search: this.searchTerm }
            })
          }

          else if(this.$route.path == '/questions'){
            this.$router.push({
              name: 'questions',
              query: { search: this.searchTerm }
            })
          }
        }
      }
    },
  }
</script>