<template>
  <nav>
    <div class="content elevate">
      <div class="brand">
        <router-link to="/">
          <img src="../assets/logo.png" alt="">
        </router-link>
      </div>
      <div class="name">
        {{name}}
      </div>
      <div class="options" v-if="logged">
        <button @click="toggleSearch">
          <icon name="search" />
        </button>
        <router-link to="/watchlist" tag="button">
          <icon name="tv" />
        </router-link>
        <button @click="logout">
          <icon name="sign-out" />
        </button>
      </div>
    </div>
    <search class="float-bottom" :class="{ 'open': showSearch, 'closed': !showSearch }" :show="showSearch" @search="search" @close="closeSearch" />
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
      name: 'Inicial',
      showSearch: false
    }
  },
  methods: {
    search (term) {
      this.showSearch = false

      this.$router.push(`/search/${term}`)
    },
    logout () {
      this.$emit('logout')
    },
    toggleSearch () {
      this.showSearch = !this.showSearch
    },
    closeSearch () {
      this.showSearch = false
    }
  },
  created () {
    this.name = this.$route.name
  },
  watch: {
    '$route' (to, from) {
      this.name = to.name
    }
  }
}
</script>
<style scoped>
nav {
  background: #fff;
  box-shadow: 0px -3px 10px 1px;
  height: 50px;
  left: 0;
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
  height: 100%;
  outline: none;
}

.content {
  align-items: center;
  background: #fff;
  box-sizing: border-box;
  display: flex;
  height: 100%;
  justify-content: space-between;
  padding: 5px 10px;
  width: 100%;
}

.elevate {
  z-index: 10;
}

.float-bottom {
  box-shadow: 0px 4px 5px 0px rgba(0, 0, 0, 0.1);
  height: 45px;
  left: 0;
  position: absolute;
  right: 0;
  transition: ease all 320ms;
  z-index: -1;
}

.open {
  bottom: -45px;
}

.closed {
  bottom: 0;
}
</style>
