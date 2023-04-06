<template>

    <router-link class="nav-link active" aria-current="page" 
    :to="{ name: 'contentById', 
        params: { 
            id: this.id,
        },
        props: { 
            content: { 
                id: this.id,
                creator_user_id: creator_user_id,
                body: body
            }
        }
    }">
        <div class="row bg-light rounded-4 mb-3 shadow p-2">
            <p>
                {{body}}
            </p>
        </div>
    </router-link>
</template>

<script>
export default{
    props:{
        id: Number,
        creator_user_id:Number,
        body:String
    },
    mounted(){
        
    }
}
</script>