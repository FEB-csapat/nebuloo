<template>
    <div class="container my-3 ">
        <div class="row bg-light shadow rounded-3 p-2">
            <h1 id="title">Új tananyag létrehozása</h1>
    
                <div>
                    <label for="leiras" class="form-label pt-2">Leírás*</label>
                        <textarea ref="editor" name="leiras" id="leiras" class="form-control">
    
                         </textarea>
    
                    <label for="cimkek" class="form-label pt-2">Címkék hozzáadása</label>
                    <input type="text" name="cimkek" id="cimkek" class="form-control">
                </div>
    
            <div class="text-end p-3">
    
                <button class="btn" id="button">
                    Létrehozás
                </button>
    
            </div>
           
        </div>
    </div>
    
</template>

<script>
import EasyMDE from 'easymde';

export default{
    components:{

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