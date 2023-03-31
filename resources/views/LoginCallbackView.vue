<template>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <h2 id="title">Nebuloo</h2>
            <p>
                Várakozás a bejelentkezésre...
            </p>
            <p>user: {{user}}</p>
        </div>
        
    </div>
</div>
</template>
<script>
import axios from 'axios';

export default{

    async mounted() {
        const searchParams = new URLSearchParams(window.location.search);
        const code = searchParams.get('code');
        console.log("huha" + code);

        const url = 'http://localhost:8881/api/login/google/callback';
        const response = await axios.get(url, { code });
        const data = response.data;
        return data;

        if (code) {
        // Handle the authorization code and exchange it for an access token and refresh token
        // using the methods in your Vue component.
        // Then redirect the user to the desired page in your Vue app.
        
        }
  },

    props(){
        return{
            user: Object,
        }
    }
}
</script>