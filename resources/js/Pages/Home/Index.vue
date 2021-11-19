<template>
    <div>
        <Tasks :tasks="tasks" />
    </div>
</template>

<script lang="ts">
import { defineComponent, Ref, ref } from 'vue'
import Tasks from './Components/Tasks.vue'

interface Task {
    id: number,
    task_type_id: number,
    owner_id: number,
    created_by: number,
    task_priority: number
}

export default defineComponent({
    name: 'HomeIndex',
    components: {
        Tasks
    },
    props: {
        tasks: {type: Array as () => Task[], required: true}
    },
    setup() {
        const name: Ref<string> = ref('world')
        return {
            name
        }
    },
})
</script>

