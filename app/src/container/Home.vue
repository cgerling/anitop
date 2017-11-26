<template>
  <anime-list :animes="animes" />
</template>
<script>
import AnimeList from '@/components/AnimeList'

export default {
  name: 'Home',
  components: { AnimeList },
  data () {
    return {
      animes: [{
        name: 'Naruto Shippuden',
        url: 'http://www.gstatic.com/tv/thumb/tvbanners/7842736/p7842736_b_v8_ab.jpg'
      },
      {
        name: 'Kill la Kill',
        url: 'https://upload.wikimedia.org/wikipedia/pt/thumb/7/7e/Kill_la_Kill.jpg/200px-Kill_la_Kill.jpg'
      },
      {
        name: 'Fullmetal Alchemist: Brotherhood',
        url: 'http://www.gstatic.com/tv/thumb/tvbanners/9065115/p9065115_b_v8_aa.jpg'
      },
      {
        url: 'http://www.gstatic.com/tv/thumb/tvbanners/7842736/p7842736_b_v8_ab.jpg'
      },
      {
        url: 'http://www.gstatic.com/tv/thumb/tvbanners/7842736/p7842736_b_v8_ab.jpg'
      },
      {
        url: 'http://www.gstatic.com/tv/thumb/tvbanners/7842736/p7842736_b_v8_ab.jpg'
      }]
    }
  }
}
</script>
<style scoped>

</style>
