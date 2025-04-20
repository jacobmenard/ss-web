<script lang="ts" setup>
    const auth = useSanctumUser()
    const us = useUserStore()
    
    const openUploadImage = ref(false)
    const openChangePassword = ref(false)
    
    async function logoutUser() {
        await us.logoutUser()
    }
</script>

<template>
    <div class="header-main-container">
        <div class="d-flex justify-content-between header-menu gap-16 flex-wrap">
            <!-- <b-button variant="ss-header-button" class="border-red-1 btn-head d-flex align-items-center justify-content-center" href="/">SIPS&SPARKS</b-button> -->
            <nuxt-link to="/" class="btn-ss-header-button btn-head d-flex align-items-center justify-content-center">
                <img src="~assets/images/rectangle_logos.png" height="60" alt="">
            </nuxt-link>

            <div class="d-flex user-menu gap-20" :class="!auth ? 'justify-content-center' : ''">
                <div class="btn-menu-container d-flex align-items-center gap-5px border-red-1 px-5px height-50">
                    <!-- <b-button variant="ss-header-button" class="btn-menu">ABOUT US</b-button>
                    <b-button variant="ss-header-button" class="btn-menu">FAQ'S</b-button>
                    <b-button variant="ss-header-button" class="btn-menu">SUCCESS STORIES</b-button>
                    <b-button variant="ss-header-button" class="btn-menu"></b-button> -->
                    <nuxt-link to="/about-us" class="btn-menu letter-spacing-1 d-flex align-items-center">ABOUT US</nuxt-link>
                    <nuxt-link to="/faqs" class="btn-menu letter-spacing-1 d-flex align-items-center">FAQ'S</nuxt-link>
                    <nuxt-link to="/success-stories" class="btn-menu letter-spacing-1 d-flex align-items-center">SUCCESS STORIES</nuxt-link>
                    <nuxt-link to="/contact-us" class="btn-menu letter-spacing-1 d-flex align-items-center">CONTACT US</nuxt-link>
                    <nuxt-link to="/match-form" class="btn-menu letter-spacing-1 d-flex align-items-center">MATCH FORM</nuxt-link>

                </div>

                <div v-if="auth" class="btn-menu-container d-flex align-items-center justify-content-center gap-5px border-red-1 height-50 width-50 shadow">
                    <b-dropdown size="lg"  variant="link" toggle-class="text-decoration-none header-menu-list" no-caret>
                        <template #button-content>
                            <div class="user-header border-radius-100 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-center height-50 width-50 border-radius-30 overflow-hidden">
                                    <img :src="auth.data.profile_image" class="w-100 object-fit-contain" alt="">
                                </div>
                            </div>
                        </template>
                        <nuxt-link class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25" @click="us.setOpenUserInformation(true)">ACCOUNT INFORMATION</div>
                        </nuxt-link>
                        <nuxt-link class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25" @click="openUploadImage = true">CHANGE PROFILE IMAGE</div>
                        </nuxt-link>
                        <nuxt-link class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25" @click="openChangePassword = true">CHANGE PASSWORD</div>
                        </nuxt-link>

                        <nuxt-link class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25" @click="logoutUser">LOGOUT</div>
                        </nuxt-link>
                    </b-dropdown>
                </div>
            </div>
        </div>

        <div class="header-menu-mobile p-x-20 d-none justify-content-between align-items-center w-100 position-fixed">

            <nuxt-link to="/" class="btn-ss-header-button-mobile d-flex align-items-center justify-content-center border-white1-1">
                <div>
                    SIPS & SPARKS
                </div>
            </nuxt-link>

            <!-- <div class="hamburger-header-menu">
                <img src="~assets/images/hamburger.svg" alt="">
            </div> -->

            <!-- <div class="header-menu-list p-x-20 position-absolute w-100">
                <div class="d-flex flex-column gap-10">
                    <nuxt-link to="/about-us" class="">ABOUT US</nuxt-link>
                    <nuxt-link to="/faqs" class="">FAQ'S</nuxt-link>
                    <nuxt-link to="/success-stories" class="">SUCCESS STORIES</nuxt-link>
                    <nuxt-link to="/contact-us" class="">MATCH FORM</nuxt-link>
                </div>
            </div> -->

            <div class="d-flex gap-20">
                <div class="d-flex gap-10 align-items-center">
                    <b-dropdown size="lg"  variant="link" toggle-class="text-decoration-none header-menu-list" no-caret>
                        <template #button-content>
                            <img src="~assets/images/hamburger.svg" alt="">
                        </template>
                        <nuxt-link to="/" class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25">HOME</div>
                        </nuxt-link>
                        <nuxt-link to="/about-us" class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25">ABOUT US</div>
                        </nuxt-link>
                        <nuxt-link to="/faqs" class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25">FAQ'S</div>
                        </nuxt-link>
                        <nuxt-link to="/success-stories" class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25">SUCCESS STORIES</div>
                        </nuxt-link>
                        <nuxt-link to="/contact-us" class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25">CONTACT US</div>
                        </nuxt-link>
                        <nuxt-link to="/match-form" class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25">MATCH FORM</div>
                        </nuxt-link>
                    </b-dropdown>
                </div>

                <div v-if="auth" class="d-flex gap-10 align-items-center">
                    <b-dropdown size="lg"  variant="link" toggle-class="text-decoration-none header-menu-list" no-caret>
                        <template #button-content>
                            <div class="user-header border-radius-100 overflow-hidden">
                                <img :src="auth.data.profile_image" height="30" class="object-fit-contain" alt="">
                            </div>
                        </template>
                        <nuxt-link class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25" @click="us.setOpenUserInformation(true)">ACCOUNT INFORMATION</div>
                        </nuxt-link>
                        <nuxt-link class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25" @click="openUploadImage = true">CHANGE PROFILE IMAGE</div>
                        </nuxt-link>
                        <nuxt-link class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25" @click="openChangePassword = true">CHANGE PASSWORD</div>
                        </nuxt-link>

                        <nuxt-link class="list fw-bold text-decoration-none text-nowrap">
                            <div class="item p-y-5 p-x-25" @click="logoutUser" >LOGOUT</div>
                        </nuxt-link>
                    </b-dropdown>
                </div>
            </div>


        </div>
        

        <modal-upload-image v-model="openUploadImage" @close="openUploadImage = false"></modal-upload-image>
        <modal-change-password v-model="openChangePassword" @close="openChangePassword = false"></modal-change-password>

    </div>
