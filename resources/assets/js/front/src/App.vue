<template>
  <div id="app">
    <navbar></navbar>
    <div></div>
    <tags_inline></tags_inline>
    <transition name="fade" mode="out-in">
      <router-view :key="'main'"/>
    </transition>
  </div>
</template>

<script>
import navbar from '@/components/navbar'
import tags_inline from '@/components/tags_inline'

export default {
  name: 'app',
  components: {
    navbar,
    tags_inline
  }
}
</script>

<style lang="scss">

</style>