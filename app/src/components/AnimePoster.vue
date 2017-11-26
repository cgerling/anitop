<template>
  <div class="poster">
    <img :src="url">
    <div class="name">
      {{name}}
    </div>
  </div>
</template>
<script>
export default {
  name: 'anime-poster',
  props: ['url', 'name']
}
</script>
<style scoped>
.poster {
  align-items: center;
  display: flex;
  justify-content: center;
  position: relative;
}

.name {
  background: rgba(0, 0, 0, 0.5);
  bottom: 12px;
  color: #fff;
  font-size: .8em;
  font-weight: bold;
  left: 4px;
  position: absolute;
  right: 4px;
  z-index: 10;
}
</style>
