<template>
  <div>
    <anime-list :animes="animes" />
    <message :text="message" v-if="animes.length == 0" />
  </div>
</template>
<script>
import AnimeList from '../components/AnimeList'
import Message from '../components/Message'

import * as animeService from '../services/animeService.js'

export default {
  name: 'Watchlist',
  components: { AnimeList, Message },
  data () {
    return {
      animes: [],
      message: 'Você ainda não adicionou animes à esta lista.'
    }
  },
  created () {
    animeService.obtainWatchlist().then(({ data }) => {
      this.animes = data.watchlist
    })
  }
}
</script>
<style scoped>
</style>
