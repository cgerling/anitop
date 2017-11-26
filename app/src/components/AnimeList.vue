<template>
  <div class="columns is-multiline is-mobile is-variable is-1 is-marginless">
    <anime-poster class="column is-half" v-for="anime in animes" :key="anime.id" :url="anime.url" :name="anime.name" />
  </div>
</template>
<script>
import AnimePoster from './AnimePoster'

export default {
  name: 'anime-list',
  components: { AnimePoster },
  props: ['animes']
}
</script>
<style scoped>
</style>
