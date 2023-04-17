<template>
    <div class="container my-3 ">
        <div class="row bg-light shadow rounded-3 p-2">
            <h1 id="title">Új kérdés feltétele</h1>
            <div>
                <label for="cim" class="form-label pt-2">Cím*</label>
                <input type="text" id="cim" v-model="title" class="form-control">

                <label for="leiras" class="form-label pt-2">Leírás*</label>
                <textarea name="leiras" id="leiras" v-model="body" rows="5" class="form-control"></textarea>

                <label for="cimkek" class="form-label pt-2">Címkék hozzáadása</label>
                    <input type="text" name="cimkek" id="cimkek" class="form-control">
            </div>
            <div class="text-end p-2">
                <button class="btn" id="button" @click="NewQuestion()">
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
                title:"",
                body:"",
            }
        },
        methods:{
            async NewQuestion(){
                const data = JSON.stringify(this.question);
                NebulooFetch.createQuestion(data)
                .then(()=>{
                    alert("Sikeres létrehozás!");
                    router.push('/myprofile');
                });
            }
        },
        mounted(){
            
        },
        computed:{
            question(){
                return{
                    title:this.title,
                    body:this.body
                }
            }
        }
    };
    </script>