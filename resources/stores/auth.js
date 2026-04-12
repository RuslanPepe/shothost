import { defineStore } from 'pinia'
import axios from "axios";
import router from "../js/Router.js";

export const useAuthStore = defineStore('auth', {
    state: () => {
        return {
            user: [],
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
        }
    },

    actions: {
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

        userLogout() {
          axios.post('/api/logout')
              .then(res => {
                  console.log(res)
              })
        },

        userLogin() {

        }

    },

})
