import { defineStore } from 'pinia'
import axios from "axios";
import router from "../Router.js";
import {useRoute} from "vue-router";

export const useLinkStore = defineStore('link', {
    state: () => {
        return {
            link: {

            }
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
        }
    },

})
