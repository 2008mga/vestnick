<template>
    <transition-group name="fade" mode="out-in">
        <div class="tag" v-if="id" key="tag">
            <div class="container">
                <h1 class="page-header mt-5 pl-0 d-inline-block">{{ info.name }}</h1>
                <small class="d-block mb-5">{{ info.description }}</small>

                <div class="news">
                    <div class="row">
                        <div class="col-12 col-md-6 new mb-5" key="new" v-for="(post, index) in news" :key="index">
                            <div class="main">
                                <div class="left">
                                    <img :src="post.image">
                                </div>
                                <div class="right pl-3">
                                    <h4>{{ post.short_name }}</h4>
                                    <div>
                                        <ul class="list-inline mb-3">
                                            <router-link tag="li"
                                                class="list-inline-item"
                                                :class="{ active: id === tag.id }"
                                                v-for="(tag, tagIndex) in post.tags"
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
                                    <p>{{ post.description }}</p>
                                </div>
                            </div>
                            <div class="info">
                                <div class="views">
                                </div>
                                <div class="user text-center" v-if="post.user_current">
                                    <div>
                                        <img width="50" :src="post.user_current.avatar" class="rounded-circle" alt="">
                                    </div>
                                    <div class="pl-3">
                                        {{ post.user_current.name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="loading" v-if="this.loading">
                    Loading
                </div>
                <div class="more" @click="incPage()" v-if="this.next && !this.loading">
                    Загрузить ещё
                </div>
            </div>
        </div>
    </transition-group>
</template>

<script>
    import { TagsResource, NewsResource } from '../resources'

    export default {
      name: 'tag',
      data() {
        return {
          id: null,
          info: {},
          news: [],
          page: 1,
          next: false,
          loading: false
        }
      },
      watch: {
        '$route.params.id'() {
          this.page = 1;
          this.info = {};
          this.news = [];
          this.next = false;
          this.id = null;
          this.doStuff(this.$route.params);
        },
        'page'() {
          this.doNews(this.id);
        }
      },
      methods: {
        doStuff(params) {
          TagsResource.getTag(params)
            .then((req) => {
              if ('id' in req.data) {
                this.$set(this, 'info', req.data);
                this.doNews(req.data.id);
              }
            });
        },
        doNews(id) {
          this.$set(this, 'loading', true);
          NewsResource.getByTag({ id }, this.page)
            .then((r) => {
              this.$set(this, 'loading', false);
              this.$set(this, 'id', id);
              this.news = this.news.concat(r.data.data);
              this.$set(this, 'page', r.data.current_page);
              this.$set(this, 'next', !!r.data.next_page_url);
            });
        },
        incPage() {
          if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && this.next && !this.loading) {
            this.$set(this, 'page', this.page+1);
          }
        },
        handleScroll() {
          this.incPage();
        }
      },
      created() {
        this.doStuff(this.$route.params);
        window.addEventListener('scroll', this.handleScroll);
      },
      destroyed() {
        window.removeEventListener('scroll', this.handleScroll);
      }
    }
</script>