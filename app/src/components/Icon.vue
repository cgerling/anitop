<template>
  <i class="fa" :class="'fa-' + name"></i>
</template>
<script>
export default {
  props: ['name']
  name: 'Icon',
}
</script>
<style scoped>

</style>
