<template>
<div class="container my-3 ">
    <h1 class="text-center mb-4">Kérdés szerkesztése</h1>
    <div class="row bg-light shadow rounded-3 p-2">
        
        <tag-selector @subjectItemSelected="handleSubjectItemSelected" @topicItemSelected="handleTopicItemSelected"
                :defaultSubjectId="subjectId" :defaultTopicId="topicId"
                ref="tagSelector"/>

        <label for="cim" class="form-label pt-2">Cím*</label>
        <input type="text" id="cim" v-model="title" class="form-control">

        <label for="leiras" class="form-label pt-2">Leírás</label>
        <textarea name="leiras" id="leiras" v-model="body" rows="5" class="form-control"></textarea>

        <div class="row">
            <div class="col-sm-6">
                <button class="my-3 btn" id="button" @click="navigateToDetailedView()">
                    Vissza
                </button>
            </div>
            <div class="col-sm-6 text-end">
                <button type="submit" class="my-3 btn" id="button" @click="updateQuestion()">Változtatás elfogadása</button>
            </div>
        </div>
    </div>
    <SnackBar ref="snackBar"/>
</div>
</template>

<script>
import { NebulooFetch } from '../utils/https.mjs';
import SnackBar from '../components/snackbars/SnackBar.vue';
import { UserManager } from '../utils/UserManager';
import TagSelector from '../components/TagSelector.vue';


export default{
    components:{
        SnackBar,
        TagSelector
    },
    data(){
        return {
            question: {},

            title:'',
            body:'',
            subjectId: null,
            topicId: null
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
            this.title = this.question.title;
            this.body = this.question.body;
            this.subjectId = this.question.subject.id;
            this.topicId = this.question.topic.id;

        },
        async updateQuestion(){

            var response = (await NebulooFetch.updateQuestion(this.question.id, this.title, this.body, this.subjectId, this.topicId));

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
        handleSubjectItemSelected(subjectId) {
            this.subjectId = subjectId;
        },
        handleTopicItemSelected(topicId) {
            this.topicId = topicId;
        },
    },
    async mounted(){
        await this.getDetailedQuestion();
        if(this.question.creator.id!=UserManager.getUser().id && UserManager.getUser().role !="admin"){
            alert("Nincs engedélyed ennek a tartalomnak a szerkeztéséhez!",router.back())
        }
    }
}
</script>