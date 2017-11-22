<template>
  <div id="app">
    <div class="header">
      <navbar></navbar>
      <tags_inline></tags_inline>
    </div>
    <router-view/>
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