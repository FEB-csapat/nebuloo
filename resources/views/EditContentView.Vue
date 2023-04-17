<template>
    <div class="container my-3 ">
        <div class="row bg-light shadow rounded-3 p-2">
            <h1 id="title">Új tananyag létrehozása</h1>
                <div>
                    <textarea ref="editor" name="leiras" id="leiras" class="form-control"></textarea>    
                    <label for="cimkek" class="form-label pt-2">Címkék hozzáadása</label>
                    <input type="text" name="cimkek" id="cimkek" class="form-control">
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
import { NebulooFetch } from '../utils/https.mjs';

export default{
    data(){
        return{
            body:''
        }
    },
    props:
    {
        id: {
            type: Number,
            required: true
        } 
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

                NebulooFetch.uploadImage(file)
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
            /*
            autosave: {
                enabled: true,
                uniqueId: "MyUniqueID",
                delay: 1000,
            },
            */
        });

        NebulooFetch.getDetailedContent(this.id);
    }
}
</script>
