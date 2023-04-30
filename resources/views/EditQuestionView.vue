<template>
<div class="container my-3 ">
    <h1 class="text-center mb-4">Kérdés szerkesztése</h1>
    <div class="row bg-light shadow rounded-3 p-2">

        <loading-spinner :show="isWaiting"/>

        <tag-selector v-if="!isWaiting" @subjectItemSelected="handleSubjectItemSelected" @topicItemSelected="handleTopicItemSelected"
                :defaultSubjectId="subjectId" :defaultTopicId="topicId"
                ref="tagSelector" name="questionupdatetagselector"/>

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
                <button type="submit" class="my-3 btn" id="button" name="questionupdatesave" @click="updateQuestion()">Változtatás elfogadása</button>
            </div>
        </div>
    </div>
    <SnackBar ref="snackBar"/>
</div>
</template>

<script>
import { RequestHelper } from '../utils/RequestHelper';
import SnackBar from '../components/snackbars/SnackBar.vue';
import { UserManager } from '../utils/UserManager';
import TagSelector from '../components/TagSelector.vue';
import LoadingSpinner from '../components/LoadingSpinner.vue';

export default{
    components:{
        SnackBar,
        TagSelector,
        LoadingSpinner
    },
    data(){
        return {
            question: null,

            title:"",
            body:"",
            subjectId: null,
            topicId: null,
            isWaiting: true
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
            var responseBody = (await RequestHelper.getDetailedQuestion(this.id)).data;
            this.question = responseBody
            this.title = this.question.title;
            this.body = this.question.body;
            this.subjectId = this.question.subject?.id;
            this.topicId = this.question.topic?.id;

        },
        async updateQuestion(){
            console.log(this.body);
            if(this.body==""){
                alert("A poszt nem lehet üres!");
                return;
            }

            var response = (await RequestHelper.updateQuestion(this.question.id, this.title, this.body, this.subjectId, this.topicId));

            if(response.status == 200){
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
        this.isWaiting = false;
        if(!UserManager.isMine(this.question.creator.id) && !UserManager.isAdmin()){
            alert("Nincs engedélyed ennek a tartalomnak a szerkeztéséhez!",router.back())
        }
    }
}
</script>