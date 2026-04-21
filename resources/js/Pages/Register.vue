<template>
    <div class="regBlock mx-auto mt-5">
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" v-model="userStore.userRegData.name" class="form-control" id="name" placeholder="Name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Почта</label>
            <input type="email" v-model="userStore.userRegData.email" class="form-control" id="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" v-model="userStore.userRegData.password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label for="password_confirmed" class="form-label">Повторите пароль</label>
            <input type="password" v-model="userStore.userRegData.password_confirmed" class="form-control" id="password_confirmed">
        </div>
        <div class="mb-3 mt-4">
            <button class="btn btn-outline-light mx-auto w-100" @click.prevent="userStore.userReg()">Зарегистрироваться</button>
        </div>
    </div>
<!--    {{ userStore.userRegData }}-->
<!--    {{ userStore.user }}-->
<!--    {{ userStore.isAuth }}-->

</template>

<script setup>

import {useUserStore} from "../stores/user.js";

const userStore = useUserStore()


</script>

<style scoped>
.regBlock {
    width: 30%;
    input {
        background: rgba(255, 255, 255, 0.9);
        border: none;
    }
}
</style>
