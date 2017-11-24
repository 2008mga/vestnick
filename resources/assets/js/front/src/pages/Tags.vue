<template>
    <div id="tags">
        <transition name="fade" mode="in-out">
            <div class="container" v-if="tags">
                <h1 class="page-header mt-5 pl-0 d-inline-block">Все теги</h1>
                <small class="d-block mb-5">Описание которое тебе надо придумать )</small>
                <div class="row">
                    <div
                        v-for="(tag, index) in tags"
                        :key="index"
                        class="col-12 col-sm-6 col-md-3 tags mb-5">
                        <router-link tag="div" :to="{name: 'tag', params: { id: tag.id }}">
                            <div class="card tag">
                                <div class="card-block py-2">
                                    <div class="mt-0">
                                        <h4>
                                            {{ tag.name }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="card-image">
                                    <img :src="tag.image" alt="" width="100%">
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
          tags: null,
          resource: new TagsResource()
        }
      },
      mounted() {
        this.resource.getTags()
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