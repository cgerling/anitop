<template>
  <form @submit.prevent="register()">
    <div class="field">
      <div class="control">
        <input class="input" type="text" placeholder="Nome" v-model="name">
      </div>
    </div>
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
      Registrar
    </button>
  </form>
</template>
<script>
import { register } from '../services/authService.js'

export default {
  name: 'Register',
  data () {
    return {
      name: '',
      email: '',
      passwd: ''
    }
  },
  methods: {
    register () {
      register(this.name, this.email, this.passwd).thne(() => {
        this.$route.push('/auth/login')
      })
    }
  }
}
</script>
<style scoped>
form {
  box-sizing: border-box;
  width: 100%;
}
</style>
