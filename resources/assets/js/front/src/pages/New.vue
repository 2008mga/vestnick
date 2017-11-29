<template>
    <div class="new-post" v-if="id">
        <div class="container mt-2 mb-5">
            <ol class="breadcrumb mt-2 mb-2">
                <li class="breadcrumb-item">Новости</li>
                <li class="breadcrumb-item active">{{ info.short_name }}</li>
            </ol>
            <div class="row">
                <div class="col-md-3 col-12 text-center">
                    <img :src="info.image" alt="">
                    <hr>
                    <div class="user mt-2" v-if="info.user">
                        <img
                            width="100px"
                            class="rounded-circle"
                            :src="info.user.avatar"
                            alt=""
                            v-if="info.user.avatar"
                        >
                        <div class="mt-2">
                            <router-link
                                :to="{ name: 'user', params: { id: info.user.id } }"
                            >
                                {{ info.user.name }}
                            </router-link>
                        </div>
                    </div>
                    <hr>
                    <div class="stats mt-2">
                        <div>
                            Просмотров
                        </div>
                        {{ info.views }}
                    </div>
                </div>
                <div class="col-md-9 col-12">
                    <div class="info">
                        <small>{{ info.short_name }}</small>
                        <h1>{{ info.full_name }}</h1>
                        <tags :tags="info.tags"></tags>
                    </div>
                    <div class="text" v-html="info.text"></div>
                </div>
                <div class="col-12 col-md-12 mt-2">
                    <div class="comments">
                        <div v-if="$root.authCheck">
                            <h4 class="title pt-2 pb-2 text-uppercase">Комментарии</h4>

                            <b-input-group :left="$root.authUser.name">
                                <b-input-group-button slot="right">
                                    <b-button
                                        variant="info"
                                        size="sm"
                                        @click="sendComment()"
                                    >Написать</b-button>
                                </b-input-group-button>
                                <b-form-input v-model="comment"></b-form-input>
                            </b-input-group>
                            <small
                                    v-if="comment_error"
                                    class="float-right text-danger pr-2"
                            >
                                {{ comment_error }}
                            </small>
                        </div>
                        <div v-else>
                            <router-link
                                :to="{ name: 'auth.signIn' }"
                            >Войдите чтобы написать комментарий</router-link>
                        </div>

                        <hr>

                        <div class="list">
                            <div
                                v-for="(comment, commentIndex) in info.comments"
                                :key="commentIndex"
                                class="p-3 bg-primary mb-2"
                            >
                                <small class="d-block text-muted">
                                    {{ comment.user.name }}
                                    /
                                    {{ comment.created_at }}
                                </small>
                                {{ comment.text }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { NewsResource } from '@/resources'
    import Tags from "../components/tags.vue";

    export default {
      components: {Tags},
      name: 'new',
      data() {
        return {
          id: null,
          comment: null,
          comment_error: null,
          send: false,
          info: {},
          resource: new NewsResource()
        }
      },
      methods: {
        Init(id) {
          this.resource.getById({ id })
            .then((req) => {
                console.log(req);
                this.$set(this, 'id', req.data.id);
                this.$set(this, 'info', req.data);
            })
            .catch((err) => {
                throw err;
            });
        },
        sendComment() {
          this.send = true;
          this.resource
            .sendComment({ id: this.id }, this.comment, this.$root.$cookie.get('auth.accessToken'))
            .then((req) => {
                this.$set(this, 'comment_error', false);
                this.send = false;
                if (req.data.success) {
                  // append comment
                  this.comment = null;
                  this.info.comments.unshift(req.data.comment);
                }
            })
            .catch((e) => {
                this.send = false;

                let error = e.response.data.message;
                this.$set(this,'comment_error', error);
            });
        }
      },
      mounted() {
        this.Init(this.$route.params.id);
      }
    }
</script>

<style lang="scss">
</style>