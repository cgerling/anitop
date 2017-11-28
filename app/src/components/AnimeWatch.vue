<template>
  <button @click="toggleWatching()" :class="{ 'watching': isWatching, 'not-watching': !isWatching }" :disabled="loading">
    <icon :name="iconName" />
    {{text}}
  </button>
</template>
<script>
import Icon from './Icon'

import * as animeService from '../services/animeService.js'

export default {
  name: 'AnimeWatch',
  components: { Icon },
  props: ['watching', 'id'],
  data () {
    return {
      loading: false,
      isWatching: false
    }
  },
  computed: {
    iconName () {
      return this.isWatching ? 'minus' : 'plus'
    },
    text () {
      return this.isWatching ? 'Remover' : 'Assistir'
    }
  },
  methods: {
    toggleWatching () {
      this.loading = true

      let promise

      if (this.watching) {
        promise = animeService.removeFromWatchlist(this.id).then(() => {
          this.isWatching = false
        })
      } else {
        promise = animeService.addToWatchlist(this.id).then(() => {
          this.isWatching = true
        })
      }

      promise.then(() => {
        this.loading = false
      }).catch(() => {
        this.loading = false
      })
    }
  }
}
</script>
<style scoped>
button {
  border: none;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  outline: none;
}

button.watching {
  background: #ff3860;
}

button.not-watching {
  background: #23d160;
}
</style>
