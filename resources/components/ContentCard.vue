<template>
        <div class="row bg-light rounded-4 mb-3 shadow p-2">
            <router-link class="nav-link active col-sm-11" aria-current="page" 
                :to="{ 
                    name: 'contentById', 
                    params: { 
                        id: content.id,
                    },
                    
                    props: { 
                        content: content
                    }
                    
                }"
                >
                <div>
                    <tag v-for="tag in content.tags" :tag="tag"></tag>
                    <p>
                        {{content.body}}
                    </p>
                </div>
            </router-link>

            <div class="col-sm-1">
                <user :user="content.creator"></user>

                <vote :contentId="content.id" :voteCount="10" :vote="null"></vote>

            </div>
        </div>
</template>

<script>
import Tag from './Tag.vue';
import Vote from './Vote.vue';
import User from './User.vue';

export default{
    props:{
        content: {
            type: Object,
            required: true
        },
    },
    
    components:{
        Tag,
        Vote,
        User
    },
    mounted(){


        //console.log("niggus :" + this.content.creator);
    }
}
</script>