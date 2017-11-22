<template>
    <div id="tags">
        <div class="container">
            <h1 class="page-header my-3 pl-0">Все теги</h1>
        </div>
    </div>
</template>

<script>
    import { TagsResource } from '../resources'

    console.log(TagsResource.getTags());
    export default {
      name: 'tags',

    }
</script>