<template>
    <div>
        <p class="successful_message" v-if="saved && successfull">Saved</p>
        <p v-if="saved && !successfull">Something went wrong</p>
        <SelectTastType :taskTypes="taskTypes" @emitDataToParent="mergeChildData" />
        <SelectTaskOwner :owners="users" @emitDataToParent="mergeChildData"/>
    </div>
</template>

<script lang="ts">

import { defineComponent, Ref, ref } from 'vue'
import SelectTastType from './CreateTaskComponents/SelectTaskType.vue'
import SelectTaskOwner from './CreateTaskComponents/SelectTaskOwner.vue'
import axios from 'axios'

export default defineComponent({
    name: 'CreateTask',
    components: {
        SelectTastType,
        SelectTaskOwner
    },
    props: {
        taskTypes: Array,
        users: Array

    },
    setup(){

        const newTaskData: Ref<object> = ref({})

        const saved: Ref<boolean> = ref(false)
        const successfull: Ref<boolean> = ref(false)

        const mergeChildData = (data: any) => {
            newTaskData.value = {...newTaskData, data}
        }

        const saveNewTask = () => {
            axios.post('/tasks/save', newTaskData)
        }

        return {
            saved,
            successfull,
            saveNewTask,
            mergeChildData
         }
    }
})

</script>

<style scoped>

.successful_message {
    color: green
}

</style>
