<template>
    <h5>TODO: align tag items at the left side</h5>
    <div class="row mb-1 align-items-end">
        <div class="col">
            <label for="search" class="form-label">Tantárgy:</label>
            <select id="subject-selector" class="form-select" style="width:160px;" v-model="subject" @change="subjectItemSelected()">
                <option v-for="subj in subjects" :key="subj.id" :value="subj">{{ subj.name }}</option>
            </select>
        </div>


        <div v-if="subject != null" class="col">
            <i style="color:gray; margin-bottom: 12px" :class="['fas', 'fa-right-long', 'fa-lg',]"/>
        </div>

        <div v-if="subject != null" class="col">
            <div class="row align-items-start">
                
    
                <div class="col">
                    <label for="" class="form-label">Témakör:</label>
                    <select id="topic-selector" class="form-select" style="width:160px" v-model="topic" @change="topicItemSelected()">
                        <option v-for="top in topics" :key="top.id" :value="top">{{ top.name }}</option>
                    </select>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import Tag from './Tag.vue';
import { NebulooFetch } from '../utils/https.mjs';

export default{
    components:{
        Tag
    },
    data(){
        return{
            subject: null,
            subjects: [],

            topic: null,
            topics: [],
        }
    },
    props:{
        defultSubjectId: {
            type: Number,
            default: null,
            required: false
        },
        defaultTopicId: {
            type: Number,
            default: null,
            required: false
        }
    },
    methods:{
        async getSubjectsAndTopics(){

            this.isWaiting = true;
            this.subjects = [];
            
            this.subjects = (await NebulooFetch.getSubjects()).data;

            this.isWaiting = false;

            if(this.defultSubjectId != null){
                this.subject = this.subjects.find(subj => subj.id == this.defultSubjectId);
                this.topics = this.subject.topics;
            }
            if(this.defaultTopicId != null){
                this.topic = this.topics.find(top => top.id == this.defaultTopicId);
            }

            
        },
        subjectItemSelected(){
            this.topics = this.subject.topics;
            this.$emit('subjectItemSelected', this.subject.id);
        },
        topicItemSelected(){
            this.$emit('topicItemSelected', this.topic.id);
        },
        reset(){
            this.subject = null;
            this.topic = null;
        }
    },
    mounted(){
        this.getSubjectsAndTopics();
    }
}
</script>


<style>
#subject-selector{
    background-color: rgb(199, 247, 199);
    border-color: darkgreen;
    border-radius: 10px;
    border-width: 3px;
    font-weight: bold;

}

#topic-selector{
    background-color: rgb(194, 227, 241);
    border-color: rgb(0, 60, 139);
    border-radius: 10px;
    border-width: 3px;
    font-weight: bold;
}
</style>
