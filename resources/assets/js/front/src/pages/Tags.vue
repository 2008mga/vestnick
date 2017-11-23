<template>
    <div id="tags">
        <div class="container">
            <h1 class="page-header my-3 pl-0">Все теги</h1>
            <div class="row">
                <div
                    v-for="(tag, index) in tags"
                    :key="index"
                    class="col-12 col-md-3"
                >
                    <router-link tag="div" :to="{name: 'tag', params: { id: tag.id }}">
                        <div class="card">
                            <div class="card-image">
                                <img :src="tag.image" alt="" width="100%">
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col">
                                        {{ tag.name }}
                                    </div>
                                    <div class="col text-right">
                                        {{ tag.news_count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { TagsResource } from '../resources'

    export default {
      name: 'tags',
      data() {
        return {
          tags: []
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