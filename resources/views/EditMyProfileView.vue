<template>
    <div class="container">
        <div class="row bg-light mt-3 rounded-3 p-3 shadow">
            <div class="col text-center">
                <img src="https://placeholder.pics/svg/60" alt="">
            <p class="fs-6">{{ body.name }}</p>
            <p class="fs-4">Nevem</p>
            </div>
                <h2>Bio:</h2>
                <input type="text" class="form-control my-3" name="bio" id="bio" v-model="bio">
                <h2>Display Name:</h2>
                <input type="text" class="form-control my-3" name="display_name" id="display_name" v-model="display_name">
                <h2>Érdekeltségi kör:</h2>
                <select id="interest" class="form-select my-3">
                    <option data-hidden="true">Válasszon!</option>
                    <option>Fizika</option>
                    <option>Kémia</option>
                    <option>Matematika</option>
                </select>
                <div class="text-end">
                    <button class="btn" id="button" @click="editMyData()">Kész</button>
                </div>
      <ul class="ps-5">
        <li>Matematika</li>
        <li>Testnevelés</li>
      </ul>
        </div>
    </div>
    </template>
    <script>
import { NebulooFetch } from '../utils/https.mjs';
    export default{
        data(){
            return{   
                bio:'',
                display_name:''
            }
        },
        
        methods:{
    
            async editMyData(){
                const data = JSON.stringify(this.body);
                NebulooFetch.editMyDatas(data)
                .then(()=>{
                    alert("Sikeres változtatás");
                    router.push('/myprofile');
                });
            }
},
        computed:{
            body(){
                return{
                    bio:this.bio,
                    display_name:this.display_name
                }
            }
        }
    }
    </script>