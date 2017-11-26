<template>
  <div class="popularity">
    <div class="quantity">
      <icon name="television" />
      <p>
        {{quantity}}
      </p>
    </div>
    <slot name="button" />
  </div>
</template>
<script>
import Icon from './Icon'

export default {
  name: 'AnimePopularity',
  components: { Icon },
  props: ['quantity']
}
</script>
<style scoped>
.popularity {
  align-items: stretch;
  background: #209cee;
  color: #fff;
  display: flex;
  font-weight: bold;
  justify-content: space-between;
  padding-left: 10%;
  position: relative;
  text-align: center;
  width: 100%;
}

.quantity {
  flex-grow: 1;
}
</style>
