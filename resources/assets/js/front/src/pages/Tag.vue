<template>
    <transition name="fade" mode="out-in">
        <div class="tag" v-if="load">
            <div class="container">
                <h1 class="page-header mt-5 pl-0 d-inline-block">{{ info.name }}</h1>
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
        }
      },
      watch: {
        '$route.params.id'() {
          this.$set(this, 'load', false);
          this.$nextTick(function () {
            this.$root.$emit('id::change');
          });
          this.doStuff(this.$route.params);
        }
      },
      methods: {
        doStuff(params) {
          TagsResource.getTag(params)
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
        }
      },
      mounted() {
        this.doStuff(this.$route.params);
      }
    }
</script>