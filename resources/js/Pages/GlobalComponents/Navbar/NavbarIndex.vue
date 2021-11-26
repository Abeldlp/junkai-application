<template>
    <div>
        <Link href="/">巡回</Link>
        <Link href="/create">アイテム追加</Link>
    </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

export default defineComponent({
    name: 'NavbarIndex',
    components: {
        Link
    }
})

</script>
