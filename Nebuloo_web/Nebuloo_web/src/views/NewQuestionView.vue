<template>
<div class="container my-3 ">
    <div class="row bg-light shadow rounded-3">
        <h1>Új kérdés feltétele</h1>
        <button class="btn" id="button">

        </button>

        <textarea ref="editor">

        </textarea>
  </div>
    <div class="row bg-light shadow rounded-3 p-2">
        <h1 id="title">Új kérdés feltétele</h1>
        <div class="text-end">
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
    mounted(){
        this.editor = new EasyMDE({
            element: this.$refs.editor,

        });
    },
};
</script>