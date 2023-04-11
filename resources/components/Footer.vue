<template>
  <div class="container" id="anyad">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <p class="col-md-4 mb-0 text-muted">Nebuloo</p>
  
      <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      </a>
  
      <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Dokumentáció</a></li>
        <li><router-link class="nav-link text-muted" aria-current="page" to="/create/ticket">Jelentés küldése</router-link></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Forrás</a></li>
        <li><router-link class="nav-link text-muted" aria-current="page" to="/about">Rólunk</router-link></li>
        

      </ul>
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