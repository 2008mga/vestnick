<template>
    <div class="news">
        <div class="row">
            <div class="col-12 col-md-6 new mb-5" key="new" v-for="(post, index) in news" :key="index">
                <div class="main">
                    <div class="left">
                        <progressive-img width="100%" :src="post.image" />
                    </div>
                    <div class="right pl-3">
                        <router-link
                            class="header d-block"
                            :to="{ name: 'new', params: { id: post.id } }"
                        >{{ post.short_name }}</router-link>
                        <div>
                            <tags
                                :tags="post.tags"
                            ></tags>
                        </div>
                        <div class="info my-1">
                            <router-link
                                class="user px-1 py-1"
                                v-if="post.user_current"
                                :to="{ name: 'user', params: { id: post.user_current.id } }"
                            >
                                <div>
                                    <img width="25" :src="post.user_current.avatar" class="rounded-circle" alt="">
                                </div>
                                <div class="pl-1">
                                    {{ post.user_current.name }}
                                </div>
                            </router-link>
                        </div>
                        <p>{{ post.description }}</p>
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
    import Tags from "../components/tags.vue";

    export default {
      components: {Tags},
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
          resource: new NewsResource()
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

          this.resource['getBy' + type]({ id }, this.page)
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
//        this.$root.$on('id::change', () => {
//          this.page = 1;
//          this.news = [];
//        });

        this.$root.$on('news::init', (params) => {

          if (!this.handle) {
            this.$root.$emit('tags::init', { id: params.id });
            this.$set(this, 'handle', true);
            this['by'+params.type](params.id);
          }

          return true;
        });
      },
      created() {
        window.addEventListener('scroll', this.handleScroll);
      },
      destroyed() {
        this.$root.$off('news::init');
        this.$root.$off('id::change');
        window.removeEventListener('scroll', this.handleScroll);
      }
    }
</script>