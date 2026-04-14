import { defineStore } from 'pinia'
import axios from "axios";
import router from "../Router.js";

export const useFileStore = defineStore('file', {
    state: () => {
        return {
            // files: [],
            files: [
                "/screenshot-2026-03-25-17:10:31.png",
                // "/screenshot-2026-03-25-17:10:43.png",
                // "/screenshot-2026-03-25-17:11:21.png",
                // "/screenshot-2026-03-25-17:12:02.png",
                // "/screenshot-2026-03-25-17:12:29.png",
            ],
            imageBlock: {},
            inputFile: {},
            arrowShow: false
        }
    },


    actions: {
        checkWidth() {
            if (!this.imageBlock) return
            this.arrowShow = this.imageBlock.scrollWidth > this.imageBlock.clientWidth
        },

        fileHandleInput() {
            Array.from(this.inputFile.files).forEach((file) => {
                this.files.push(URL.createObjectURL(file))
                console.log(URL.createObjectURL(file))
            })
            this.inputFile.value = null
        },

        scrollRight() {
            this.imageBlock.scrollBy(300, 0, "smooth")
        },

        scrollLeft() {
            this.imageBlock.scrollBy(-300, 0, "smooth")
        }
    },

})
