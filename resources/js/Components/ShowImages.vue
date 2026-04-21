<template>
    <div class="blockImages">
        <div class="blockImage d-flex justify-content-center align-items-center z-50">
            <img :src="fileStore.getShowImage?.url" class="imageView" alt="err">
        </div>
        <div class="btnSwipeImage position-absolute">
            <button class="btnSwipeImageLeft my-auto" :disabled="fileStore.imageViewer.index <= 0" @click.prevent="fileStore.setViewerImageId(fileStore.imageViewer?.index-1)"><</button>
            <button class="btnSwipeImageRight my-auto" :disabled="fileStore.imageViewer.index >= fileStore.files.length-1 " @click.prevent="fileStore.setViewerImageId(fileStore.imageViewer?.index+1)">></button>
        </div>
        <button class="btnClose position-absolute" @click.prevent="fileStore.closeViewerImage()">X</button>
        <div class="blockMetadata">
            <p class="blockMetadataTitle">{{ fileStore.getShowImage?.file?.name }}</p>
            <p class="blockMetadataCounter">{{ fileStore.imageViewer.index+1+' из '+fileStore.files.length }}</p>
        </div>
    </div>
</template>

<script setup>

import {useFileStore} from "../stores/file.js";

const fileStore = useFileStore()


</script>

<style scoped>
.btnClose {
    top: 12px;
    right: 12px;
    font-size: 24px;
    border: none;
    background: none;
    color: white;
}
.imageView {
    display: flex;
    justify-content: center;
    max-width: 70%;
    max-height: 70%;

}
.btnSwipeImage {
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    button {
        position: absolute;
        height: 100%;
        font-size: 24px;
        color: white;
        background: none;
        border: none;
        width: 72px;
    }
}
.btnSwipeImageLeft {
    left: 0;
}
.btnSwipeImageRight {
    right: 0;
}
.blockImages {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.8);
    z-index: 2;
}
.blockImage {
    //top: 0;
    width: 100%;
    height: 100%;
}
.blockMetadata {
    p {
        margin: 0;
    }
    margin: 0;
    position: absolute;
    bottom: 16px;
    left: 16px;
}
.blockMetadataTitle {
    width: 250px;
    margin: 0;
}
</style>
