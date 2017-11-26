<template>
  <div>
    <div class="exibithion">
      <p class="name">{{anime.name}}</p>
      <div class="columns is-centered is-mobile is-marginless is-variable is-1">
        <anime-poster class="column is-half-mobile is-one-third-tablet is-one-quarter-desktop" :url="anime.url" />
      </div>
      <anime-popularity :quantity="anime.popularity">
        <anime-watch :watching="anime.watching" slot="button" />
      </anime-popularity>
    </div>
    <p class="details">
      {{anime.author}} • {{anime.publisher}}
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

export default {
  name: 'Details',
  components: { AnimePoster, AnimePopularity, AnimeWatch },
  data () {
    return {
      anime: {
        name: 'Naruto Shipudden',
        seasonRelease: '2000-05-19',
        author: 'Masashi Kishimoto',
        publisher: 'Shonen\'s Jump',
        genres: ['Drama', 'Scream'],
        url: 'http://www.gstatic.com/tv/thumb/tvbanners/7842736/p7842736_b_v8_ab.jpg',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus condimentum, arcu vitae faucibus efficitur, lorem tortor pellentesque nunc, nec blandit nunc metus ut lacus. Donec egestas porttitor velit vel lobortis. Nulla porttitor mi et justo vehicula, a ornare tortor tristique. Phasellus lobortis imperdiet aliquam. Aliquam malesuada scelerisque enim, eget lacinia tellus euismod quis. Proin finibus nunc vel diam mattis, at vulputate augue pharetra. Nam gravida laoreet ante, non gravida orci. Proin interdum nec lacus sed aliquam. Maecenas pulvinar sapien odio, a interdum eros interdum dapibus. Curabitur vel ultricies ante. Nulla at sollicitudin nunc. Etiam ullamcorper neque sit amet fringilla sollicitudin. Cras at nibh erat. Nunc ut ex luctus, ullamcorper massa eu, finibus erat. Vestibulum nibh libero, vestibulum non pellentesque et, elementum sit amet tortor. Donec sit amet velit dapibus, dapibus neque eu, eleifend dui. Phasellus vitae ullamcorper eros. Quisque at elit magna. Quisque gravida feugiat sagittis. Curabitur vitae lacus consequat, fermentum urna quis, vestibulum dolor. Maecenas nunc leo, porta vel augue malesuada, fermentum blandit ipsum. Nam non cursus enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur dapibus ut ante in pellentesque. Sed mattis semper nunc. Morbi non augue elementum, tempus felis vel, iaculis dui. Fusce faucibus maximus vestibulum. Nulla a volutpat dolor, id fermentum ex. Donec sit amet lorem lectus. Duis iaculis risus tellus, quis congue sem varius sit amet. Morbi nec ante id sapien malesuada maximus a sit amet augue.',
        popularity: 50000,
        watching: true
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
