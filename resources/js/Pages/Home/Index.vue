<template>
    <h1>hello {{name}}</h1>
</template>

<script lang="ts">
import { defineComponent, Ref, ref } from 'vue'

export default defineComponent({
    setup() {
        const name: Ref<string> = ref('world')
        return {
            name
        }
    },
})
</script>

