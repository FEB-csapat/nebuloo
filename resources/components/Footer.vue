<template>
  <div class="container d-flex flex-wrap align-items-center py-3 my-4 border-top">
    <footer>
      <div class="row">
        <p class="mb-3 text-muted">
          <router-link class="nav-link text-muted px-2" aria-current="page" to="/">
            Nebuloo
          </router-link>
        </p>
      </div>
        <div class="row">
          <div class="col-sm-3">
            <router-link class="nav-link text-muted px-2 mt-1 " aria-current="page" to="/documentation">Dokumentációk</router-link>
          </div>
          <div class="col-sm-3">
            <router-link class="nav-link text-muted px-2 mt-1 " aria-current="page" to="/tickets/create">Jelentés küldése</router-link>
          </div>
          <div class="col-sm-3">
            <a href="https://github.com/FEB-csapat/nebuloo" class="nav-link px-2 text-muted mt-1">Forrás</a>
          </div>
          <div class="col-sm-3">
            <router-link class="nav-link text-muted px-2 mt-1 " aria-current="page" to="/ASZF">ÁSZF</router-link>
          </div>
          
        </div>      
    </footer>
  </div>
  </template>
  
<script>
import { RouterLink } from 'vue-router';
export default{
    name:"Footer",
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

<style>
  footer{
      position: sticky;
      bottom: 0;
      width: 100%;
  }
</style>