<template>
    
    <span :class="['badge', 'm-1', 'p-2', {'bg-green': subject, 'bg-yellow': topic}]">{{ text }}</span>
</template>

<script>

export default{
    props:{
        subject: {
            type: Object,
            required: false
        },
        topic: {
            type: Object,
            required: false
        },
    },
    data(){
        return{
            text: ""
        }
    },
    components:{
        
    },
    mounted(){
        if(this.subject != null){
            this.text = this.subject.name;
        }
        else if(this.topic != null){
            this.text = this.topic.name;
        }
    }
}
</script>

<style>
.bg-green {
    color: black;
    background-color: green;
}

.bg-yellow {
    color: black;
    background-color: steelblue;
}
</style>