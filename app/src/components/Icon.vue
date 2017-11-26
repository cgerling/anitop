<template>
  <i class="fa" :class="icon"></i>
</template>
<script>
export default {
  name: 'Icon',
  props: ['name'],
  computed: {
    icon () {
      return `fa-${this.name}`
    }
  }
}
</script>
<style scoped>
</style>
