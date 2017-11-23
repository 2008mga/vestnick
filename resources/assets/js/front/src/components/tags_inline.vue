<template>
    <div id="tags_inline">
        <div class="container">
            <ul class="nav tags-inline">
                <li class="nav-item">
                    <router-link
                        :to="{name: 'home'}"
                        class="nav-link"
                        active-class="active"
                    >Home</router-link>
                </li>
                <li v-for="(tag, index) in tags" :key="index" class="nav-item">
                    <router-link
                            :to="{name: 'tag', params: { id: tag.id }}"
                            class="nav-link"
                            active-class="active"
                    >{{ tag.name }}</router-link>
                </li>
                <li class="nav-item">
                    <router-link
                            :to="{name: 'tags'}"
                            class="nav-link"
                            active-class="active"
                    >Ещё</router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import { TagsResource } from '../resources'

    export default {
      name: 'tags_inline',
      data() {
        return {
          'tags': [],
        }
      },
      mounted() {
        TagsResource.getTags()
          .then((req) => {
            this.$set(this, 'tags', req.data);
          })
      }
    }
</script>