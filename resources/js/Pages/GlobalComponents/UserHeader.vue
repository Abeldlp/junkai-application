<template>
    <div class="header">
        <div class="header_information">
            <div>
                <h3>{{ userInfo.full_name }}</h3>
                <span>{{ today }}</span>
            </div>
            <VueFeather type="menu" @click="toggleMenu"/>
        </div>
        <DatePicker />
        <div class="links">
            <Link class="link" @click="toggleMenu" href="#">新項目追加</Link>
            <Link class="link" @click="toggleMenu" href="#">新優先順位追加</Link>
            <Link class="link" @click="toggleMenu" href="#">設定</Link>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, Ref, ref } from 'vue'
import VueFeather from 'vue-feather'
import { gsap } from 'gsap'
import { Link } from '@inertiajs/inertia-vue3'
import DatePicker from './DatePicker.vue'

interface User {
    full_name: string
}

interface Props {
    user: User
}

export default defineComponent({
    name: 'UserHeader',
    components: {
        VueFeather,
        Link,
        DatePicker
    },
    props: {
        user: {type: Object as () => User, required: true}
    },
    setup(props: Props) {
        const userInfo: Ref<User> = ref(props.user)
        const today: Ref<string> = ref(new Date().toLocaleDateString())
        const menuOpen: Ref<boolean> = ref(false)

        const toggleMenu = () => {
            menuOpen.value = !menuOpen.value
            if(menuOpen.value){
                gsap.to('.header', {height: '80vh', duration: 0.3})
                gsap.to('.link', {opacity: 1, y: 30, duration: 0.3})
            } else {
                gsap.to('.header', {height: '18vh', duration: 0.3})
                gsap.to('.link', {opacity: 0, y: -30, duration: 0.3})
            }
        }

        return {
            userInfo,
            today,
            toggleMenu
        }
    },
})
</script>

<style scoped>

.header {
    width: 100%;
    height: 18vh;
    color: white;
    padding: 15px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
    background: rgb(150,60,165);
    background: linear-gradient(0deg, rgba(150,60,165,1) 0%, rgba(114,161,215,1) 100%);
    overflow: hidden;
    box-shadow: 0px 5px 13px rgba(0, 0, 0, 0.25);
}

h3 {
    padding-top: 10px;
    padding-left: 10px;
}

span {
    padding-left: 10px;
    position: relative;
    bottom: 9px;
}

.header_information {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.links {
    display: flex;
    flex-direction: column;
    margin-top: 10vh;
}

.link {
    opacity: 0;
    color: white;
    border: solid 1px white;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
}

</style>

