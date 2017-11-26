<template>
  <nav>
    <div class="brand">
      <router-link to="/">
        <img src="../assets/logo.png" alt="">
      </router-link>
    </div>
    <div class="options" v-if="logged">
      <icon name="search" />
      <button @click="logout">
        <icon name="sign-out" />
      </button>
    </div>
  </nav>
</template>
<script>
import Icon from './Icon'

export default {
  name: 'Navbar',
  components: { Icon },
  props: ['logged'],
  methods: {
    logout () {
      this.$emit('logout')
    }
  }
}
</script>
<style scoped>
nav {
  align-items: center;
  background: #fff;
  box-sizing: border-box;
  box-shadow: 0px -3px 10px 1px;
  display: flex;
  justify-content: space-between;
  height: 50px;
  left: 0;
  padding: 5px 10px;
  position: fixed;
  right: 0;
  top: 0;
  z-index: 100;
}

.options {
  align-items: center;
  display: flex;
  justify-content: space-around;
  width: 20%;
}

.brand {
  height: 100%;
}

.brand img {
  height: 100%;
}

button {
  background: transparent;
  border: none;
  cursor: pointer;
  outline: none;
}
</style>
