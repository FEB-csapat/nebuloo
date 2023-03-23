<template>
<div class="container my-3 ">
    <div class="row bg-light shadow rounded-3 p-2">
        <h1 id="title">Új tananyag létrehozása</h1>
        <div class="text-end">
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
                'image',
                '|',
                'preview',
                'side-by-side',
                'fullscreen',
                '|',
                'guide',
                '|',
                'code',
                'clean-block',
                'upload-image',
                'table',
                'horizontal-rule',
                'undo',
                'redo',
            ],
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