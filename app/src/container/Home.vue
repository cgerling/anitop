<template>
  <anime-list :animes="animes" />
</template>
<script>
import AnimeList from '@/components/AnimeList'
import * as animeService from '@/services/animeService'

export default {
  name: 'Home',
  components: { AnimeList },
  data () {
    return {
      animes: []
    }
  },
  methods: {
    obtainAnime () {
      animeService.obtainAll().then(({ data }) => {
        this.animes = data.animes
      })
    }
  },
  created () {
    this.obtainAnime()
  }
}
</script>
<style scoped>

</style>
