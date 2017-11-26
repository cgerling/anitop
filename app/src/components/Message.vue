<template>
  <div class="notification">
    <p>{{text}}</p>
  </div>
</template>
<script>
import Icon from './Icon'

export default {
  name: 'Message',
  components: { Icon },
  props: ['text']
}
</script>
<style scoped>
.notification {
  margin: 1.25em auto;
  width: 80%;
}
</style>
