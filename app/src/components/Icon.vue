<template>
  <i class="fa" :class="'fa-' + name"></i>
</template>
<script>
export default {
  name: 'icon',
  props: ['name']
}
</script>
<style scoped>

</style>
