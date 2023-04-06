<template>
    <div class="container my-3 ">
        <h1 id="title">Kérdés megtekintése</h1>
        <div class="row bg-light shadow rounded-3 p-2">
            
            <h2>{{question.title}}</h2>

            <p>{{question.body}}</p>

        </div>


        <div class="row bg-light shadow rounded-3 p-2">
            
            <p>Comment</p>

        </div>

        <CommentSection :commentable_id="question.id" :commentable_type="'questions'"/>


    </div>
    
</template>

<script>

export default{
    components:{
        CommentSection: () => import('../components/CommentSection.vue'),
    },
    props:{
        question: {
            type: Object,
            required: true
        }
        
    },
    components:{

    },
    mounted(){
        console.log("asd asd " + this.question.id);
    },
};
</script>

