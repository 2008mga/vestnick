<template>
    <transition name="fade" mode="out-in">
        <div class="tag" v-if="id">
            <div class="container">
                <h1 class="page-header mt-5 pl-0 d-inline-block">{{ info.name }}</h1>
                <small class="d-block mb-5">{{ info.description }}</small>

                <div class="news">
                    <div class="row">
                        <div class="col col-md-6 new mb-5" v-for="(post, index) in info.news" :key="index">
                            <div class="main">
                                <div class="left">
                                    <img :src="post.image">
                                </div>
                                <div class="right px-3">
                                    <h4>{{ post.short_name }}</h4>
                                    <p>{{ post.description }}</p>
                                </div>
                            </div>
                            <div class="info"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import { TagsResource } from '../resources'

    export default {
      name: 'tag',
      data() {
        return {
          id: null,
          info: {}
        }
      },
      watch: {
        '$route.params.id'() {
          console.log(this.$route.params.id);
          this.id = null;
          this.doStuff(this.$route.params);
        }
      },
      methods: {
        doStuff(params) {
          TagsResource.getTag(params)
            .then((req) => {
              console.log(req.data);
              if ('id' in req.data) {
                this.$set(this, 'id', req.data.id);
                this.$set(this, 'info', req.data);
              }
            });
        }
      },
      created() {
         this.doStuff(this.$route.params);
      }
    }
</script>