<template>
    <div class="container ">
        <div class="row bg-light mt-3 mb-2 rounded-3 p-3 shadow">
            <div class="col text-center">
                

                <loading-spinner :show="isWaiting"/>
                
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
import { RequestHelper } from '../utils/RequestHelper';
import { Form ,Field } from 'vee-validate';
import router from '../router';
import { UserManager } from '../utils/UserManager';

import User from '../components/User.vue';

import LoadingSpinner from '../components/LoadingSpinner.vue';

export default{

    data(){
        return{
            initData:{
                bio:'',
                display_name:''
            },
            userData: null,
            isChanged: false,
            isWaiting: true
        }
    },
    components:{
        Field, Form, User, LoadingSpinner
    },
    props:{
        id: {
            type: Number,
            required: false
        }        
    },
    methods:{
        editData(values){
            if(UserManager.isAdmin() && !UserManager.isMine(this.id)){
                this.editProfileData(values);
            }else{
                this.editMyData(values);
            }
        },
        async editMyData(values){
            RequestHelper.editMyProfile(values)
            .then(()=>{
                alert("Sikeres változtatás");
                this.$router.push({
                    name: 'myUserProfile',
                });
            });
        },
        async editProfileData(values){
            RequestHelper.editUserData(this.id, values)
            .then(()=>{
                alert("Sikeres felülírás.");
                this.$router.push({
                    name: 'userProfile',
                    params: {
                        id: this.id    
                    },
                });
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
            alert("Nincs jogosultságod változtatásokat végezni más profilján!",
                this.$router.push({
                        name: 'myUserProfile'
            }));
        }
        else{
            this.userData = (await RequestHelper.getUserData(this.id)).data;
            this.isWaiting = false;
        }
    }
}
    </script>