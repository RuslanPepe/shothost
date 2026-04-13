<template>
    <div class="upload-area" @click="$refs.inputFile.click()">
        Нажми или перетащи фото 📷
    </div>
    <input id="formFileMultiple" ref="inputFile" type="file" accept="image/*" @input="fileStore.fileHandleInput($refs.inputFile.files)" multiple hidden>
    <div class="carouserContainer">
        <div class="preview" id="preview">
            <button class="" id="scrollLeft">‹</button>
            <img v-for="file in fileStore.files" :src="file" alt="err...">
            <button class="" id="scrollRight">›</button>
        </div>
    </div>



</template>

<script setup>

import {useFileStore} from "../stores/file.js";
import {watch} from "vue";

const fileStore = useFileStore()

// watch(fileStore.file, (old,))


</script>

<style scoped>
.preview {
    height: 300px;
}

</style>
