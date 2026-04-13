<template>
    <nav class="navbar header">
        <div class="container-fluid d-flex align-items-center position-relative">

            <router-link
                class="navbar-brand text-white position-absolute start-50 translate-middle-x"
                to="/">
                HostShot
            </router-link>

            <div class="ms-auto d-flex gap-2">
                <router-link v-show="!userStore.isAuth && userStore.isLoaded" class="btn-navbar px-2 py-1" to="/reg">Reg</router-link>
                <router-link v-show="!userStore.isAuth && userStore.isLoaded" class="btn-navbar px-2 py-1" to="/login">Login</router-link>
            </div>

        </div>
    </nav>

    <div class="container mt-4">
        <router-view></router-view>
    </div>

</template>

<script setup>

import {useUserStore} from "../../stores/user.js";

const userStore = useUserStore()

</script>

<style>
.btn-navbar {
    text-decoration: none;
    color: white;
    border: white solid 1px;
    border-radius: 5px;
}
</style>
