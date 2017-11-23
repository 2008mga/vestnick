<template>
    <div id="tags">
        <transition name="fade" mode="in-out">
            <div class="container" v-if="tags">
                <h1 class="page-header my-3 pl-0">Все теги</h1>
                <div class="row">
                    <div
                        v-for="(tag, index) in tags"
                        :key="index"
                        class="col-12 col-sm-4 col-md-2 tags"
                    >
                        <router-link tag="div" :to="{name: 'tag', params: { id: tag.id }}">
                            <div class="card tag">
                                <div class="card-image text-center">
                                    <img class="rounded-circle" :src="tag.image" alt="" width="70%">
                                </div>
                                <div class="card-block text-center">
                                    <div class="mb-2">
                                        <h4>
                                            {{ tag.name }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import { TagsResource } from '../resources'

    export default {
      name: 'tags',
      data() {
        return {
          tags: null
        }
      },
      mounted() {
        TagsResource.getTags()
          .then((req) => {
            this.$set(this, 'tags', req.data);
          });
      }
    }
</script>

<style lang="scss">
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0
    }
</style>