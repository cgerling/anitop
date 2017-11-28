<template>
  <div class="page">
    <button v-if="firstPage" @click="previous()" class="previous">
      Anterior
    </button>
    <slot />
    <button v-if="lastPage" @click="next()" class="next">
      Próximo
    </button>
    <transition>
      <div class="loading">

      </div>
    </transition>
  </div>
</template>
<script>
export default {
  name: 'Pagination',
  props: ['loading', 'size', 'total'],
  data () {
    return {
      page: 1
    }
  },
  computed: {
    actualPageLabel () {
      return `Página ${this.page}`
    },
    firstPage () {
      return this.size > 0 && this.page > 1
    },
    lastPage () {
      return this.size > 0 && this.size * this.page < this.total
    }
  },
  methods: {
    next () {
      this.page++
      this.changePage()
    },
    previous () {
      this.page--
      this.changePage()
    },
    changePage () {
      this.$emit('changePage', {
        page: this.page,
        items: this.itens
      })
    }
  }
}
</script>
<style scoped>
button {
  background: #363636;
  border: none;
  color: #fff;
  font-weight: bold;
  height: 2.5em;
  outline: none;
  text-transform: uppercase;
  width: 100%;
}
</style>
