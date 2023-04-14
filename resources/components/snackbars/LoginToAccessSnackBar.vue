<template>
    <SnackBar ref="snackBar" 
      :message="'A funkció használatához be kell jelentkezni.'"
      :buttonText="Bejelentkezés" @onClick="onClick()"/>
</template>

<script>
import SnackBar from '../components/snackbars/SnackBar.vue';

export default{
    components: {
        SnackBar
    },
    methods:{
        showSnackbar() {
            this.$refs.snackBar.showSnackbar();
        },
        onClick(){
          router.push('login')
        }
    },
};
</script>
