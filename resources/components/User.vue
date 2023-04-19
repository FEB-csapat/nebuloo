<template>
    <div class="col" @click="navigate">
        <img class="mx-auto" style="width: 60px;" v-bind:src="profileImage" alt="Betöltés..." id="profpicture">
        <p v-if="user != null">{{user.name}}</p>
        <p v-else>Betöltés...</p>
    </div>
</template>

<script>
import zoldfulu from '../assets/images/zoldfulu.png'
import okostojas from '../assets/images/okostojas.png'
import zseni from '../assets/images/zseni.png'
import langesz from '../assets/images/langesz.png'
import bolcs from '../assets/images/bolcs.png'

export default{
    props:{
        user: {
            type: Object,
            required: true
        },
    },
    data(){
        return{
            profileImage: "../assets/images/"
        }
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
        console.log( "asd, " +  this.user.rank.id);
        switch(this.user.rank.id){
            case 1:
                this.profileImage = zoldfulu;
                break;
            case 2:
                this.profileImage = okostojas;
                break;
            case 3:
                this.profileImage = zseni;
                break;
            case 4:
                this.profileImage = langesz;
                break;
            case 5:
                this.profileImage = bolcs;
                break;
        }
    }
}
</script>

