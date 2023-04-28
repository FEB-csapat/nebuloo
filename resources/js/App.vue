<script>
import NavBar from '../components/NavBar.vue';
import { RouterLink, RouterView } from 'vue-router';
import Footer from '../components/Footer.vue';

import SnackBar from '../components/snackbars/SnackBar.vue';

export default{
  components:{
    NavBar,
    RouterView,
    Footer,
    SnackBar
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
    <RouterView class="content"/>
    <!-- TODO fix footer at the bottom of the page-->
    <Footer class="page-footer" style="z-index:-1;"/>


</template>