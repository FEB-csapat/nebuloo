<template>
  <div class="row mb-3 p-2">
    <nav>
      <ul class="pagination mx-auto">
        <li v-for="link in meta.links" :class="{ 'active': link.active }">
          <a class="m-1" v-if="!link.active" :href="link.url" @click.prevent="paginate(link.url)"> {{ link.label }} </a>
          <span class="m-1" v-else>{{ link.label }}</span>
        </li>
        
      </ul>
    </nav>
    
  </div>
  </template>
  
<script>
export default {
    props: {
        links: Object,
        meta: Object
    },
    methods: {
        paginate(url) {
            this.$emit('paginate', url)
        }
    }
}
</script>
  