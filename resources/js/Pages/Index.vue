<template>
    <div class="upload-area user-select-none" @click="inputFile.click()">
        Нажми или перетащи фото 📷
    </div>
    <input id="formFileMultiple" ref="inputFile" type="file" accept="image/*" @input="fileStore.fileHandleInput()" multiple hidden>
    <div class="carouserContainer flex-column" v-if="fileStore.files.length">
        <div class="row">
            <div class="col-1">
                <p class="arrowButton ms-auto user-select-none text-end" v-if="fileStore.arrowShow" id="scrollLeft" @click="fileStore.scrollLeft()">‹</p>
            </div>
            <div class="col-10">
                <div class="preview position-relative align-items-center" ref="imageBlock" id="preview">
                    <div class="imageBlock position-relative user-select-none" v-for="(file) in fileStore.files" :key="file.id">
                        <button type="button" class="btnRemoveImage align-items-center justify-content-center" @click="fileStore.fileRemove(file.id)" >x</button>
                        <img height="280" :src="file.url" alt="err..." @click="fileStore.setViewerImageIndex(file.id)">
                    </div>
                </div>
            </div>
            <div class="col-1">
                <p class="arrowButton user-select-none" v-if="fileStore.arrowShow" id="scrollRight" @click="fileStore.scrollRight()">›</p>
            </div>
        </div>
    </div>

<!--    {{ fileStore.imageViewer }}-->

    <ShowImages v-if="fileStore.imageViewer.status" />

</template>

<script setup>

import {useFileStore} from "../stores/file.js";
import {nextTick, onBeforeUnmount, onMounted, reactive, ref, watch} from "vue";
import ShowImages from "../Components/ShowImages.vue";

const fileStore = useFileStore()
const imageBlock = ref()
const inputFile = ref()

fileStore.imageBlock = imageBlock
fileStore.inputFile = inputFile

watch(fileStore.files, async () => {
    await nextTick()
    await fileStore.checkWidth
})

onMounted(() => {
    fileStore.checkWidth()
    window.addEventListener('resize', fileStore.checkWidth)
})

onBeforeUnmount(() => {
    window.removeEventListener('resize', fileStore.checkWidth)
})


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
    z-index: 0;
    width: 24px;
    height: 24px;
}
.preview {
    height: 300px;
}

.arrowButton {
    cursor: pointer;
    background: none;
    border: none;
    color: white;
    font-size: 32px;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
    //width: 100%;
}

</style>
