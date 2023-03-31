<template>
<div class="container my-3">
    <div class="row bg-light shadow rounded-3 p-2">
        <h1 id="title">
            Hibajegy küldése
        </h1>
<form action="">
    <label for="title" class="form-label">
        Hibajegy címe*
    </label>
    <input type="text" class="form-control">
    Probléma leírása*
    <label for="description" class="form-label"></label>
    <textarea class="form-control" id="description" rows="4"></textarea>
    <h2>Kép feltöltése</h2>
    <h6>Nyomja meg a “Fájl kiválasztása” gombot, egy fájl feltöltéséhez</h6>
    <input class="form-control" type="file" id="images" multiple>
</form>
    </div>
</div>

</template>
<script>

</script>