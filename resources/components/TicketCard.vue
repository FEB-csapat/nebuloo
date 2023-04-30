<template>
        <div class="d-flex justify-content-between bg-light shadow rounded-3 p-2 mt-2 " id="card">
            <div class="align-items-center text-overflow text-center" style="max-width: 85px; min-width: 72px">
            <user :user="ticket.creator"/>
            </div>
            <div class="flex-fill">
                <p>
                {{ticket.body}}
            </p>
            <div class="text-end" v-if="canEditAndDelete">
                <button class="btn btn-outline-info btn-sm mx-1" @click="editTicket()" name="editcomment">
                    Megjelölés mint: "Javítva"
                </button>
                <button class="btn btn-outline-danger btn-sm mx-1" @click="deleteTicket()" name="deletecomment"> 
                    Elutasítás
                </button>
            </div>
            <h6 class="text-end">State: {{ ticket.state }}</h6>
        </div>
        
    </div>
</template>

<script>
import User from './User.vue';
import { UserManager } from '../utils/UserManager';
import { RequestHelper } from '../utils/RequestHelper';
export default{
    props:{
        ticket: Object
    },
    components:{
        User
    },
    methods:{
        async editTicket(){
            const data = JSON.stringify(this.ticketData);
            RequestHelper.editTicket(data,this.ticket.id)
            window.alert("Hibajegy sikeresen elfogadva!");
            window.location.reload();
        },
        async deleteTicket(){
            RequestHelper.deleteTicket(this.ticket.id)
            window.alert("Hibajegy sikeresen törölve!");
            window.location.reload();
        }
    },
    computed:{
        canEditAndDelete(){
            return ( UserManager.isAdmin() || UserManager.isModerator());
        },
        ticketData(){
            return{
                state:true
            }
        }
    }
}
</script>