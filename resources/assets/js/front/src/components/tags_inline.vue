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
                            :to="{name: 'tag', params: { id: index }}"
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
    export default {
      name: 'tags_inline',
      data() {
        return {
          'tags': [
            {
              'name': 'Cultural',
              'additional_color': null
            },
            {
              'name': 'Animals',
              'additional_color': null
            },
            {
              'name': 'City',
              'additional_color': null
            },
            {
              'name': 'Study',
              'additional_color': null
            },
            {
              'name': 'WOW',
              'additional_color': null
            },
            {
              'name': 'Peoples',
              'additional_color': null
            },
            {
              'name': 'Important',
              'additional_color': null
            },
            {
              'name': 'Dick',
              'additional_color': null
            },
            {
              'name': 'Big',
              'additional_color': null
            },
          ]
        }
      }
    }
</script>