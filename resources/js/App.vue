<script>
import NavBar from '../components/NavBar.vue';
import { RouterLink, RouterView } from 'vue-router';
import Footer from '../components/Footer.vue';
//import router from './router/index.js';

export default{
  components:{
    NavBar,
    RouterView,
    Footer
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
  <Footer v-if="isNotAtWelcomePage"/>
</template>

