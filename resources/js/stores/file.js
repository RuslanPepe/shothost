import { defineStore } from 'pinia'
import axios from "axios";
import router from "../Router.js";

export const useFileStore = defineStore('file', {
    state: () => {
        return {
            files: [
                // {
                //     id: null,
                //     file: {},
                //     url: '',
                // }
            ],
            imageBlock: {},
            inputFile: {},
            arrowShow: false,
            imageViewer: {
                id: null,
                index: null,
                status: false,
            },
            settingsLink: {
                lifetime: 1,
                access: 'link',
                password: null,
                deleteAfter: null,
                typeAccess: 'onlyView',
                title: '',
                description: '',
                customLinkLabel: '',
            },
        }
    },

    getters: {
        getShowImage: (state) =>{
            return state.files[state.imageViewer.index]
        }
    },

    actions: {
        checkWidth() {
            if (!this.imageBlock) return
            this.arrowShow = this.imageBlock.scrollWidth > this.imageBlock.clientWidth
        },

        fileRemove(id) {
            const index = this.files.findIndex(f => f.id === id)
            if (index !== -1) {
                URL.revokeObjectURL(this.files[index].url)
                this.files.splice(index, 1)
            }
        },

        fileHandleInput() {
            Array.from(this.inputFile.files).forEach((file) => {
                this.files.push({
                    id: Date.now() + Math.random(),
                    file: file,
                    url: URL.createObjectURL(file),
                })
                console.log(this.files)
            })
            this.inputFile.value = null
        },

        scrollRight() {
            this.imageBlock.scrollBy(300, 0, "smooth")
        },

        scrollLeft() {
            this.imageBlock.scrollBy(-300, 0, "smooth")
        },

        setViewerImageIndex(id) {
            console.log(id)
            this.imageViewer.index = this.files.findIndex(f => f.id === id)
            console.log(this.imageViewer.index)
            this.imageViewer.status = this.imageViewer.index !== -1
            this.imageViewer.id = this.imageViewer.index !== -1 ? id : null
        },

        setViewerImageId(id) {
            if(this.imageViewer.index < 0 ) return

            console.log(id)
            Object.assign(this.imageViewer, {
                    id: null,
                    index: null,
                    status: false,
            })
            this.imageViewer.index = id in this.files ? id : null
            console.log(this.imageViewer.index)
            this.imageViewer.status = this.imageViewer.index !== -1
            this.imageViewer.id = this.imageViewer.index !== -1 ? id : null
        },

        closeViewerImage() {
            Object.assign(this.imageViewer, {
                id: null,
                index: null,
                status: false,
            })
        }

    },

})
