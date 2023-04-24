<template>
    <div class="container ">
        <div class="row bg-light shadow rounded-3 p-2">
            <div class="col text-center">
                <img src="https://placeholder.pics/svg/60" alt="">
                <p class="fs-6"></p> <!-- Insert profile picture here-->
                <p class="fs-4">{{name}}</p>
                    <Form @submit="editData" @keydown="triggerChange" :initial-values="initData">
                        <h2 class="text-start"><label for="bio" class="form-label mt-2">Bio:</label></h2>
                        <Field type="text" class="form-control my-3" name="bio" id="bio"/>       

                        

                        <h2 class="text-start"><label for="display_name" class="form-label mt-2">Megjelenítési név:</label></h2>
                        <Field type="text" class="form-control my-3" name="display_name" id="display_name"/>

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

export default{

    data(){
        return{
            name:'',
            initData:{
                bio:'',
                display_name:''
            },
            isChanged: false
        }
    },
    components:{
        Field, Form
    },
    props:{
        id: {
            type: Number,
            required: false
        }        
    },
    methods:{
        editData(values){
            if(UserManager.getUser().role == "admin"&&UserManager.getUser().id !=this.id){
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
        if(UserManager.getUser().id !=this.id && UserManager.getUser().role !=="admin")
        {
            alert("Nincs jogosultságod változtatásokat végezni más profilján!",router.push("/myprofile"))
        }
        else{
            NebulooFetch.getUserData(this.id)
            .then(response=>{
                this.initData.bio= response.data.bio;
                this.initData.display_name= response.data.display_name;
                this.name = response.data.name;
            })
            .catch(error=>{
                console.log(error);
            });
        }
    }
}
    </script>