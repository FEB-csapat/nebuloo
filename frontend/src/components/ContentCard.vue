<template>
        <div class="row bg-light rounded-4 mb-3 shadow">
            <p>
                {{body}}
            </p>
            <div class="m-2">
                
            </div>
        </div>
</template>

<script>
 export default{
    props:{
        id: Number,
        creator_user_id:Number,
        body:Text
    }
 }
</script>