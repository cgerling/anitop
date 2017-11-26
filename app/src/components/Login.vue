<template>
  <form @submit.prevent="login()">
    <div class="field">
      <div class="control">
        <input class="input" type="text" placeholder="Email" v-model="email">
      </div>
    </div>
    <div class="field">
      <div class="control">
        <input class="input" type="password" placeholder="Senha" v-model="passwd">
      </div>
    </div>
    <button type="submit" class="button is-success is-pulled-right">
      Entrar
    </button>
  </form>
</template>
<script>
import { login } from '../services/authService.js'

export default {
  name: 'Login',
  data () {
    return {
      email: '',
      passwd: ''
    }
  },
  methods: {
    login () {
      login(this.email, this.passwd).then(() => {
        this.$router.push('/home')
      })
    }
  }
}
</script>
<style lang="scss" scoped>
form {
  box-sizing: border-box;
  width: 100%;
}
</style>
