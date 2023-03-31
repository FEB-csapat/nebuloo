<template>
<div>
    <label for="cim" class="form-label pt-2">Cím*</label>
    <input type="text" name="cim" id="cim" class="form-control">

    <label for="leiras" class="form-label pt-2">Leírás*</label>
    <textarea ref="editor" name="leiras" id="leiras" class="form-control">

    </textarea>

    <label for="cimkek" class="form-label pt-2">Címkék hozzáadása</label>
    <input type="text" name="cimkek" id="cimkek" class="form-control">
</div>
</template>

<script>
export default{
    
}
</script>