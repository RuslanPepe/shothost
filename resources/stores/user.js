import { defineStore } from 'pinia'
import axios from "axios";
import router from "../js/Router.js";

export const useUserStore = defineStore('user', {
    state: () => {
        return {
            user: {
                name: '',
            },
            userRegData: {
                name: '',
                email: '',
                password: null,
                password_confirmed: null
            },
            userLoginData: {
                email: '',
                password: null
            },
            isLoaded: null,
        }
    },

    getters: {
        isAuth: (state) => {
            return !!state.user.name
        }
    },

    actions: {
        userAuthCheck() {
          if (this.isLoaded) return

            axios.get('/api/user')
                .then(res => {
                    this.user = res.data
                    this.isLoaded = true
                    console.log(res)
                })
                .catch(err => {
                    // this.isLoaded = false
                    console.log(err)
                })
        },

        userReg() {
            axios.get('sanctum/csrf-cookie')
                .then(res => {
                    axios.post('/api/register', {user: this.userRegData}, {
                        headers: {
                            Accept: 'application/json'
                        }
                    })
                        .then(res => {
                            console.log(res)
                            if (res?.status === 201) {
                                axios.get('/api/user')
                                    .then(res => {
                                        console.log(res)
                                        if (res.data.id) {
                                            router.push('/')
                                        }
                                    })
                            }
                        })
                })
        },
        userLogin() {
            axios.get('sanctum/csrf-cookie')
                .then(res => {
                    axios.post('/api/login', {user: this.userLoginData}, {
                        headers: {
                            Accept: 'application/json'
                        }
                    })
                        .then(res => {
                            console.log(res)
                            if (res?.status === 200) {
                                axios.get('/api/user')
                                    .then(res => {
                                        console.log(res)
                                        if (res.data.id) {
                                            router.push('/')
                                        }
                                    })
                                    .catch(err => {
                                        console.log(err)
                                    })
                            }
                        })
                })
        },

        userLogout() {
            axios.post('/api/logout')
                .then(res => {
                    console.log(res)
                })
        },

    },

})
