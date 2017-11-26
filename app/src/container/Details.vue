<template>
  <div>
    <div class="columns is-centered is-mobile is-marginless is-variable is-1">
      <anime-poster class="column is-half" :url="anime.url" :name="anime.name" />
    </div>
    <p>
      {{anime.author}} <br>
      {{anime.publisher}} <br>
    </p>
  </div>
</template>
<script>
import AnimePoster from '../components/AnimePoster'

export default {
  name: 'Details',
  components: { AnimePoster },
  data () {
    return {
      anime: {
        name: 'Naruto Shipudden',
        seasonRelease: '2000-05-19',
        author: 'Masashi Kishimoto',
        publisher: 'Shonen\'s Jump',
        genres: ['Drama', 'Scream'],
        url: 'http://www.gstatic.com/tv/thumb/tvbanners/7842736/p7842736_b_v8_ab.jpg',
        description: 'Several nothing'
      }
    }
  },
  methods: {
    obtainAnime (id) {
      console.log(id)
    }
  },
  created () {
    const { id } = this.$route.params
    this.obtainAnime(id)
  },
  beforeRouteUpdate (to, from, next) {
    const { id } = to.params
    this.obtainAnime(id)

    next()
  }
}
</script>
<style scoped>

</style>
// public $name;
//     public $seasonRelease;
//     public $description;
//     public $author;
//     public $publisher;
//     public $genres;
