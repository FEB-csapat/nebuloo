<template>
    <div class="col" @click="navigate">
        <img class="mx-auto" src="https://placeholder.pics/svg/35" alt="" id="profpicture">
        <p v-if="user != null">{{user.name}}</p>
        <p v-else>Betöltés...</p>
    </div>
</template>

<script>

export default{
    props:{
        user: {
            type: Object,
            required: true
        },
    },
    methods:{
        navigate(){
            if(this.user != null){
                this.$router.push({
                    name: 'myprofile',
                    params: {
                        id: this.user.id
                    },
                })
            }
        }
    },
    mounted(){
        
    }
}
</script>

