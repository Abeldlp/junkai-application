<template>
    <div class="login_body">
        <Link href="/login" class="login_body_button">
                ログイン
        </Link>
        <Link href="/register" class="login_body_button">
                登録
        </Link>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

export default defineComponent({
    name: 'HomeIndex',
    components: {
        Link,
    },
})
</script>

<style scoped>

.login_body {
    height: 100vh;
    width: 100%;
    display: flex;
    flex-direction: column;
    background: rgb(150,60,165);
    background: linear-gradient(0deg, rgba(150,60,165,1) 0%, rgba(114,161,215,1) 100%);
}

.login_body_button {
    color: black;
    background-color: white;
    margin: 20px auto;
    padding: 20px;
    text-align: center;
    width: 70%;
    border-radius: 5px;
}

</style>
