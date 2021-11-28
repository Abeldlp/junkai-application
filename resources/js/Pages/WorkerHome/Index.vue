<template>
    <div>
        <UserHeader :user="user"/>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import UserHeader from '../GlobalComponents/UserHeader.vue'

export default defineComponent({
    name: 'WorkerIndex',
    components: {
        UserHeader
    },
    setup(){
        const user = {
            full_name: '丸山祐介'
        }

        return {
            user
        }
    }
})
</script>

