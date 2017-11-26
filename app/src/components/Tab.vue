<template>
  <li :class="{'is-active': actualPath == path}">
    <router-link :to="path">
      <span v-if="icon" class="icon is-smaill">
        <i class="fa" :class="icon"></i>
      </span>
      {{title}}
    </router-link>
  </li>
</template>
<script>
export default {
  name: 'Tab',
  props: ['path', 'title', 'icon'],
  data () {
    return {
      actualPath: ''
    }
  },
  watch: {
    $route: {
      immediate: true,
      handler (val, oldVal) {
        this.actualPath = val.path
      }
    }
  }
}
</script>
<style lang="sass" scoped>

</style>
