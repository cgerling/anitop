<template>
  <div>
    <anime-list :animes="animes" />
    <message :text="message" v-if="animes.length == 0" />
  </div>
</template>
<script>
import AnimeList from '../components/AnimeList'
import Message from '../components/Message'

export default {
  name: 'Watchlist',
  components: { AnimeList, Message },
  data () {
    return {
      animes: [{
        name: 'Naruto Shippuden',
        url: 'http://www.gstatic.com/tv/thumb/tvbanners/7842736/p7842736_b_v8_ab.jpg'
      },
      {
        name: 'Fullmetal Alchemist: Brotherhood',
        url: 'http://www.gstatic.com/tv/thumb/tvbanners/9065115/p9065115_b_v8_aa.jpg'
      }],
      message: 'Tu não tem nada, seu lixo'
    }
  }
}
</script>
<style scoped>
</style>
