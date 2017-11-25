<template>
    <div class="new-post" v-if="id">
        <div class="container mt-2 mb-5">
            <div class="info bg-info">
                <img :src="info.image" alt="" height="100%">
                <div class="my-5 px-3">
                    <h1 class="page-header d-inline-block mt-2 mb-2">
                        {{ info.full_name }}
                    </h1>
                    <small class="d-block">{{ info.description }}</small>

                    <div class="user" v-if="info.user">
                        <img :src="info.user.avatar" class="rounded-circle" width="150px">
                    </div>
                    <ul class="list-inline mb-1">
                        <!--{{ post.tags }}-->
                        <router-link tag="li"
                                     class="list-inline-item"
                                     :class="{ active: id === tag.id }"
                                     v-for="(tag, tagIndex) in info.tags"
                                     :key="tagIndex"
                                     :to="{ name: 'tag', params: { id: tag.id } }"
                                     v-if="tagIndex < 8"
                        >
                            <small class="badge-pill bg-primary my-2">
                                {{ tag.name }}
                            </small>
                        </router-link>
                    </ul>
                </div>
            </div>

            <hr>
            <div class="text" v-html="info.text"></div>
        </div>
    </div>
</template>

<script>
    import { NewsResource } from '@/resources'

    export default {
      name: 'new',
      data() {
        return {
          id: null,
          info: {},
          resource: new NewsResource()
        };
      },
      methods: {
        Init(id) {
          this.resource.getById({ id })
            .then((req) => {
                this.$set(this, 'id', req.data.id);
                this.$set(this, 'info', req.data);
            })
        }
      },
      mounted() {
        this.Init(this.$route.params.id);
      }
    }
</script>

<style lang="scss">
    .new-post {
        .info {
            display: flex;
            flex-flow: row;
            justify-content: center;
            /*align-items: center;*/
        }
    }
</style>