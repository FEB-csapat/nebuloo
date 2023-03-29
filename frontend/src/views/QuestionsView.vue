<template>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Questions</h1>
        <cards :Questions="Questions"/>
    </div>
    <router-link class="nav-link active" aria-current="page" to="/create/question">
        <div class="fab-button" @click="onClick">
            <span class="m-3">Create new question</span>
            <i class="fas fa-plus fa-lg"/>
        </div>
    </router-link>
</template>

<script>
import Cards from '../components/Cards.vue'
export default{
components:{
        Cards
    },
    data(){
        return{
            Questions: []
        }
    },
    methods:{
        async getAllQuestions(){
            const headers = {'Content-Type':'application/json'}
            const resp = await fetch('http://localhost:8881/api/questions',
            {
                method: 'GET',
                headers: headers
            });
            this.Questions = await resp.json();
        }
    },
    mounted(){
        this.getAllQuestions();
    }
}
</script>