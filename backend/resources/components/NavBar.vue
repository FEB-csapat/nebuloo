<template>
<nav class="navbar navbar-expand-lg bg-primary bg-opacity-75 rounded-bottom">
  <div class="container-fluid ">
    <router-link class="navbar-brand text-light" to="/" id="title"><h1>Nebuloo</h1></router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li v-if="showContentsButton" class="nav-item mx-3">
            <button class="btn" id="button"><router-link class="nav-link active" aria-current="page" to="/contents">Tananyagok</router-link></button>

        </li>
        <li v-if="showQuestionsButton" class="nav-item mx-3">
            <button class="btn" id="button"><router-link class="nav-link active" aria-current="page" to="/questions">Kérdések</router-link></button>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Keresés" aria-label="Search">
        <button class="btn btn-outline-light me-2" type="submit">Keresés</button>
      </form>
      <div class="row h-100">
        <div class="col text-center">
            <router-link class="nav-link active" aria-current="page" to="/myprofile"><img src="https://placeholder.pics/svg/35" alt=""></router-link>
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
      }
  },
    }
</script>