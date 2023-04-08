<template>
        <p class="">{{tag.name}}</p>
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