<template>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <h2 id="title">Nebuloo</h2>
            <p>
                Várakozás a bejelentkezésre...
            </p>
            <p>user: {{user}}</p>
        </div>
        
    </div>
</div>
</template>
<script>
export default{
    props(){
        return{
            user: Object,
        }
    }
}
</script>