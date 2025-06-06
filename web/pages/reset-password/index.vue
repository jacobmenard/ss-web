
<script lang="ts" setup>
    import { onMounted, ref } from "vue"

    definePageMeta({
        layout: 'changepassword',
    });

    const isLoading = ref(false)

    const router = useRouter()
    const us = useUserStore()
    
    const typeNewPassword = ref('password')
    const typeConfirmPassword = ref('password')
    const newPassword = ref('')
    const confirmPassword = ref('')
    const emailAddress = ref('')

    onMounted(async () => {

        emailAddress.value = router.currentRoute.value.query.email
    })

    async function resetPassword() {
        if (newPassword.value != confirmPassword.value) {
            useNuxtApp().$toast('The inputted password are not matched. Please try again.', {type: 'error'});
            return
        }
        if (newPassword.value.length < 6) {
            useNuxtApp().$toast('The inputted password is lesser than 6 characters. Please try again.', {type: 'error'});
            return
        }
        const request = router.currentRoute.value.query
        isLoading.value = true
        await us.resetPassword({
            token: request.token,
            email: request.email,
            password: newPassword,
            password_confirmation: confirmPassword
        })

        setTimeout(() => {
            isLoading.value = false
            router.push({
                path: '/login'
            })
        }, 3000);
    }
    
</script>

<template>
    
    <div class="change-password-container d-flex flex-column justify-content-between align-items-center gap-10 my-2 p-5 border-radius-10 border shadow w-100">
        <b-form @submit.stop.prevent="resetPassword" class="w-100">
            <div class="w-100 position-relative mb-3">
                <span class="d-block mb-2">Email Address:</span>
                <b-input type="text" v-model="emailAddress" class="ss-input-default w-100 fw-bold" placeholder="" disabled></b-input>
            </div>
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

            <b-button v-if="!isLoading" type="submit" variant="ss-primary-button" class="w-100 mt-3" :disabled="isLoading">CHANGE YOUR PASSWORD</b-button>
            <b-button v-if="isLoading" variant="ss-primary-button" class="w-100 mt-3" :disabled="isLoading"><b-spinner variant="light" small class="mr-2"></b-spinner> RESETTING PASSWORD...</b-button>

        </b-form>
    </div>
</template>

<style lang="scss">
    .change-password-container {
        max-width: 500px;
        .ss-input-default {
            font-size: 18px !important;
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
