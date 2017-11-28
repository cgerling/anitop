<template>
  <div>
    <div class="exibithion">
      <p class="name">{{anime.name}}</p>
      <div class="columns is-centered is-mobile is-marginless is-variable is-1">
        <anime-poster class="column is-half-mobile is-one-third-tablet is-one-quarter-desktop" :url="anime.image" />
      </div>
      <anime-popularity :quantity="data.popularity">
        <anime-watch :id="anime.id" :watching="data.watching" slot="button" />
      </anime-popularity>
    </div>
    <p class="details">
      {{anime.studio}} • {{anime.publisher}}
    </p>
    <p class="description">
      {{anime.description}}
    </p>
  </div>
</template>
<script>
import AnimePoster from '../components/AnimePoster'
import AnimePopularity from '../components/AnimePopularity'
import AnimeWatch from '../components/AnimeWatch'

import * as animeService from '../services/animeService.js'

export default {
  name: 'Details',
  components: { AnimePoster, AnimePopularity, AnimeWatch },
  data () {
    return {
      anime: {
        id: 0,
        name: '',
        author: '',
        studio: '',
        image: '',
        description: ''
      },
      data: {
        popularity: 0,
        watching: false
      }
    }
  },
  methods: {
    obtainAnimeInfo () {
      animeService.obtain(this.id).then(({ data }) => {
        this.anime = data.anime
      })

      animeService.obtainPopularity(this.id).then(({ data }) => {
        this.data.popularity = data.popularity
      })

      animeService.watching(this.id).then(({ data }) => {
        this.data.watching = data.watching
      })
    }
  },
  created () {
    const { id } = this.$route.params
    this.id = id

    this.obtainAnimeInfo()
  },
  beforeRouteUpdate (to, from, next) {
    const { id } = to.params
    this.id = id

    this.obtainAnimeInfo()

    next()
  }
}
</script>
<style scoped>
.exibithion {
  background: #363636;
}

.exibithion .name {
  color: #fff;
  font-size: 1.25em;
  font-weight: bold;
  text-align: center;
  word-wrap: break-word;
}

.details {
  font-size: .9em;
  text-align: center;
  margin: .5em 0;
  padding: 0 .5em;
  word-wrap: break-word;
}

.description {
  font-size: .85em;
  margin-bottom: .5em;
  padding: 0 .5em;
}

.description::first-letter {
  font-size: 2em;
  font-weight: bold;
  margin-left: .5em;
}
</style>
