<template>
  <nav>
    <div class="brand">
      <router-link to="/">
        <img src="../assets/logo.png" alt="">
      </router-link>
    </div>
    <div class="options" v-if="logged">
      <button @click="toggleSearch">
        <icon name="search" />
      </button>
      <button @click="logout">
        <icon name="sign-out" />
      </button>
    </div>
    <search class="float-bottom" :class="{ 'open': showSearch, 'closed': !showSearch }" :show="showSearch" @search="search" @close="toggleSearch" />
  </nav>
</template>
<script>
import Icon from './Icon'
import Search from './Search'

export default {
  name: 'Navbar',
  components: { Icon, Search },
  props: ['logged'],
  data () {
    return {
      showSearch: false
    }
  },
  methods: {
    search (term) {
      // TODO: implement search
      console.info(term)
    },
    logout () {
      this.$emit('logout')
    },
    toggleSearch () {
      this.showSearch = !this.showSearch
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
  color: #4a4a4a;
  cursor: pointer;
  outline: none;
}

.float-bottom {
  box-shadow: 0px 4px 5px 0px rgba(0, 0, 0, 0.1);
  position: absolute;
  left: 0;
  right: 0;
  transition: ease all 320ms;
  z-index: -1;
}

.open {
  bottom: -26px;
}

.closed {
  bottom: 0;
  visibility: hidden;
}
</style>
