<template>
  <div class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <footer>
      <div class="row">
        <p class="mb-3 text-muted">
          <router-link class="nav-link text-muted px-2" aria-current="page" to="/">
            Nebuloo
          </router-link>
        </p>
      </div>

      <div class="row justify-content-start">
        <div class="col-sm-6">
          <div class="row">
          <div class="col-md-3">
            <router-link class="nav-link text-muted px-2" aria-current="page" to="/documentation">Dokumentáció</router-link>
          </div>
          <div class="col-md-3">
            <router-link class="nav-link text-muted px-2" aria-current="page" to="/create/ticket">Jelentés küldése</router-link>

          </div>
          <div class="col-md-3">
            <a href="#" class="nav-link px-2 text-muted">Forrás</a>

          </div>
          <div class="col-md-3">
            <router-link class="nav-link text-muted px-2" aria-current="page" to="/about">Rólunk</router-link>

          </div>
        </div>
      
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