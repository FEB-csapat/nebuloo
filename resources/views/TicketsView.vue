<template>
    <h1 class="text-center mt-4">
        Felhasználói jelentések:
    </h1>
    <loading-spinner :show="isWaiting"/>
    <div class="container mt-4">
        <ticket-card v-for="ticket in tickets" :ticket="ticket" :key="ticket.id"/>
    </div>
    <SnackBar ref="snackBar"/>
</template>

<script>

import { RequestHelper } from '../utils/RequestHelper';
import { UserManager } from '../utils/UserManager';
import TicketCard from '../components/TicketCard.vue';
import LoadingSpinner from '../components/LoadingSpinner.vue';
import SnackBar from '../components/snackbars/SnackBar.vue';
export default{
    data(){
        return{
            tickets:[],
            isWaiting: true,
        }
    },
    components:{
        TicketCard,
        LoadingSpinner,
        SnackBar
    },
    methods:{
        async getAllTickets(){
            this.isWaiting = true;
            if(!UserManager.isLoggedIn())
            {
                this.$refs.snackBar.showSnackbar('Jelentések megtekintéséhez, kérlek jelentkezz be!', 'Bejelentkezés', function () {
                    this.$router.push({name: 'login'});
                });
            }
            else if(!UserManager.isAdmin() || !UserManager.isModerator()){
                this.$refs.snackBar.showSnackbar('Jelentések megtekintéséhez, megfelelő jogosultsággal kell rendelkeznie!', 'Bejelentkezés', function () {
                    this.$router.push({name: 'login'});
                });
            }   
            else{
                var responseBody = (await RequestHelper.getAllTickets()).data;
                this.tickets = responseBody.data;
                this.isWaiting = false;
            }
        },
    },
    mounted(){
        this.getAllTickets();
    }
}
</script>