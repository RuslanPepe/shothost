import { createRouter, createWebHistory } from "vue-router";
import Home from "./Pages/Home.vue";
import Index from "./Pages/Index.vue";
import Register from "./Pages/Register.vue";
import Login from "./Pages/Login.vue";
import AccessImage from "./Pages/AccessImage.vue";
import Link from "./Pages/Link.vue";
import {useUserStore} from "./stores/user.js";


const routes = [
    {
        path: '/',
        name: 'index',
        component: Index
    },
    {
        path: '/reg',
        name: 'user.reg',
        component: Register
    },
    {
        path: '/login',
        name: 'user.login',
        component: Login
    },
    {
        path: '/access/image',
        name: 'image.access',
        component: AccessImage
    },
    {
        path: '/l/:id',
        name: 'link.imageView',
        component: Link
    },
    // {
        // path: '',
        // name: 'index',
        // component: Index
    // },
    // {
    //     path: '/home',
    //     name: 'home',
    //     component: Home
    // },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// router.beforeEach(async(to, from) => {
//     const useUser = useUserStore()
//     const isAuth = useUser.isAuth
//
//     const publicPages = ['user.login', 'user.reg']
//     const pathAuth = publicPages.includes(to.name)
//
//     if (pathAuth && !isAuth) {
//         return true
//     }
//
//     if (!pathAuth && !isAuth) {
//         return {name:'user.reg'}
//     }
//
//     if (pathAuth && isAuth) {
//         return {name:'post.index'}
//     }
//
//     return true
// })

export default router
