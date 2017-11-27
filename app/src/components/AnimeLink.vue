<template>
  <router-link :to="path" tag="div" class="pointer">
    <anime-poster :name="name" :url="image" />
  </router-link>
</template>
<script>
import AnimePoster from './AnimePoster'

export default {
  name: 'AnimeLink',
  components: { AnimePoster },
  props: ['id', 'name', 'image'],
  computed: {
    path () {
      return `/anime/${this.id}`
    }
  }
}
</script>
<style scoped>
.pointer {
  cursor: pointer;
}
</style>
