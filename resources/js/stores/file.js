import { defineStore } from 'pinia'
import axios from "axios";
import router from "../Router.js";

export const useFileStore = defineStore('file', {
    state: () => {
        return {
            // files: [],
            files: [
                "/screenshot-2026-03-25-17:10:31.png",
                "/screenshot-2026-03-25-17:10:31.png",
                "/screenshot-2026-03-25-17:10:31.png",
                "/screenshot-2026-03-25-17:10:31.png",
                "/screenshot-2026-03-25-17:10:31.png",
            ],

        }
    },


    actions: {
        fileHandleInput(el) {
            console.log(el)
            Array.from(el.files).forEach((file) => {
                this.files.push(URL.createObjectURL(file))
                console.log(URL.createObjectURL(file))
            })
            el.value = null
            console.log(this.files)
            // for (const file in el.item()) {
            //     console.log(file)
            // }
            // console.log(URL.createObjectURL(el.value))
        }

    },

})
