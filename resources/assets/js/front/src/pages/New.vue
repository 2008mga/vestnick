<template>
    <div class="new-post" v-if="id">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 col-12 text-center">
                    <img :src="info.image" alt="">
                    <div class="user mt-5" v-if="info.user">
                        <img width="100px" class="rounded-circle" :src="info.user.avatar" alt="">
                        <div>
                            <router-link
                                :to="{ name: 'user', params: { id: info.user.id } }"
                            >
                                {{ info.user.name }}
                            </router-link>
                        </div>
                    </div>

                    <div class="stats mt-3">
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
                    <div class="text" v-html="info.text"></div>
                </div>
                <hr class="col-12 col-md-12 mt-5 mb-0">
                <div class="col-12 col-md-12 mt-5">
                    <div class="comments">
                        <div v-if="$root.authCheck">
                            <div class="form-group">
                                <label>Оставь свой комментарий</label>
                                <textarea
                                    name="text"
                                    class="form-control form-control-sm"
                                    v-model="comment"
                                ></textarea>
                            </div>

                            <button
                                class="btn btn-primary btn-sm float-right"
                                @click="sendComment()"
                                :disabled="send"
                            >
                                Написать
                            </button>
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

                        <div class="list">
                            <div v-for="(comment, commentIndex) in info.comments" :key="commentIndex">
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

    export default {
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
            .sendComment({ id: this.id }, this.comment, this.$root.authToken)
            .then((req) => {
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