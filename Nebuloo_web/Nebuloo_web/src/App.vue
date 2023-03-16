<script>
import NavBar from './components/NavBar.vue'
import { RouterLink, RouterView } from 'vue-router'

export default{
  components:{
    NavBar,
    RouterView
  }
}
</script>

<template>
  <nav-bar/>
  <RouterView/>
</template>
