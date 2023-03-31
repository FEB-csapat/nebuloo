<template>
    <div class="row h-100 bg-primary bg-opacity-75 py-5 text-center text-light">
        <h1 id="welcome-title" class="pt-3 pb-3">Nebuloo</h1>
        <h4 id="welcome-subtitle" class="py-3">Tananyag megosztó fórum</h4>
        <h5 id="welcome-motto" class="pb-5 pt-3 fs-6">Mert a tudás mindenkit megillet</h5>
    </div>
        <div class="container bg-light rounded-4 mt-4 mx-auto text-center py-2 px-4 shadow">
            <div class="row">
                <h4 class="m-3">Nem érted a Viète-formulákat? Kérdezz nyugodtan! Pont hogy érted? Oszdd meg a tudást a többiekkel!</h4>
                <h5>Mászd meg a tudás ranglétráját és vállj bölcsé!</h5>
                <p class="text-start">Rangok:</p>
                <div class="row text-center">
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>tanuló</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>okostojás</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>oktató</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>tanár</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>professzor</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <img src="https://placeholder.pics/svg/35" alt="">
                        <p>bölcs</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 mx-auto m-4">
            <div class="container bg-light rounded-3 shadow">
                <h2 class="text-center">Tovább</h2>
                
                <div class="row p-3 d-flex justify-content-center text-center">
                    <div class="col-md-4"><button class="btn shadow" style="background-color: #ffffff; color: #4285f4;" @click="signIn"><img src="../assets/images/google.png" alt="Button Image"></button> </div>
                    <p class="col-md-4 align-self-center">Vagy</p>
                    <div class="col-md-4">
                        <router-link class="nav-link active" aria-current="page" to="/contents">
                            <button class="btn shadow" style="background-color: #ffffff; color: #4285f4;">Bejelentkezés nélkül</button>
                        </router-link>
                    </div>
                </div>
                    <div class="form-check text-center">
                        <input class="check-input" type="checkbox" value="" id="aszf">
                        <label class="form-check-label ms-1" for="aszf">
                            Elfogadom az ÁSZF-et
                        </label>
                    </div>
                    <div class="row text-center">
                        <div class="col">
                            <router-link class="nav-link active" aria-current="page" to="/ASZF">ÁSZF</router-link>

                        </div>
                        <div class="col">
                            <router-link class="nav-link active" aria-current="page" to="/about">Rólunk</router-link>
                        </div>



                    </div>
            </div>
        </div>
        
</template>

<script>
import axios from 'axios';

import GoogleAuth from 'vue-google-oauth2'

export default {

    
    methods: {
    signIn() {
      const clientId = '696699163899-v5cqgj49pei5ou6nbb2i9kr8bpeh8coe.apps.googleusercontent.com';
      const redirectUri = 'http://localhost:8881/login/callback';
      const scope = 'https://www.googleapis.com/auth/plus.me';
      const responseType = 'code';
      const url = `https://accounts.google.com/o/oauth2/v2/auth?client_id=${clientId}&redirect_uri=${redirectUri}&scope=${scope}&response_type=${responseType}`;
      window.location.href = url;
    },
    async exchangeCodeForToken(code) {
      const clientId = 'YOUR_CLIENT_ID';
      const clientSecret = 'YOUR_CLIENT_SECRET';
      const redirectUri = 'YOUR_REDIRECT_URI';
      const grantType = 'authorization_code';
      const url = 'https://oauth2.googleapis.com/token';
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `code=${code}&client_id=${clientId}&client_secret=${clientSecret}&redirect_uri=${redirectUri}&grant_type=${grantType}`,
      });
      const data = await response.json();
      return data;
    },
    async getUserInfo(accessToken) {
      const url = 'https://www.googleapis.com/plus/v1/people/me';
      const response = await fetch(url, {
        headers: {
          Authorization: `Bearer ${accessToken}`,
        },
      });
      const data = await response.json();
      return data;
    },
  },
  async mounted() {
    const searchParams = new URLSearchParams(window.location.search);
    const code = searchParams.get('code');
    if (code) {
      const { access_token, refresh_token } = await this.exchangeCodeForToken(code);
      localStorage.setItem('access_token', access_token);
      localStorage.setItem('refresh_token', refresh_token);
      const userInfo = await this.getUserInfo(access_token);
      console.log(userInfo);
    }
  },


    /*
    methods: {
        async fetchData() {

            const authCode = await this.$gAuth.getAuthCode()
            const response = await this.$http.post('http://localhost:8881/api/login/google/callback', { code: authCode, redirect_uri: 'postmessage' })

            /*
            axios.get('http://localhost:8881/api/login/google')
            .then(response => {
                console.log(response.data);

                console.log(response.request.responseURL);

                window.location.href = response.request.responseURL;
            })
            .catch(error => {
                console.log(error);
            });

            
        }
    }
    */
}
</script>

<style>
.g-signin-button {
  /* This is where you control how the button looks. Be creative! */
  display: inline-block;
  padding: 4px 8px;
  border-radius: 3px;
  background-color: #3c82f7;
  color: #fff;
  box-shadow: 0 3px 0 #0f69ff;
}
</style> 
