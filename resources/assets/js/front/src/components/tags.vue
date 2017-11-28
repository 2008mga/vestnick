<template>
    <ul class="list-inline mb-1 tags-inline">
        <!--{{ post.tags }}-->
        <router-link tag="li"
                     v-for="(tag, tagIndex) in tags"
                     class="list-inline-item"
                     :key="tagIndex"
                     :to="{ name: 'tag', params: { id: tag.id } }"
                     v-if="tagIndex < 8"
        >
            <small
                class="badge-pill bg-primary my-2"
                :class="{
                    active: id === tag.id,
                    'badge-pill': true,
                    'bg-primary': true,
                    'my-2': true
                }"
            >
                {{ tag.name }}
            </small>
        </router-link>
    </ul>
</template>

<script>
    export default {
      name: 'tags',
      props: {
        tags: {
          type: Array
        }
      },
      data() {
        return {
          id: null
        }
      },
      mounted() {
        this.$root.$on('tags::init', (params) => {
          this.$set(this, 'id', params.id);
        });
      },
      destroy() {
        this.$root.$off('tags::init');
      }
    }
</script>