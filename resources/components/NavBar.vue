<template>
  <nav class="navbar navbar-expand-lg bg-primary bg-opacity-75 rounded-bottom">
    <div class="container-fluid ">
      <router-link class="navbar-brand text-light" to="/" id="title"><h1>Nebuloo</h1></router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse show navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li v-if="showContentsButton" class="nav-item mx-2">
            <router-link class="nav-link active" aria-current="page" to="/contents">Tananyagok</router-link>
          </li>
          <li v-if="showQuestionsButton" class="nav-item mx-2">
              <button class="btn" id="button"><router-link class="nav-link active" aria-current="page" to="/questions">Kérdések</router-link></button>
          </li>
        </ul>
        <form v-if="showSearchBar" class="d-flex" @submit.prevent="search">
          <input v-model="searchTerm" class="form-control me-2" type="search" placeholder="Keresés" aria-label="Search">
          <button class="btn btn-outline-light me-2" type="submit">Keresés</button>
        </form>
        <div class="row h-100">
          <div class="col text-center">
              <router-link class="nav-link active" aria-current="page" to="/myprofile"><img src="https://placeholder.pics/svg/35" alt="" id="profpicture"></router-link>
          </div>
        </div>
      </div>
    </div>
  </nav>
  </template>
  
  <script>
  import { RouterLink } from 'vue-router';
  export default{
      name:"NavBar",
      components:{
          RouterLink
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
      },

      data() {
        return {
          searchTerm: ''
        }
      },

      methods: {
        search() {

          if(this.searchTerm != ''){
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
      }
    }
  </script>