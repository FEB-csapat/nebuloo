<template>
<div class="container my-3 ">
        <h1 id="title">Kérdés szerkesztése</h1>
        <div class="row bg-light shadow rounded-3 p-2">
            <form @submit.prevent="Login">
                <label for="title" class="form-label mt-2">Kérdés címe:</label>
                <input id="title_field" v-model="form.title" type="text" name='title' class="form-control">

                <label for="body" class="form-label mt-2">Kérdés törzse:</label>
                <textarea name="leiras" id="leiras" v-model="form.body" rows="5" class="form-control"></textarea>
            <div class="row">
                <div class="col-sm-6">
                    <button type="submit" class="my-3 btn" id="button" @click="editQuestion()">Változtatás elfogadása</button>
                </div>
                <div class="col-sm-6 text-end">
                    <button type="submit" class="my-3 btn" id="button" @click="navigate()">
                        Vissza
                    </button>
                </div>
            </div>
            </form>
    </div>
</div>
</template>

<script>
import { NebulooFetch } from '../utils/https.mjs';
import Form from 'vform'
export default{
    data(){
        return {
            question: {},
            form: new Form({
                title: '',
                body: ''
            })
        };
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
            this.form.title = this.question.title;
            this.form.body = this.question.body;
        },
        async editQuestion(){
                const data = JSON.stringify(this.questionData);
                NebulooFetch.editQuestion(data,this.id);
            },
            navigate(){
            this.$router.push({
                name: 'questionById',
                params: {
                    id: this.question.id,
                }
            })
        },
     },
     mounted(){
        this.getDetailedQuestion();
     },
     computed:{
            questionData(){
                return{
                    title:this.form.title,
                    body:this.form.body
                }
            }
        }
}
</script>