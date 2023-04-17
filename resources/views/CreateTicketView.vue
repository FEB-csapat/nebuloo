<template>
<div class="container my-3 ">
        <div class="row bg-light shadow rounded-3 p-2">
            <h1 id="title">Hibajegy küldése</h1>
            <div>
                <label for="leiras" class="form-label pt-2">Leírás*</label>
                <textarea name="leiras" id="leiras" v-model="body" rows="5" class="form-control"></textarea>

            </div>
            <div class="text-end p-2">
                <button class="btn" id="button" @click="NewTicket()">
                    Létrehozás
                </button>
            </div>
        </div>
    </div>
</template>
<script>
 import { NebulooFetch } from '../utils/https.mjs';
    export default{
        data(){
            return{
                body:""
            }
        },
        methods:{
            async NewTicket(){
                const data = JSON.stringify(this.ticket);
                NebulooFetch.createTicket(data)
                .then(()=>{
                    alert("Sikeres küldés!");
                    router.push('/myprofile');
                });
            }
        },
        mounted(){
        },
        computed:{
            ticket(){
                return{
                    body:this.body
                }
            }
        }
    };
</script>