<template>
  <form @submit.prevent="search">
    <button class="icon left" type="submit">
      <icon name="search" />
    </button>
    <input v-model="term" type="text" placeholder="Anime">
    <button class="icon right" @click="close">
      <icon name="times" />
    </button>
  </form>
</template>
<script>
import Icon from './Icon'

export default {
  name: 'Search',
  components: { Icon },
  props: ['show'],
  data () {
    return {
      term: ''
    }
  },
  methods: {
    search () {
      this.$emit('search', this.term)
    },
    close () {
      this.term = ''
      this.$emit('close')
    }
  }
}
</script>
<style scoped>
form {
  background: #fff;
  padding: 1px 2em;
}

input[type="text"] {
  border: none;
  height: 100%;
  outline: none;
  padding: 0;
  width: 100%;
}

.icon {
  background: transparent;
  border: none;
  bottom: 0;
  color: #4a4a4a;
  height: 100%;
  outline: none;
  position: absolute;
  top: 0;
}

.icon.left {
  left: .3em;
}

.icon.right {
  right: .3em;
}
</style>
