<template>
  <i class="fa" :class="icon"></i>
</template>
<script>
export default {
  name: 'Icon',
  props: ['name'],
  computed: {
    icon () {
      return `fa-${name}`
    }
  }
}
</script>
<style scoped>
</style>
