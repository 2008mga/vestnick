<template>
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
                                <!--{{ post.tags }}-->
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
                        <router-link
                                :to="{ name: 'user', params: { id: post.user_current.id } }"
                                class="pl-3"
                        >
                            {{ post.user_current.name }}
                        </router-link>
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
</template>

<script>
    import { NewsResource } from '../resources'

    export default {
      name: 'news',
      data() {
        return {
          news: [],
          type: null,
          page: 1,
          next: false,
          loading: false,
          id: null,
          handle: false,
        }
      },
      watch: {
        'page'() {
          this.doNews(this.id, this.type);
        }
      },
      methods: {
        doNews(id, type) {
          this.$set(this, 'type', type);
          this.$set(this, 'loading', true);

          NewsResource['getBy' + type]({ id }, this.page)
            .then((r) => {
              this.$set(this, 'loading', false);
              this.$set(this, 'id', id);
              this.news = this.news.concat(r.data.data);
              this.$set(this, 'page', r.data.current_page);
              this.$set(this, 'next', !!r.data.next_page_url);
              this.$set(this, 'handle', false);
            });
        },
        incPage() {
          if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && this.next && !this.loading) {
            this.$set(this, 'page', this.page+1);
          }
        },
        handleScroll() {
          this.incPage();
        },
        byTag(id) {
          this.doNews(id, 'Tag');
        },
        byUser(id) {
          this.doNews(id, 'User');
        }
      },
      mounted() {
        this.$root.$on('id::change', () => {
          this.page = 1;
          this.news = [];
        });

        this.$root.$on('news::init', (params) => {
          if (!this.handle) {
            this.$set(this, 'handle', true);
            this['by'+params.type](params.id);
          }
        });
      },
      created() {
        window.addEventListener('scroll', this.handleScroll);
      },
      destroyed() {
        window.removeEventListener('scroll', this.handleScroll);
      }
    }
</script>