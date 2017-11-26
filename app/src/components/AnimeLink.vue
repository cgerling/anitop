<template>
  <router-link :to="path" tag="div" class="pointer">
    <anime-poster :name="name" :url="url" />
  </router-link>
</template>
<script>
import AnimePoster from './AnimePoster'

export default {
  name: 'AnimeLink',
  components: { AnimePoster },
  props: ['id', 'name', 'url'],
  computed: {
    path () {
      return `/anime/${this.div}`
    }
  }
}
</script>
<style scoped>
.pointer {
  cursor: pointer;
}
</style>
