<template>
  <div id="paginator" class="row mb-3 p-2">
    <nav>
      <ul class="pagination mx-auto">
        <li v-for="link in meta.links" :class="{ 'active': link.active }">
          <a class="m-1" v-if="!link.active" :href="link.url" @click.prevent="paginate(link.url)"> {{ translatedLabel(link.label) }} </a>
          <span class="m-1" v-else>{{ translatedLabel(link.label) }}</span>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  props: {
    links: Object,
    meta: Object,
  },
  methods: {
    paginate(url) {
      this.$emit('paginate', url)
    },
  },
  computed: {
    translatedLabel() {
      return (label) => {
        if (label === 'Previous') {
          return 'Előző'
        } else if (label === 'Next') {
          return 'Következő'
        } else {
          return label
        }
      }
    },
  },
}
</script>
