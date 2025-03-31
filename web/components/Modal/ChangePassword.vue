<script lang="ts" setup>
    import { ref } from "vue"

    const us = useUserStore()
    const auth = useSanctumUser();

    const emit = defineEmits(['close'])

    const newPassword = ref('')
    const confirmPassword = ref('')

    const typeNewPassword = ref('password')
    const typeConfirmPassword = ref('password')
    const isLoading = ref(false)

    const props = defineProps<{
        info: any,
        isOpenModal: any
    }>()


    async function changePassword() {
        if (newPassword.value != confirmPassword.value) {
            
            useNuxtApp().$toast('New password and confirm password not match', {type: 'error'});
            return
        }
        isLoading.value = true
        await us.changeUserPassword({ password: newPassword.value })
        
        isLoading.value = false
        emit('close')
    }
</script>

<template>
    <b-modal size="md" no-footer title="Reset your password" :hide-header="true" :hide-header-close="true" :no-close-on-esc="true" :no-close-on-backdrop="true" centered id="reset-password   " class="ss-default-modal">
        <div class="change-password-container d-flex flex-column justify-content-between align-items-center gap-10 my-2 px-4">
            <b-form @submit.stop.prevent="changePassword" class="w-100">
                <div class="w-100 position-relative mb-3">
                    <span class="d-block mb-2">New password:</span>
                    <b-input :type="typeNewPassword" v-model="newPassword" class="ss-input-default w-100 fw-bold" placeholder="" required></b-input>
                    <div class="position-absolute d-flex align-items-center showpassword">
                        <img v-if="typeNewPassword == 'password'" src="~assets/images/eye.png" @click="typeNewPassword = 'text'" height="30" class="object-fit-contain cursor-pointer" alt="">
                        <img v-if="typeNewPassword == 'text'" src="~assets/images/hidden.png" @click="typeNewPassword = 'password'" height="30" class="object-fit-contain cursor-pointer" alt="">
                    </div>
                </div>
                <div class="w-100 position-relative">
                    <span class="d-block mb-2">Confirm password:</span>
                    <b-input :type="typeConfirmPassword" v-model="confirmPassword" class="ss-input-default w-100 fw-bold" placeholder="" required></b-input>
                    <div class="position-absolute d-flex align-items-center showpassword">
                        <img v-if="typeConfirmPassword == 'password'" src="~assets/images/eye.png" @click="typeConfirmPassword = 'text'" height="30" class="object-fit-contain cursor-pointer" alt="">
                        <img v-if="typeConfirmPassword == 'text'" src="~assets/images/hidden.png" @click="typeConfirmPassword = 'password'" height="30" class="object-fit-contain cursor-pointer" alt="">
                    </div>
                </div>

                <b-button type="submit" variant="ss-primary-button" class="w-100 mt-3" :disabled="isLoading">CHANGE YOUR PASSWORD</b-button>

            </b-form>
        </div>
    </b-modal>
</template>

<style lang="scss" scoped>
    .change-password-container {
        .ss-input-default {
            font-size: 20px !important;
            letter-spacing: 0.1em;
            padding-right: 3rem;
        }
        
        span {
            font-size: 16px !important;
        }

        .btn-ss-primary-button {
            height: 50px;
        }

        .showpassword {
            right: 10px;
            top: 50%;
        }
    }
</style>