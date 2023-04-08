<template>
        <div class="row bg-light rounded-4 mb-3 shadow p-2">
            <div class="nav-link active col-sm-11" aria-current="page"
             @click="navigate">
                <div>
                    <tag v-for="tag in content.tags" :tag="tag"></tag>
                    <p>
                        {{content.body}}
                    </p>
                </div>
            </div>

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
import DetailedContentView from '../views/DetailedContentView.vue';

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
        User,
        DetailedContentView
    },
    methods:{
        navigate(){
            this.$router.push({
                name: 'contentById',
                params: {
                    id: this.content.id,
                    content:  this.content
                },
            })
        }
    },
    mounted(){


        console.log("asd :" + this.content.creator.name);
    }
}
</script>