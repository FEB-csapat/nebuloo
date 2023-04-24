    <template>
    <div class="col" @click="navigate">
            
        <h6 v-if="user != null && user.role!=null && showDetailed
            && (user.role == 'admin' || user.role == 'moderator')"
            class="text-danger">{{user.role}}</h6>

        <img v-if="user != null" class="mx-auto border border-2 border-dark rounded shadow" :style="{ width: showDetailed ? '120px' : '60px' }" v-bind:src="profileImage" :alt="user.rank.name" :title="user.rank.name" id="profpicture"/>

        <p class="text-secondary" v-if="user != null && user.rank!=null && showDetailed">{{user.rank.name}}</p>

        <h5 v-if="user != null && showDetailed" class="mt-1">{{user.name}}</h5>
        <h6 v-else-if="user != null && !showDetailed" class="mt-1   ">{{user.name}}</h6>
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
        },
        clickable: {
            type: Boolean,
            required: false,
            default: true
        }
    },
    data(){
        return{
          //  profileImage: "../assets/images/"


        }
    },
    methods:{
        navigate(){
            if(this.clickable && this.user != null){
                this.$router.push({
                    name: 'profile',
                    params: {
                        id: this.user.id    
                    },
                })
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

    /*
    mounted(){
        if(this.user != null && this.user.rank != null){
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
    */
}
</script>

