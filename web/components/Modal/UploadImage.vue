
<script lang="ts" setup>
    import { nextTick, onMounted, ref, watch } from "vue"

    const us = useUserStore()

    const props = defineProps<{
        info: any
    }>()

    const files = ref(null)
    
    const profile_image = ref(null)
    const selected_image = ref(null)
    const isAlreadySelect = ref(false)
    const isUploading = ref(false)

    function previewImage(e: any) {
        profile_image.value = e.target.files[0]
        selected_image.value = URL.createObjectURL(e.target.files[0])
        isAlreadySelect.value = true
    }

    const emit = defineEmits(['close'])

    async function userUploadImage() {
        if (!profile_image.value) {
            return
        }
        isUploading.value = true

        let bodyFormData = new FormData()
        bodyFormData.append('profily_type', profile_image.value.type)
        bodyFormData.append('profile_image', profile_image.value, profile_image.value.name)

        await us.uploadImage(bodyFormData)

        emit('close')
    }

    onMounted(async () => {
        // await nextTick()
        // await us.get()
        // if (us.getUser.profile_image) {
        //     selected_image.value = us.getUser.profile_image
        // } else {
        //     selected_image.value = null
        // }
    }) 

    watch(() => props.info, async(val: any) => {
        if (val) {
            if (val.profile_image) {
                selected_image.value = val.profile_image
            } else {
                selected_image.value = null
            }
        }
    })
</script>

<template>
    <b-modal size="md" no-footer title="Upload your profile image" :hide-header="true" :hide-header-close="true" :no-close-on-esc="true" centered id="upload-img-modal" class="ss-default-modal">
        <div class="upload-img-container">
            <div class="d-flex flex-column gap-10 mb-3">
                
                <div v-if="profile_image" class="mt-2">
                    <span>
                        Filename:
                        <span class="truncate truncate--1">{{ profile_image.name }}</span>
                    </span>
                </div>
                <div>{{ profile_image.type }}</div>

                <div class="d-flex align-items-center justify-content-center border border-radius-10 overflow-hidden shadow min-height-250">
                    <img v-if="selected_image" :src="selected_image" class="w-100 object-fit-contain max-height-500" alt="">

                    <img v-else class="object-fit-contain" height="190" src="~assets/images/profile-group.svg" alt="">
                </div>

                <div class="d-flex flex-column justify-content-between align-items-center gap-10 my-2">
                    <b-button variant="primary" class="w-100" @click="$refs.profileImage.click()" :disabled="isUploading">{{ isAlreadySelect ? 'CHANGE AN IMAGE TO UPLOAD' : 'SELECT AN IMAGE TO UPLOAD' }}</b-button>
                    <input type="file" ref="profileImage" @change="previewImage" accept=".jpeg, .jpg" class="d-none">
                    
                    <b-button v-if="isAlreadySelect && !isUploading" variant="ss-primary-button" class="w-100" @click="userUploadImage" :disabled="isUploading">UPLOAD SELECTED IMAGE</b-button>
                    <b-button v-if="isAlreadySelect && isUploading" variant="ss-primary-button" class="w-100" :disabled="isUploading">                            
                        <b-spinner variant="light" small class="mr-2"></b-spinner>
                    </b-button>     
                </div>
            </div>
        </div>
    </b-modal>
</template>

<style lang="scss">
    .upload-img-container {

    }
</style>
