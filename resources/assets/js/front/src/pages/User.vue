<template>
    <div class="user" v-if="id">
        <div class="container">
            <ol class="breadcrumb mt-2 mb-3">
                <li class="breadcrumb-item">Пользователи</li>
                <li class="breadcrumb-item active">{{ user.name }}</li>
                <li class="breadcrumb-item">Просмотр</li>
            </ol>
            <div class="info">
                <div class="image">
                    <img
                        :src="user.avatar"
                        class="rounded-circle"
                        width="200px"
                    >
                </div>
                <div class="bio pl-5">
                    <h1 class="page-header d-inline-block">
                        {{ user.name }}
                        <small>
                            <man-svg v-if="user.sex === 'man'"></man-svg>
                            <woman-svg v-if="user.sex === 'woman'"></woman-svg>
                        </small>
                    </h1>
                    <small class="d-block">{{ user.about }}</small>
                </div>
            </div>
            <hr class="mt-5 mb-0">
            <h2 class="page-header d-inline-block my-5">Новости пользователя</h2>
            <news></news>
        </div>
    </div>
</template>

<script>
    import { UsersResource } from '../resources'
    import news from "@/components/news";
    import manSvg from "@/components/svg/man.svg"
    import womanSvg from "@/components/svg/woman.svg"

    export default {
      components: {news, manSvg, womanSvg},
      name: 'user',
      watch: {
        '$route.params.id'() {
          this.$nextTick(function () {
            this.$root.$emit('id::change');
          });
          this.doUser(this.$route.params.id);
        }
      },
      data() {
        return {
          id: null,
          user: null,
          resource: new UsersResource()
        }
      },
      methods: {
        doUser(id) {
            this.resource.getAnket({ id })
              .then((req) => {
                this.$set(this, 'user', req.data);
                this.$set(this, 'id', id);

                this.$nextTick(function () {
                  this.$root.$emit('news::init', {
                    type: 'User',
                    id: id
                  });
                });
              });
        }
      },
      mounted() {
        this.doUser(this.$route.params.id);
      }
    }
</script>