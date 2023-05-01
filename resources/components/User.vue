<template>
    <loading-spinner v-if="user == null"/>
    <div v-else class="col text-center" @click="navigateToUserProfileView()">

        <h3  v-if="showDetailed && user.banned" class="text-danger">BANNOLVA</h3>
        <p v-if="!showDetailed && user.banned" class="text-danger text-center">BANNOLVA</p>

        <h6 v-if="user.role!=null && showDetailed
            && (user.role == 'admin' || user.role == 'moderator')"
            class="text-danger">{{user.role}}</h6>

        <img class="mx-auto border border-2 border-dark rounded shadow" :style="{ width: showDetailed ? '120px' : '60px' }" v-bind:src="profileImage" :alt="user.rank.name" :title="user.rank.name" id="profpicture"/>

        <p class="text-secondary" v-if="user.rank!=null && showDetailed">{{user.rank.name}}</p>

        <h5 v-if="showDetailed" class="mt-1">{{user.display_name ?? user.name}}</h5>
        <h6 v-else-if="!showDetailed" class="mt-1">{{user.display_name ?? user.name}}</h6>
    </div>
</template>

<script>
import zoldfulu from '../assets/images/zoldfulu.png'
import okostojas from '../assets/images/okostojas.png'
import zseni from '../assets/images/zseni.png'
import langesz from '../assets/images/langesz.png'
import bolcs from '../assets/images/bolcs.png'

import LoadingSpinner from './LoadingSpinner.vue'

export default{
    components:{
        LoadingSpinner
    },
    props:{
        user: {
            type: Object,
            required: true
        },
        showDetailed: {
            type: Boolean,
            required: false,
            default: false
        },
        clickable: {
            type: Boolean,
            required: false,
            default: true
        }
    },
    methods:{
        navigateToUserProfileView(){
            if(this.clickable && this.user != null){
                this.$router.push({
                    name: 'userProfile',
                    params: {
                        id: this.user.id    
                    },
                });
            }
        }
    },

    computed: {
        profileImage: function(){
            if(this.user != null && this.user.rank != null){
                switch( Number(this.user.rank.id) ){
                    case 1:
                        return zoldfulu;
                    case 2:
                        return okostojas;
                    case 3:
                        return zseni;
                    case 4:
                        return langesz;
                    case 5:
                        return bolcs;
                    
                    default:
                        return zoldfulu;
                }
            }else{
                return zoldfulu;
            }
        }
    },
}
</script>

