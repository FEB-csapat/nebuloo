<template>
        <div class="d-flex justify-content-between bg-light shadow rounded-3 p-2 mt-2 ticketcard" id="card">
            <div class="align-items-center text-overflow text-center" style="max-width: 85px; min-width: 72px">
            <user :user="ticket.creator"/>
            </div>
            <div class="flex-fill">
                <p>
                {{ticket.body}}
            </p>
            <div class="text-end" v-if="canEditAndDelete">
                <button class="btn btn-outline-info btn-sm mx-1" @click="AcceptTicket()" name="acceptticket" v-if="isOpen">
                    Megjelölés mint: "Javítva"
                </button>
                <button class="btn btn-outline-warning btn-sm mx-1" @click="ReopenTicket()" name="reopenticket" v-if="!isOpen">
                    Hibajegy újranyitása
                </button>
                <button class="btn btn-outline-danger btn-sm mx-1" @click="deleteTicket()" name="denyticket"> 
                    Elutasítás
                </button>
            </div>
            <h6 class="text-end m-1">Állapot: {{ this.state }}</h6>
        </div>
        
    </div>
</template>

<script>
import User from './User.vue';
import { UserManager } from '../utils/UserManager';
import { RequestHelper } from '../utils/RequestHelper';
export default{
    data(){
        return{
            state:"",
            isOpen:false
        }
    },
    props:{
        ticket: Object
    },
    components:{
        User
    },
    methods:{
        async AcceptTicket(){
            const data = JSON.stringify(this.ticketAcceptData);
            RequestHelper.editTicket(data,this.ticket.id)
            window.alert("Hibajegy sikeresen elfogadva!");
            this.isOpen=true;
            window.location.reload();
        },
        async ReopenTicket(){
            const data = JSON.stringify(this.ticketReopenData);
            RequestHelper.editTicket(data,this.ticket.id)
            window.alert("Hibajegy sikeresen újranyitva!");
            this.isOpen=false;
            window.location.reload();
        },
        async deleteTicket(){
            RequestHelper.deleteTicket(this.ticket.id)
            window.alert("Hibajegy sikeresen törölve!");
            window.location.reload();
        },
        
        ticketState(){
            if (this.ticket.state==0) {
                this.state = "Várakozik"
                this.isOpen = true;
            }
            else{
                this.state = "Javítva";
                this.isOpen = false;
            }
        },
    },
    computed:{
        canEditAndDelete(){
            return ( UserManager.isAdmin() || UserManager.isModerator());
        },
        ticketAcceptData(){
            return{
                state:true
            }
        },
        ticketReopenData(){
            return{
                state:false
            }
        },
    },
    mounted(){
        this.ticketState();
    }
}
</script>