<template>
    <router-link aria-current="page" 
        :to="{ name: 'myprofile', 
            params: { 
                id: user.id
            },
            
            props: { 
                user: user
            }
        }" 
        :user="user"
        >
        <div class="col">
            <img class="mx-auto" src="https://placeholder.pics/svg/35" alt="">
            <p class="text-center">{{user.name}}</p>
        </div>
    </router-link>
</template>

<script>

export default{
    props:{
        user: {
            type: Object,
            required: true
        },
    },
    mounted(){
       // console.log(this.user);
    }
}
</script>

