<script>
import NavBar from '../components/NavBar.vue';
import { RouterLink, RouterView } from 'vue-router';
//import router from './router/index.js';

export default{
  components:{
    NavBar,
    RouterView
  },

  computed: { 
    isNotAtWelcomePage() {
      return true;
      //return this.$route.path !== '/welcome';
    }
  },
}
</script>


<template>
  <nav-bar v-if="isNotAtWelcomePage"/>
  <RouterView/>
</template>