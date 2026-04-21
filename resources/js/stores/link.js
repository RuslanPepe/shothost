import { defineStore } from 'pinia'
import axios from "axios";
import router from "../Router.js";
import {useRoute} from "vue-router";

export const useLinkStore = defineStore('link', {
    state: () => {
        return {
            link: {}
        }
    },

    getters: {
        // getShowImage: (state) => {
        //     return state.files[state.imageViewer.index]
        // }
    },

    actions: {
        getLink() {
            axios.get(`/api/get/data/link/${useRoute().params.id}`)
                .then(res => {
                    this.link = res.data
                    console.log(res)
                })
        },
        downloadImage() {
            let image = document.querySelector('.carousel-item.active').children[0].src

            axios.post('/api/download/image', {path: image}, {
                responseType: 'blob'
            })
                .then(res => {
                    const url = window.URL.createObjectURL(new Blob([res.data]))

                    const link = document.createElement('a')
                    link.href = url

                    link.setAttribute('download', crypto.randomUUID()+'.'+res.data.type.split('/')[1])

                    document.body.appendChild(link)
                    link.click()

                    link.remove()
                })
                .catch(err => {
                    console.log(err)
                })
        },

        downloadImagesAll() {
            axios.post('/api/download/image/all', {paths: this.link.paths}, {
                responseType: 'blob'
            })
                .then(res => {
                    const url = window.URL.createObjectURL(new Blob([res.data]))

                    const link = document.createElement('a')
                    link.href = url

                    link.setAttribute('download', crypto.randomUUID()+'.'+res.data.type.split('/')[1])

                    document.body.appendChild(link)
                    link.click()

                    link.remove()
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },

})
