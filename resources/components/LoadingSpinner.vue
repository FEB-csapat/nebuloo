<template>
    <div class="row" v-if="show">
        <div id="loading-spinner" class="spinner-border mx-auto m-3" role="status"/>
    </div>
</template>

<script>

export default{
    props:{
        show: {
            type: Boolean,
            required: true,
        },
    },
}
</script>
