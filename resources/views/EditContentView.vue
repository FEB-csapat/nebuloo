<template>
    <div class="container my-3 ">
        <div class="row bg-light shadow rounded-3 p-2">
            <h1>Tananyag szerkesztése</h1>
            <div v-if="isWaiting" id="loading-spinner" class="spinner-border mx-auto" role="status"></div>
                <div>
                    <tag-selector v-if="!isWaiting" @subjectItemSelected="handleSubjectItemSelected" @topicItemSelected="handleTopicItemSelected"
                    :defaultSubjectId="subjectId" :defaultTopicId="topicId"
                    ref="tagSelector" name="contentupdatetagselector"/>

                    <textarea ref="editor" name="leiras" id="leiras" class="form-control"></textarea>
                </div>
            <div class="text-end p-3">
                <button class="btn nebuloobutton" @click="editContent()" name="contentupdatesave">
                    Változtatások mentése
                </button>
            </div>
        </div>
    </div>
    
</template>

<script>
import EasyMDE from 'easymde';
import { RequestHelper } from '../utils/RequestHelper';
import { UserManager } from '../utils/UserManager';
import router from '../router';

import TagSelector from '../components/TagSelector.vue';

export default{
    components:{
        TagSelector,
    },
    data(){
        return{
            body:'',
            subjectId: null,
            topicId: null,
            isWaiting: true
        }
    },
    props:
    {
        id: {
            type: Number,
            required: true
        } 
    },
    methods:{
        async editContent(){
            const body = this.editor.value();
            if(body==""){
                alert("A poszt nem lehet üres!")
            }

            RequestHelper.updateContent(this.id, body, this.subjectId, this.topicId)
            .then(response=>{
                alert("Sikeres szerkesztés!",this.$router.push({name: 'contentById', params:{id: response.data.id}}))
            })
            .catch(error=>{
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
        this.editor = new EasyMDE({
            element: this.$refs.editor,
            
            toolbar: [
                'bold',
                'italic',
                'heading',
                '|',
                'quote',
                'unordered-list',
                'ordered-list',
                '|',
                'link',
                'upload-image',
                '|',
                'preview',
                'side-by-side',
                'fullscreen',
                
                '|',
                
                'horizontal-rule',
                'undo',
                'redo',
                '|',
                'guide',
            ],
            spellChecker: false,
            placeholder: "Ide írj...",                
            autofocus: true,
            uploadImage: true,
            previewImagesInEditor: true,
            imageUploadFunction: function (file, onSuccess, onError) {

                RequestHelper.uploadImage(file)
                .then(function (response) {
                    if (response.status == 201) {
                        return response.data;
                    } else {
                        throw new Error("Kép feltöltése sikertelen!");
                    }
                })
                .then(function (data) {
                    onSuccess(data.url);
                })
                .catch(function (error) {
                    onError(error.message);
                });
            },
        });

        const response = (await RequestHelper.getDetailedContent(this.id));
        

        if(!UserManager.isMine(response.data.creator.id) && !UserManager.isModerator() && !UserManager.isAdmin()){
            alert("Nincs engedélyed ennek a tartalomnak a szerkeztéséhez!",router.back())
        }

        if (response.status == 200) {
            this.subjectId = response.data.subject?.id;
            this.topicId = response.data.topic?.id;
            this.editor.value(response.data.body);
            // set the focus to the end of text
            this.editor.codemirror.setCursor(this.editor.codemirror.lineCount(), 0);
        } else {
            alert("Hiba történt a tartalom betöltése közben!",router.back())
        }

        this.isWaiting = false;
    }
}
</script>
