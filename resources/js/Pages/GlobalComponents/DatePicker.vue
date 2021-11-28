<template>
    <div class="date_picker">
        <div 
            v-for="(date, index) in days" 
            :key="index"
            id="date_standard"
            :class="{ active: date === activeDate }"
            @click="selectDate(date)"
        >{{ dayFormated(date) }}</div>
    </div>
</template>
<script lang="ts">
import { defineComponent, Ref, ref } from 'vue'

export default defineComponent({
    name: 'DatePicker',
    setup() {
        const getWeekDays = () => {
            let result = [];
            for (let i=0; i<7; i++) {
                let d = new Date();
                d.setDate(d.getDate() - i);
                //@ts-ignore
                result.push( d )
            }
            return result.reverse()
        }

        const days: Ref<string[]> = ref(getWeekDays())

        const activeDate: Ref<Date|string> = ref('')

        const selectDate = (date: Date) => {
            activeDate.value = date
        }

        const dayFormated = (date: (Date)) => date.getDate()

        return {
            activeDate,
            selectDate,
            getWeekDays,
            days,
            dayFormated
        }
        
    },
})
</script>

<style scoped>

.date_picker {
    width: 80%;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

#date_standard {
    border-radius: 100%;
    height: 30px;
    width: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.active {
    background-color: white;
    color: purple;
}


</style>
