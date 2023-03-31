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
      return this.$route.path !== '/';
    }
  },
}
</script>


<template>
  <nav-bar v-if="isNotAtWelcomePage"/>
  <RouterView/>
</template>