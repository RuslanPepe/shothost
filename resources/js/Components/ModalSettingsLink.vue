<template>
    <div class="modal fade" id="modalSettings" tabindex="-1" aria-labelledby="modalSettingsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modalSettings">
                <div class="modal-header modalSettingsHeader">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Настройки ссылки</h1>
                    <button type="button" class="btn-close" data-bs-theme="dark" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="lifeTime ">
                            <div class="modalSettingsTitle" style="padding: 0 0 16px 0;">Life time</div>
                            <div class="d-flex gap-1">
                                <input type="radio" class="btn-check" name="lifetime" id="option1" v-model="fileStore.settingsLink.lifetime" value="1" autocomplete="off" checked>
                                <label class="btn btnSecondary" for="option1">1</label>

                                <input type="radio" class="btn-check" name="lifetime" id="option2" v-model="fileStore.settingsLink.lifetime" value="3" autocomplete="off">
                                <label class="btn btnSecondary" for="option2">3</label>

                                <input type="radio" class="btn-check" name="lifetime" id="option3" v-model="fileStore.settingsLink.lifetime" value="7" autocomplete="off">
                                <label class="btn btnSecondary" for="option3">7</label>

                                <input type="radio" class="btn-check" name="lifetime" id="option4" v-model="fileStore.settingsLink.lifetime" value="14" autocomplete="off">
                                <label class="btn btnSecondary" for="option4">14</label>

                                <input type="radio" class="btn-check" name="lifetime" id="option5" v-model="fileStore.settingsLink.lifetime" value="21" autocomplete="off">
                                <label class="btn btnSecondary" for="option5">21</label>

                                <input type="radio" class="btn-check" name="lifetime" id="option6" v-model="fileStore.settingsLink.lifetime" value="30" autocomplete="off">
                                <label class="btn btnSecondary" for="option6">30</label>

                                <div style="">
                                    <input type="number" class="form-control inputLifeTime modalSettingsInput" id="lifetimeInput" v-model="fileStore.settingsLink.lifetime"  min="0" max="365" aria-describedby="basic-addon1">
                                    <p style="position: absolute;">max: 365 days</p>
                                </div>

                            </div>
                        </div>

                        <div class="access">
                            <div class="modalSettingsTitle">Access</div>
                            <div class="d-flex gap-1">
                                <input type="radio" class="btn-check" name="access" id="access1" v-model="fileStore.settingsLink.access" value="link" autocomplete="off" checked>
                                <label class="btn btnSecondary" for="access1">Link</label>

                                <input type="radio" class="btn-check" name="access"  id="access2" v-model="fileStore.settingsLink.access" value="password" autocomplete="off">
                                <label class="btn btnSecondary" for="access2">Password</label>

                                <input type="radio" class="btn-check" name="access" id="access3" v-model="fileStore.settingsLink.access" :disabled="!userStore.isAuth" value="private" autocomplete="off">
                                <label class="btn btnSecondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Доступно при авторизации" for="access3">Private</label>
                            </div>
                            <p v-if="!userStore.isAuth" style="color: rgb(255,0,0, .6); margin: 0">Private доступно при авторизации</p>
                        </div>

                        <div class="Password" id="passwordBlock" v-if="fileStore.settingsLink.access === 'password'">
                            <div class="modalSettingsTitle" id="Password">Password</div>
                            <input type="password" class="form-control modalSettingsInputPassword modalSettingsInput" v-model="fileStore.settingsLink.password" name="password" id="PasswordInput">
                        </div>

                        <div class="deleteAfter">
                            <div class="modalSettingsTitle" >Delete after views</div>
                            <div class="inputModalSettings d-flex gap-1">
                                <input type="radio" class="btn-check" name="deleteAfter" id="deleteAfter1" v-model="fileStore.settingsLink.deleteAfter" value="" autocomplete="off" checked>
                                <label class="btn btnSecondary" for="deleteAfter1">none</label>

                                <input type="radio" class="btn-check" name="deleteAfter" id="deleteAfter2" v-model="fileStore.settingsLink.deleteAfter" value="1" autocomplete="off">
                                <label class="btn btnSecondary" for="deleteAfter2">1</label>

                                <input type="radio" class="btn-check" name="deleteAfter" id="deleteAfter3" v-model="fileStore.settingsLink.deleteAfter" value="5" autocomplete="off">
                                <label class="btn btnSecondary" for="deleteAfter3">5</label>

                                <input type="radio" class="btn-check" name="deleteAfter" id="deleteAfter4" v-model="fileStore.settingsLink.deleteAfter" value="10" autocomplete="off">
                                <label class="btn btnSecondary" for="deleteAfter4">10</label>

                                <div>
                                    <input type="number" class="form-control inputDeleteAfter modalSettingsInput" name="deleteAfter" id="deleteAfter5" v-model="fileStore.settingsLink.deleteAfter" min="0" max="365" aria-describedby="basic-addon1">
                                    <p style="position: absolute;">max: 30 days</p>
                                </div>

                            </div>
                        </div>

                        <div class="typeAccess">
                            <div class="modalSettingsTitle">Type access</div>
                            <div class="inputModalSettings d-flex gap-1">
                                <input type="radio" class="btn-check" name="typeAccess" id="typeAccess1" v-model="fileStore.settingsLink.typeAccess" value="onlyView" autocomplete="off" checked>
                                <label class="btn btnSecondary" for="typeAccess1">Only view</label>

                                <input type="radio" class="btn-check" name="typeAccess" id="typeAccess2" v-model="fileStore.settingsLink.typeAccess" value="all" autocomplete="off" >
                                <label class="btn btnSecondary" for="typeAccess2">All</label>

                            </div>
                        </div>

                        <div class="Title">
                            <div class="modalSettingsTitle">Title</div>
                            <input type="text" class="form-control modalSettingsInputTitle modalSettingsInput" v-model="fileStore.settingsLink.title" value="" name="Title" id="Title">
                        </div>

                        <div class="Description">
                            <div class="modalSettingsTitle">Description</div>
                            <input type="text" class="form-control modalSettingsInputDescription modalSettingsInput" v-model="fileStore.settingsLink.description" name="Description" id="Description">
                        </div>

                        <div class="CustomLink">
                            <div class="modalSettingsTitle">Custom link</div>
                            <div class="input-group mb-3">
                                <span class="input-group-text modalSettingsSpan" id="customLinkLabel">hostshot.ru/l/</span>
                                <input type="text" aria-describedby="customLinkLabel" autocomplete="off" v-model="fileStore.settingsLink.customLinkLabel" class="form-control modalSettingsInputCustomLink modalSettingsInput" name="CustomLink" id="CustomLink">
                            </div>
                        </div>
                    </div>
                <div class="modal-footer modalSettingsFooter">
                    <button type="button" class="btn modalSettingsBtn" data-bs-dismiss="modal">Закрыть</button>
                </div>
                {{ fileStore.settingsLink }}
            </div>
        </div>
    </div>


</template>

<script setup>
import {useUserStore} from "../stores/user.js";
import {useFileStore} from "../stores/file.js";

const userStore = useUserStore()
const fileStore = useFileStore()

</script>

<style scoped>

</style>
