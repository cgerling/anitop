<template>
  <div>
    <pagination @changePage="changePage" :size="animes.length" :total="total">
      <anime-list :animes="animes" />
    </pagination>
  </div>
</template>
<script>
import AnimeList from '@/components/AnimeList'
import Pagination from '@/components/Pagination'
import * as animeService from '@/services/animeService'

export default {
  name: 'Home',
  components: { AnimeList, Pagination },
  data () {
    return {
      animes: [],
      total: 0,
      loading: false
    }
  },
  methods: {
    changePage ({ page, size }) {
      this.obtainAnime(page, size)
    },
    obtainAnime (page, size) {
      this.startLoading()
      animeService.obtainAll(page, size).then(({ data }) => {
        this.animes = data.animes
        this.total = data.total
        this.stopLoading()
      }).catch(this.stopLoading)
    },
    startLoading () {
      this.loading = true
    },
    stopLoading () {
      this.loading = false
    }
  },
  created () {
    this.obtainAnime()
  }
}
</script>
<style scoped>

</style>
