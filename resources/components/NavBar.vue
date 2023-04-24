<template>
  <nav class="navbar navbar-expand-lg bg-primary bg-opacity-75 rounded-bottom">
    <div class="container-fluid ">
      <router-link class="navbar-brand text-light" to="/" id="title"><h1>Nebuloo</h1></router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse show navbar-collapse" id="navbarSupportedContent">


        <div class="me-auto mb-2 ">
          <button v-if="showContentsButton" class="btn ms-2 mt-2" id="button"><router-link class="nav-link active" aria-current="page" to="/contents">Tananyagok</router-link></button>
        
            <button v-if="showQuestionsButton" class="btn ms-2  mt-2   " id="button"><router-link class="nav-link active" aria-current="page" to="/questions">Kérdések</router-link></button>
        </div>

        <form v-if="showSearchBar" class="d-flex" @submit.prevent="search">
          <input v-model="searchTerm" class="form-control me-2" type="search" placeholder="Keresés" aria-label="Search">
          <button class="btn btn-outline-light me-2" type="submit">Keresés</button>
        </form>

        <div v-if="showProfile" class="row h-100">
          <div class="col text-center">
              <router-link class="nav-link active" aria-current="page" to="/myprofile">
                <user :user="user"/>
              </router-link>
          </div>
        </div>
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
          return this.$route.path !== '/contents';
        },
        showQuestionsButton() {
          return this.$route.path !== '/questions';
        },
        showSearchBar() {
          return this.$route.path == '/questions' || this.$route.path == '/contents';
        },
        showProfile() {
          return this.$route.path != '/myprofile';
        },
      },

      data() {
        return {
          searchTerm: '',
          user: null,
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
      mounted(){
        this.user = UserManager.getUser();
      }
    }
  </script>