</template>

<style lang="scss">
    .header-main-container {
        padding-top: 2rem;
        padding-bottom: 4rem;
        @include resolution(768px) {
            padding-top: 0px;
            padding-bottom: 100px;
        }

        @include resolution(1200px) {
            .btn-head {
                display: none !important;
            }

            .user-menu {
                width: 100%;
                justify-content: space-between;
            }
        }
        .header-menu {
            @include resolution(768px) {
                display: none !important;
            }
        }

        .header-menu-mobile {
            @include resolution(768px) {
                display: flex !important;
                height: 70px;
                background-color: $red;
                left: 0px;
                z-index: 1;
            }
        }
        .btn-head {
            height: auto !important;
            letter-spacing: 10;

            &:hover {
                background: none !important;
            } 
        }

        .btn-menu {
            height: 36px;
            letter-spacing: 10;
            cursor: pointer;
            @include font-custom(20px, 20px, 700, $red) {
                border-radius: 55px !important;
                height: 36px;
                padding: 0px 1rem !important;
                transition: 0.3s;
                text-decoration: none;
            }

            @include resolution(850px) {
                font-size: 16px !important;
            }

            &:hover, &.router-link-exact-active {
                background-color: $red !important;
                color: $white1 !important;
            }
        }

        .btn-menu-container {
            border-radius: 55px;
            gap: 5px;
            @include resolution(768px) {
                height: auto !important;
                padding: 10px;
            }
        }

        .header-menu-list {
            padding: 0px;
            // max-height: 0px;
            // transition: 0.3s;
            // opacity: 0;
            // background-color: $red;
            // top: 70px;
            // left: 0;

            // &.show {
            //     max-height: 500px;
            //     opacity: 1;
            // }

            ~ .dropdown-menu {
                background-color: $red;
                z-index: 10;
                .list {
                    color: $white1;
                    > .item {
                        &:hover {
                            background-color: $white1 !important;
                            color: $red;
                        }
                    }

                    &.router-link-active {
                        > .item {
                            background-color: $white1 !important;
                            color: $red;
                        }
                    }
                }

            }
        }
        
        .user-header {
            background-color: $white2;
        }
    }
</style>