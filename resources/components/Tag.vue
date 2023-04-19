<template>
    <span class="badge m-1 bg-info text-dark p-2">{{tag.name}}</span>
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