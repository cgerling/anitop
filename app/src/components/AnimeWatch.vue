<template>
  <button :class="{ 'watching': watching, 'not-watching': !watching }">
    <icon :name="iconName" />
    {{text}}
  </button>
</template>
<script>
import Icon from './Icon'

export default {
  name: 'AnimeWatch',
  components: { Icon },
  props: ['watching'],
  computed: {
    iconName () {
      return this.watching ? 'minus' : 'plus'
    },
    text() {
      return this.watching ? 'Remover' : 'Assistir'
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
