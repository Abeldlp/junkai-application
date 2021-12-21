<template>
  <div class="login_body">
    <LoginPage class="login_component" />
    <RegisterPage class="register_component" />
    <div class="login_body_logo_container">
      <VueFeather type="codepen" class="login_body_logo" />
      <h3>巡回アプリ</h3>
    </div>
    <div ref="loginBody" class="login_body_button_container">
      <div @click="openLoginPage" class="login_body_button">ログイン</div>
      <div @click="openRegisterPage" class="login_body_button">登録</div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import VueFeather from "vue-feather";
import LoginPage from "./Components/LoginPage.vue";
import RegisterPage from "./Components/RegisterPage.vue";
import { gsap } from "gsap";

export default defineComponent({
  name: "HomeIndex",
  components: {
    VueFeather,
    LoginPage,
    RegisterPage,
  },
  setup() {
    const openLoginPage = () => {
      gsap.to(".login_body_button_container, .login_body_logo_container", {
        opacity: 0,
        duration: 0.3,
        x: "100vw",
      });
      gsap.to(".login_component", { duration: 0.3, x: "100%" });
    };

    const openRegisterPage = () => {
      gsap.to(".login_body_button_container, .login_body_logo_container", {
        opacity: 0,
        duration: 0.3,
        x: "100vw",
      });
      gsap.to(".register_component", { duration: 0.3, x: "100%" });
    };

    return {
      openLoginPage,
      openRegisterPage,
    };
  },
});
</script>

<style scoped>
.login_body {
  color: white;
  height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background: rgb(150, 60, 165);
  background: linear-gradient(
    0deg,
    rgba(150, 60, 165, 1) 0%,
    rgba(114, 161, 215, 1) 100%
  );
  overflow: hidden;
}

.login_body_button_container,
.login_body_logo_container {
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  transition: all ease-in-out 0.3s;
}
.login_body_logo_container {
  height: 50vh;
}

.login_body_button_container {
  height: 50vh;
}

.login_body_logo {
  color: white;
  height: 100px;

  margin: 20px auto;
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

.page_open {
  right: 0;
}

.page_closed {
  right: 100%;
}
</style>
