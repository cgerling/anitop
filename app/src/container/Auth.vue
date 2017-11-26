<template>
  <div>
    <tabs>
      <tab title="Entrar" path="/auth/login" />
      <tab title="Registro" path="/auth/register" />
    </tabs>
    <div class="content">
      <router-view />
    </div>
  </div>
</template>
<script>
import Tabs from '@/components/Tabs'
import Tab from '@/components/Tab'

export default {
  name: 'Auth',
  components: { Tabs, Tab }
}
</script>
<style scoped>
.content {
  padding: 0 10%;
}
</style>
