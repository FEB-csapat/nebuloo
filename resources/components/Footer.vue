<template>
  <div class="container d-flex flex-wrap align-items-center py-3 my-4 border-top">
    <footer style="margin-bottom: 50px;">
      <div class="row">
        <p class="mb-3">
          <router-link class="nav-link px-2" aria-current="page" :to="{ name: 'welcome'}">
            Nebuloo
          </router-link>
        </p>
      </div>
        <div class="row">
          <div class="col-sm-3 text-center">
            <router-link class="nav-link px-2 mt-1 " aria-current="page" :to="{ name: 'documentation'}" name="footerdocs">Dokumentációk</router-link>
          </div>
          <div class="col-sm-3 text-center">
            <router-link class="nav-link px-2 mt-1 " aria-current="page" :to="{ name: 'createTicket'}" name="footerticket">Hibajegy küldése</router-link>
          </div>
          <div class="col-sm-3 text-center">
            <a href="https://github.com/FEB-csapat/nebuloo" class="nav-link px-2 mt-1" name="footersource">Forrás kód</a>
          </div>
          <div class="col-sm-3 text-center">
            <router-link class="nav-link px-2 mt-1 " aria-current="page" :to="{ name: 'aszf'}" name="footeraszf">ÁSZF</router-link>
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