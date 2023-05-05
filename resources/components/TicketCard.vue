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
                <button class="btn btn-info btn-sm mx-1" @click="AcceptTicket()" name="acceptticket" v-if="isOpen">
                    Megjelölés mint: "Javítva"
                </button>
                <button class="btn btn-warning btn-sm mx-1" @click="ReopenTicket()" name="reopenticket" v-if="!isOpen">
                    Hibajegy újranyitása
                </button>
                <button class="btn btn-danger btn-sm mx-1" @click="deleteTicket()" name="denyticket"> 
                    Elutasítás
                </button>
            </div>


            <div class="row justify-content-start align-items-center me-1">
                <div class="col">
                    <h6 class="text-end m-1">Állapot: </h6>
                </div>
                    <span style="width: 90px" :class="['badge', 'm-1', 'p-2', 'fs-6', {'bg-green': !isOpen, 'bg-blue': isOpen}]">{{ this.state }}</span>
            </div>
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
            RequestHelper.editTicket(true, this.ticket.id)
            window.alert("Hibajegy sikeresen elfogadva!");
            this.isOpen=true;
            window.location.reload();
        },
        async ReopenTicket(){
            RequestHelper.editTicket(false, this.ticket.id)
            window.alert("Hibajegy sikeresen újranyitva!");
            this.isOpen=false;
            window.location.reload();
        },
        async deleteTicket(){
            RequestHelper.deleteTicket(this.ticket.id)
            window.alert("Hibajegy sikeresen törölve!");
            window.location.reload();
        },
    },
    computed:{
        canEditAndDelete(){
            return ( UserManager.isAdmin() || UserManager.isModerator());
        },
    },
    mounted(){
        this.isOpen = this.ticket.state==0;
        if (this.isOpen) {
            this.state = "Várakozik"
        }
        else{
            this.state = "Javítva";
        }
    }
}
</script>