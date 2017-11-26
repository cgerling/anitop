<template>
  <div class="columns is-multiline is-mobile is-variable is-1 is-marginless">
    <anime-link v-for="anime in animes" :key="anime.id" :url="anime.url" :name="anime.name"
      class="column is-half-mobile is-one-third-tablet is-one-quarter-desktop is-one-fifth-widescreen" />
  </div>
</template>
<script>
import AnimeLink from './AnimeLink'

export default {
  name: 'AnimeList',
  components: { AnimeLink },
  props: ['animes']
}
</script>
<style scoped>
</style>
