<template>
    <div class="row ">
        <div class="col" @click="navigate">
            <h6 v-if="user != null && user.roles!=null && showDetailed">{{user.roles[0]}}</h6>
    
            <img v-if="user != null" class="mx-auto border rounded shadow" :style="{ width: showDetailed ? '120px' : '60px' }" v-bind:src="profileImage" :alt="user.rank.name" :title="user.rank.name" id="profpicture">
            
            <p class="text-secondary" v-if="user != null && user.rank!=null && showDetailed">{{user.rank.name}}</p>
    
            <h5 v-if="user != null">{{user.name}}</h5>
            <p v-else>Betöltés...</p>
        </div>
    
        <div v-if="showDetailed" class="">
            <i style="color:gray;" :class="['fas', 'fa-up-long', 'fa-lg']"/>
            <p id="votecount" class="pt-3  ml-2 text-center">{{user.recieved_votes}}</p>
            <i style="color:gray;" :class="['fas', 'fa-down-long', 'fa-lg']"/>
        </div>
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
        showDetailed: {
            type: Boolean,
            required: false,
            default: false
        }
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
        if(this.user == null && this.user.rank == null){
            return;
        }
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

