
<template>
    
    <router-link class="nav-link active" aria-current="page"
     :to="{ name: 'questionById', 
     params: { id: this.question.id }, 
     props: {question: this.question} }">
     
        <div class="row bg-light rounded-4 mb-3 shadow">
            <h2>{{question.title}}</h2>
            <p>
                {{question.body}}
            </p>
            <div class="m-2">
        
            </div>
        </div>
    </router-link>
</template>

<script>
export default{
    props:{
        question: {
            type: Object,
            required: true
        }
        /*
        id: Number,
        creator_user_id: Number,
        title: String,
        body:String
        */
    },
    mounted(){
    }
}
</script>