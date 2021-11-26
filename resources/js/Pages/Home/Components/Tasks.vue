<template>
    <div>
        <div v-for="task in tasks" :key="task.id">
            <p>{{ task.type.type_name }}</p>
            <p>{{ task.owner.full_name }}</p>
        </div>
    </div>
</template>

<script lang="ts" >

import { defineComponent, Ref, ref } from 'vue'

interface Task {
    id: number,
    task_type_id: number,
    owner_id: number,
    created_by: number,
    task_priority: number,
    owner : {
        id: number,
        full_name: string
    },
    type: {
        id: number,
        type_name: string
    }
}

interface Props {
    tasks: Task[]
}

export default defineComponent({
    name: 'TasksIndex',
    props: {
        tasks: {type: Array as () => Task[], required: true}
    },
    setup(props:Props){
        const taskList: Ref<Task[]> = ref(props.tasks)

        return {
            taskList
        }
    }

})
</script>
