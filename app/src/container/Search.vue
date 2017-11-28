<template>
  <div>
    <pagination @changePage="changePage" :loading="loading" :size="animes.length" :total="total">
      <anime-list :animes="animes" />
    </pagination>
  </div>
</template>
<script>
import AnimeList from '@/components/AnimeList'
import Pagination from '@/components/Pagination'
import * as animeService from '@/services/animeService'

export default {
  name: 'Search',
  components: { AnimeList, Pagination },
  data () {
    return {
      term: '',
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
      animeService.search(this.term, page, size).then(({ data }) => {
        this.animes = data.animes
        this.total = data.total
        this.stopLoading()
      }).catch(this.startLoading)
    },
    startLoading () {
      this.loading = true
    },
    stopLoading () {
      this.loading = false
    }
  },
  created () {
    this.term = this.$route.params.term
    this.obtainAnime()
  },
  watch: {
    '$route' (to, from) {
      this.term = to.params.term
      this.obtainAnime()
    }
  }
}
</script>
<style scoped>

</style>
