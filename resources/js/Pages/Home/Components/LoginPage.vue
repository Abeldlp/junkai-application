<template>
    <div class="login_page">
        <p>email</p>
        <input v-model="loginData.em "/>
        <p>password</p>
        <input/>
    </div>
</template>

<script lang="ts"> 
import { defineComponent, reactive } from 'vue'

export default defineComponent({
    name: 'LoginPage',
    setup(){
        const loginData = reactive({
            email: '',
            password: ''
        })

        return {
            loginData
        }
    }
})
</script>

<style scoped>
    .login_page {
        transition: all ease-in-out 0.3s;
        background: rgb(150,60,165);
        background: linear-gradient(0deg, rgba(150,60,165,1) 0%, rgba(114,161,215,1) 100%);
        position: absolute;
        height: 100vh;
        width:100%;
        right: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    input {
        margin: 10px;
    }
</style>
