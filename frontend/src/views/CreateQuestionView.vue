<template>
<div class="container my-3 ">
    <div class="row bg-light shadow rounded-3 p-2">
        <h1 id="title">Új kérdés feltétele</h1>
        <creation-form/>
        <div class="text-end p-2">
            <button class="btn" id="button">
                Létrehozás
            </button>
        </div>
       
    </div>
</div>
</template>

<script>
import CreationForm from '../components/CreationForm.vue';
import EasyMDE from 'easymde';

export default{
   components:{
    CreationForm
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
                'undo',
                'redo',
                '|',
                'guide',
            ],
            spellChecker: false,
            autofocus: true,
            uploadImage: true,
            imageUploadEndpoint: 'localhost:8881/api/images',
            /*
            autosave: {
                enabled: true,
                uniqueId: "MyUniqueID",
                delay: 1000,
            },
            */
        });
    },
};
</script>