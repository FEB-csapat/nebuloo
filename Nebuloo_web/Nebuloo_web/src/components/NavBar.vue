<template>
<nav class="navbar navbar-expand-lg bg-primary bg-opacity-75">
  <div class="container-fluid ">
    <router-link class="navbar-brand text-light" to="/" id="title"><h1>Nebuloo</h1></router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mx-3">
            <button class="btn" id="navbarbutton">Tananyagok</button>
        </li>
        <li class="nav-item">
            <button class="btn" id="navbarbutton">QnA</button>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Keresés" aria-label="Search">
        <button class="btn btn-outline-light me-2" type="submit">Keresés</button>
      </form>
      <div class="row h-100">
        <div class="col text-center">
            <img src="https://placeholder.pics/svg/35" alt="">
        </div>
      </div>
    </div>
  </div>
</nav>
</template>

<script>
import { RouterLink } from 'vue-router';
export default{
    name:"NavBar",
    components:{
        RouterLink
    }
    }
</script>