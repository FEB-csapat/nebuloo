<template>
<div class="container my-3 ">
        <div class="row bg-light shadow rounded-3 p-2">
            <h1 class="text-center mb-4">Hibajegy küldése</h1>
            <div>
                <label for="ticketinput" class="form-label pt-2">Leírás*</label>
                <textarea name="ticketinput" v-model="body" rows="5" class="form-control"></textarea>

            </div>
            <div class="text-end p-2">
                <button class="btn" id="button" @click="NewTicket()" name="createticket">
                    Létrehozás
                </button>
            </div>
        </div>
    </div>
</template>
<script>
 import { RequestHelper } from '../utils/RequestHelper';
import router from '../router';
    export default{
        data(){
            return{
                body:""
            }
        },
        methods:{
            async NewTicket(){
                const data = JSON.stringify(this.ticket);
                RequestHelper.createTicket(data)
                .then(()=>{
                    alert("Sikeres küldés!");
                    this.$router.push({
                        name: 'myUserProfile'
                    });
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