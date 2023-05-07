<template>
<div class="container">
    <h2 class="text-center mt-3 mb-2">Új kérdés létrehozás</h2>

    <div class="row bg-light shadow rounded-3 p-2">
        <div>
            <tag-selector @subjectItemSelected="handleSubjectItemSelected" @topicItemSelected="handleTopicItemSelected"
                :defaultSubjectId="subjectId" :defaultTopicId="topicId"
                ref="tagSelector"/>

            <label for="cim" class="form-label pt-2">Cím*</label>
            <input type="text" id="cim" v-model="title" class="form-control" name="cim">

            <label for="leiras" class="form-label pt-2">Leírás</label>
            <textarea name="leiras" id="leiras" v-model="body" rows="5" class="form-control"></textarea>

        </div>
        <div class="text-end p-2">
            <button class="btn nebuloobutton" name="createquestion" @click="createQuestion()">
                Létrehozás
            </button>
        </div>
    </div>
</div>
</template>

<script>
import { RequestHelper } from '../utils/RequestHelper';
import TagSelector from '../components/TagSelector.vue';

export default{
    components:{
        TagSelector,
    },
    data(){
        return{
            title:"",
            body:"",
            subjectId: null,
            topicId: null,
        }
    },
    methods:{
        async createQuestion(){
            if(this.body==""){
                alert("A leírás nem lehet üres!");
                return;
            }
            RequestHelper.createQuestion(this.title, this.body, this.subjectId, this.topicId)
            .then(()=>{
                alert("Sikeres létrehozás!");
                this.$router.push({
                    name: 'myUserProfile',
                });
            });            
        },
        handleSubjectItemSelected(subjectId) {
            this.subjectId = subjectId;
        },
        handleTopicItemSelected(topicId) {
            this.topicId = topicId;
        },
    },
    mounted(){
        
    },
};
</script>