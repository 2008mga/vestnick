<template>
    <transition name="fade" mode="out-in">
        <div class="tag" v-if="load">
            <div class="container">
                <ol class="breadcrumb mt-2 mb-0">
                    <li class="breadcrumb-item"><router-link :to="{ name: 'tags' }">Теги</router-link></li>
                    <li class="breadcrumb-item active">{{ info.name }}</li>
                </ol>
                <h1 class="page-header mt-2 pl-0 d-inline-block">{{ info.name }}</h1>
                <small class="d-block mb-5">{{ info.description }}</small>

                <news></news>
            </div>
        </div>
    </transition>
</template>

<script>
    import { TagsResource } from '../resources'
    import News from "@/components/news.vue";

    export default {
      components: {News},
      name: 'tag',
      data() {
        return {
          id: null,
          info: {},
          load: null,
          resource: null
        }
      },
      watch: {
        '$route.params.id'() {
          console.log('test');
          this.$set(this, 'load', false);
          this.$nextTick(function () {
            this.$root.$emit('id::change');
          });
          this.doStuff(this.$route.params);
        }
      },
      methods: {
        doStuff(params) {
          this.$set(this, 'resource', new TagsResource());

          this.$nextTick(function () {
            this.resource.getTag(params)
              .then((req) => {
                if ('id' in req.data) {
                  this.$set(this, 'load', true);
                  this.$set(this, 'info', req.data);

                  this.$nextTick(function () {
                    this.$root.$emit('news::init', {
                      type: 'Tag',
                      id: this.info.id
                    });
                  });

                }
              });
          });

        }
      },
      mounted() {
        this.doStuff(this.$route.params);
      }
    }
</script>