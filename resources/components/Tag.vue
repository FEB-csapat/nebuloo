<template>
    <div class="col">
        <span class="badge bg-info text-dark">{{tag.name}}</span>

    </div>
</template>

<script>

export default{
    props:{

        tag: {
            type: Object,
            required: true
        },
    },
    components:{
        
    },
    mounted(){
        
    }
}
</script>