<template>
<div class="container my-3 ">
    <h1 class="text-center mb-4">Kérdés szerkesztése</h1>
    <div class="row bg-light shadow rounded-3 p-2">
        <Form @submit="editQuestion" :initial-values="initData">
            <label for="title" class="form-label mt-2">Kérdés címe:</label>
            <Field id="title" type="text" name='title' class="form-control"/>

            <label for="body" class="form-label mt-2">Kérdés törzse:</label>
            <Field name="body" id="body" type="text" rows="8" class="form-control"/>
            <div class="row">
                <div class="col-sm-6">
                    <button class="my-3 btn" id="button" @click="navigateToDetailedView()">
                        Vissza
                    </button>
                </div>
                <div class="col-sm-6 text-end">
                    <button type="submit" class="my-3 btn" id="button">Változtatás elfogadása</button>
                </div>
            </div>
        </Form>
    </div>
    <SnackBar ref="snackBar"/>
</div>
</template>

<script>
import { NebulooFetch } from '../utils/https.mjs';
import SnackBar from '../components/snackbars/SnackBar.vue';
import {Form, Field} from 'vee-validate'
import { UserManager } from '../utils/UserManager';

export default{
    components:{
        SnackBar
    },
    data(){
        return {
            question: {},
            initData:{
                title:'',
                body:''
            },
        };
    },
    components:{
        Field, Form
    },
    props:{
    id: {
        type: Number,
            required: true
        }
    },
    methods:{
        async getDetailedQuestion(){
            var responseBody = (await NebulooFetch.getDetailedQuestion(this.id)).data;
            this.question = responseBody
            this.initData.title = this.question.title;
            this.initData.body = this.question.body;
        },
        async editQuestion(values){
            var response = (await NebulooFetch.editQuestion(values,this.id));

            if(response.status == 200){
               // this.$router.push('/questions/'+id);
                alert("Sikeres szerkesztés!");
                this.navigateToDetailedView();
            }else{
                this.$refs.snackBar.showSnackbar('Sikertelen szerkesztés', null, function () {
                    console.log('callback');
                });
            }
        },
        navigateToDetailedView(){
            this.$router.push({
                name: 'questionById',
                params: {
                    id: this.question.id,
                }
            })
        },
    },
    async mounted(){
        await this.getDetailedQuestion();
        if(this.question.creator.id!=UserManager.userID()&&!UserManager.userRole()=="admin"){
            alert("Nincs engedélyed ennek a tartalomnak a szerkeztéséhez!",router.back())
        }
    }
}
</script>