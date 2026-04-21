<template>
<!--    {{ linkStore.link }}-->
    <div class="titleContext" v-if="linkStore.link.title">
        <p class="title">Title: </p>{{ linkStore.link.title }}
    </div>

    <div class="descriptionContext" v-if="linkStore.link.description">
        <p class="description">Description: </p>{{ linkStore.link.description }}
    </div>

    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" v-for="(path, index) in linkStore.link.paths" data-bs-target="#carouselExampleIndicators" :class="{ active: index === 0 }" :data-bs-slide-to="index" :aria-current="{ true: index === 0 }" :aria-label="`Slide ${index+1}`"></button>
        </div>
        <div class="carousel-inner">
            <div v-for="(path, index) in linkStore.link.paths" class="carousel-item" :class="{ active: index === 0 }" :key="index">
                <img :src="`/${path}`" class="d-block w-100" alt="not found...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="row blockDownloadImage" v-if="linkStore.link.access === 'all'">
        <div class="col-12 d-flex">
            <button class="btn downloadImage" @click="linkStore.downloadImage()" id="downloadImage" type="button">
                Скачать фото
            </button>
            <button class="btn downloadImageAll" @click="linkStore.downloadImagesAll()" id="downloadImageAll" type="button">
                Скачать все фото
            </button>
        </div>
    </div>
</template>

<script setup>
import {useLinkStore} from "../stores/link.js";
import {onBeforeMount} from "vue";

const linkStore = useLinkStore()

onBeforeMount(() => {
  linkStore.getLink()
})

</script>


<style scoped>

</style>
