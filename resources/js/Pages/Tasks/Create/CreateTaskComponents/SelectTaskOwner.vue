<template>
    <div>
        <select v-model="owner" @change="emitDataToParent">
            <option v-for="owner in possibleOwners" :key="owner.id" :value="owner.id">{{ owner.full_name }}</option>
        </select>
    </div>
</template>

<script lang="ts">
import { defineComponent, Ref, ref } from 'vue'

interface Owner {
    id: number,
    full_name: string
}

interface Props {
    owners: Owner[]
}

export default defineComponent({
    name: 'SelectOwner',
    props: {
        owners: {
            type: Array as () => Owner[],
            required: true
        }
    },
    setup(props:Props, { emit }){
        const possibleOwners: Ref<Owner[]> = ref(props.owners)
        const owner: Ref<number> = ref(0)

        const emitDataToParent = () => {
            return emit('dataToParent', owner)
        }

        return {
            possibleOwners,
            owner,
            emitDataToParent
        }
    }
})
