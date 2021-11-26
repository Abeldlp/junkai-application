<template>
    <div>
        <select v-model="task_type" @change="emitDataToParent">
            <option v-for="type in types" :key="type.id" :value="type.id">{{ task.task_name }}</option>
        </select>
    </div>
</template>

<script lang="ts">

import { defineComponent, Ref, ref } from 'vue'

interface TaskType {
    id: number,
    type_name: string
}

interface Props {
    taskTypes: TaskType[]
}

export default defineComponent({
    name: 'SelectTaskType',
    props: {
        taskTypes: {
            type: Array as () => TaskType[],
            required: true
        }
    },
    setup(props:Props, { emit }){
        const types: Ref<TaskType[]> = ref(props.taskTypes)
        const task_type: Ref<number> = ref(0)

        const emitDataToParent = () => {
            return emit('dataToParent', task_type)
        }

        return {
            types,
            task_type,
            emitDataToParent
        }
    }
})
</script>
