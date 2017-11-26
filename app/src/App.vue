<template>
  <div id="app">
    <navbar :logged="logged" @logout="logout" />
    <div class="container">
      <router-view/>
    </div>
  </div>
</template>

<script>
import { logout, isLogged } from './services/authService.js'
import Navbar from './components/Navbar'

export default {
  name: 'app',
  components: { Navbar },
  data () {
    return {
      logged: isLogged()
    }
  },
  methods: {
    logout () {
      logout()
      this.$router.push('/auth/login')
    }
  },
  beforeUpdate () {
    this.logged = isLogged()
  }
}
</script>

<style lang="scss">
@import "~bulma/bulma";

#app {
  color: #2c3e50;
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

body,
html {
  margin: 0;
  overflow-y: auto;
  padding: 0;
}

.container {
  margin-top: 50px;
  width: 100%;
}
</style>
