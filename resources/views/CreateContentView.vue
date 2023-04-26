<template>
    <div class="container">
        <h2 class="text-center mt-3 mb-2">Új tananyag létrehozása</h2>

        <div class="row bg-light shadow rounded-3 p-2">
                <div>
                    <tag-selector @subjectItemSelected="handleSubjectItemSelected" @topicItemSelected="handleTopicItemSelected"
                    :defaultSubjectId="subjectId" :defaultTopicId="topicId"
                    ref="tagSelector"/>

                    <textarea ref="editor" name="leiras" id="leiras" class="form-control mt-2"></textarea>
                </div>
    
            <div class="text-end p-3">
                <button class="btn" id="button" @click="createContent()">
                    Létrehozás
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import EasyMDE from 'easymde';
import { RequestHelper } from '../utils/RequestHelper';
import TagSelector from '../components/TagSelector.vue';

export default{
    components:{
        TagSelector,
    },
    data(){
        return{
            body: '',
            subjectId: null,
            topicId: null,
        }
    },
    methods:{
        async createContent(){
            const body = this.editor.value();
            if(body == ""){
                // TODO: handle error properly
                alert("A poszt nem lehet üres!");
                return;
            }
            var response = (await RequestHelper.createContent(body, this.subjectId, this.topicId));

            if(response.status == 201){
                this.$router.push({ name: 'contentById', params:  {id: response.data.id} })
            }else{
                // TODO: handle error properly
                alert("Hiba történt a poszt létrehozása közben!");
            }
        }, 

        handleSubjectItemSelected(subjectId) {
            this.subjectId = subjectId;
        },
        handleTopicItemSelected(topicId) {
            this.topicId = topicId;
        },
    },
    mounted(){
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
    },
};
</script>