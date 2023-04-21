<template>
    <div class="container ">
        <div class="row bg-light shadow rounded-3 p-2">
            <div class="col text-center">
                <img src="https://placeholder.pics/svg/60" alt="">
                <p class="fs-6"></p> <!-- Insert profile picture here-->
                <p class="fs-4">{{name}}</p>
                    <Form @submit="editMyData" @keydown="triggerChange" :initial-values="initData">
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
    methods:{    
        async editMyData(values){
            NebulooFetch.editMyDatas(values)
            .then(()=>{
                alert("Sikeres változtatás");
                router.push('/myprofile')
            });
        },
        triggerChange(){
            this.isChanged = true;
        }
    },
    computed:{
        
    },
    async mounted(){
        NebulooFetch.getMyDatas()
        .then(response=>{
            this.initData.bio= response.data.bio;
            this.initData.display_name= response.data.display_name;
            this.name = response.data.name;
        })
        .catch(error=>{
            console.log(error);
        })
    }
}
    </script>