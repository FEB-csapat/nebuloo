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

        });
    },
};
</script>