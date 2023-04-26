<template>
    <div class="container ">
        <div class="row bg-light mt-3 mb-2 rounded-3 p-3 shadow">
            <div class="col text-center">
                <user v-if="userData!=null" :user="userData" v-bind:showDetailed="true"></user> 
                
                
                <Form v-if="userData!=null" @submit="editData" @keydown="triggerChange" :initial-values="userData">

                    <h3 class="text-start"><label for="display_name" class="form-label mt-2">Megjelenítési név:</label></h3>
                    <Field type="text" class="form-control my-3" name="display_name" id="display_name"/>


                    <h3 class="text-start"><label for="bio" class="form-label mt-2">Bio:</label></h3>
                    <Field type="text" class="form-control my-3" name="bio" id="bio"/>

                    <button class="btn btn-success" type="submit" v-if="isChanged">Elmentés</button>
                </Form>
            </div>
        </div>
    </div>
</template>
<script>
import { NebulooFetch } from '../utils/https.mjs';
import { Form ,Field } from 'vee-validate';
import router from '../router';
import { UserManager } from '../utils/UserManager';

import User from '../components/User.vue';

export default{

    data(){
        return{
            initData:{
                bio:'',
                display_name:''
            },
            userData: null,
            isChanged: false
        }
    },
    components:{
        Field, Form, User
    },
    props:{
        id: {
            type: Number,
            required: false
        }        
    },
    methods:{
        editData(values){
            if(UserManager.isAdmin() && UserManager.getUser().id !=this.id){
                this.editProfileData(values);
            }else{
                this.editMyData(values);
            }
        },
        async editMyData(values){
            NebulooFetch.editMyDatas(values)
            .then(()=>{
                alert("Sikeres változtatás");
                router.push('/myprofile')
            });
        },
        async editProfileData(values){
            NebulooFetch.editUserData(values,this.id)
            .then(()=>{
                alert("Sikeres felülírás.");
                router.push('/profile/'+this.id)
            })
            .catch(error=>{
                console.log(error)
            })
        },
        triggerChange(){
            this.isChanged = true;
        }
    },
    computed:{
        
    },
    async mounted(){
        if(UserManager.getUser()?.id != this.id && !UserManager.isAdmin)
        {
            alert("Nincs jogosultságod változtatásokat végezni más profilján!",router.push("/myprofile"))
        }
        else{
            this.userData = (await NebulooFetch.getUserData(this.id)).data;
        }
    }
}
    </script>