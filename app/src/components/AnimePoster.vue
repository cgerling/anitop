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
  name: 'AnimePoster',
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
  bottom: 0;
  color: #fff;
  font-size: .8em;
  font-weight: bold;
  left: 0;
  padding: 0 .5em;
  position: absolute;
  right: 0;
  z-index: 10;
}
</style>
