<template>
    <div class="upload-area" @click="$refs.inputFile.click()">
        Нажми или перетащи фото 📷
    </div>
    <input id="formFileMultiple" ref="inputFile" type="file" accept="image/*" @input="fileStore.fileHandleInput($refs.inputFile)" multiple hidden>
    <div class="carouserContainer flex-column" v-if="fileStore.files.length">
        <div class="row">
            <div class="col-1 d-flex">
                <button class="arrowButton ms-auto" id="scrollLeft">‹</button>
            </div>
            <div class="col-10">
                <div class="preview position-relative align-items-center"  id="preview">
                    <div class="imageBlock position-relative" v-for="(file, index) in fileStore.files" :key="index">
                        <button type="button" class="btnRemoveImage align-items-center justify-content-center">x</button>
                        <img height="280" :src="file" alt="err...">
                    </div>
                </div>
            </div>
            <div class="col-1">
                <button class="arrowButton" id="scrollRight">›</button>
            </div>
        </div>
    </div>
<!--    {{ fileStore.files.length }}-->



</template>

<script setup>

import {useFileStore} from "../stores/file.js";
import {watch} from "vue";

const fileStore = useFileStore()

// watch(fileStore.file, (old,))


</script>

<style scoped>
.btnRemoveImage {
    position: absolute;
    background: rgba(255,255,255,.03);
    border-radius: 5px;
    border: none;
    margin: 0;
    padding: 0;
    color: white;
    right: -10px;
    top: -10px;
    font-size: 16px;
    z-index: 3;
    width: 24px;
    height: 24px;
}
.preview {
    height: 300px;
}

.arrowButton {
    background: none;
    border: none;
    color: white;
    font-size: 32px;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
}

</style>
