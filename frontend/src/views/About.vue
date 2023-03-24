<template>
<div class="container bg-light rounded-3 shadow mt-5">
    <div class="row p-3">
        <p>
            Maecenas non velit eu mi feugiat fermentum. Phasellus dapibus consequat dolor, non malesuada neque pellentesque ac. Curabitur a magna a diam condimentum scelerisque in vitae enim. Etiam vel imperdiet nisl, nec scelerisque lacus. Nullam nunc erat, fringilla eget purus eu, tincidunt suscipit nulla. Sed pellentesque tellus sapien, blandit finibus magna rutrum at. Donec tempus commodo ante id volutpat. Nulla facilisi.
        </p>

        

        <img style="width: 70px; height: 48px" v-on:click="redirectToGithub" src="../assets/images/github.png" alt="Button Image">
        <p>Forrás kód</p>
                    
    </div>
</div>
</template>

<script>
export default {
  methods: {
    redirectToGithub() {
      window.location.href = 'https://github.com/FEB-csapat/nebuloo';
    }
  }
}
</script>

