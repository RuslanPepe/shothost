import { defineStore } from 'pinia'
import axios from "axios";
import router from "../Router.js";

export const useFileStore = defineStore('file', {
    state: () => {
        return {
            files: [],
        }
    },


    actions: {
        fileHandleInput(el) {
            console.log(el)
            Array.from(el).forEach((file) => {
                this.files.push(URL.createObjectURL(file))
                console.log(URL.createObjectURL(file))
            })
            // for (const file in el.item()) {
            //     console.log(file)
            // }
            // console.log(URL.createObjectURL(el.value))
        }

    },

})
