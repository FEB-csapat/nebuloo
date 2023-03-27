<script>
import NavBar from './components/NavBar.vue'
import { RouterLink, RouterView } from 'vue-router'




export default{
  components:{
    NavBar,
    RouterView
  },

  computed: { 
    isNotAtWelcomePage() {
      return this.$route.path !== '/welcome';
    }
  },
}
</script>


<template>
  <nav-bar v-if="isNotAtWelcomePage"/>
  <RouterView/>
</template>