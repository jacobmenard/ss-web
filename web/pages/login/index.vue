<script lang="ts" setup>
    import { useLogin } from '@/composables/useLogin'
    import { onMounted, ref } from 'vue'
    const router = useRouter()
    const user = useUserStore()
    const login = useLogin()

    const openResetPassword = ref(false)
    const isOpenPrivacyPolicy = ref(false)

    const form = ref({
        email: null,
        password: null
    })

    async function loginUser() {
        await login.loginUser({
            email: form.value.email,
            password: form.value.password
        })
    }

    function acceptPrivacy() {
        sessionStorage.setItem('isAcceptPrivacy', '1')
        isOpenPrivacyPolicy.value = false
    }

    function moreDetails() {
        router.push({path: '/privacy-policy'})
        isOpenPrivacyPolicy.value = false
    }
    
    onMounted(() => {
        const isAcceptPrivacy = sessionStorage.getItem('isAcceptPrivacy')

        if (isAcceptPrivacy != '1') {
            setTimeout(() => {
                isOpenPrivacyPolicy.value = true
            }, 500);
        }
    })
</script>

<template>
    <div class="login-match-form">
        <b-form @submit.stop.prevent="loginUser">
            <div class="login-match-form-wrapper d-flex flex-column gap-20 p-3 my-5 max-width-500 mx-auto">
                <div>
                    
                    <div class="head-title text-center ">
                        SIPS <span class="symbol">&</span> SPARKS
                    </div>
                    <div class="text-center fw-semibold">
                        <span class="sub-text">Already registered for an event? Sign in here to access the match form!</span>
                    </div>

                    <div class="text-center small fw-bold mt-3">
                        <small>(Note: The match form will become available 2 hours before your event's start time.)</small>
                    </div>
                </div>
                <div class="d-flex flex-column gap-10">
                    <span class="fw-bold">Email</span>
                    <b-input v-model="form.email" class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>
                
                <div class="d-flex flex-column gap-10">
                    <span class="fw-bold">Password</span>
                    <b-input type="password" v-model="form.password" class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>

                <div class="d-flex justify-content-center gap-10 mb-3">
                    <span @click="openResetPassword = true" class="fw-semibold cursor-pointer" style="font-size: 16px !important;">Forgot password?</span>
                </div>

                <b-button type="submit" variant="ss-form-default-button" class="w-100">Login</b-button>
                
            </div>
        </b-form> 

        <modal-reset-password v-model="openResetPassword" @close="openResetPassword = false"></modal-reset-password>
        <modal-privacy-policy v-model="isOpenPrivacyPolicy" @close="isOpenPrivacyPolicy = false" @accept="acceptPrivacy" @moreDetails="moreDetails"></modal-privacy-policy>

    </div>
</template>

<style lang="scss" scoped>
    .login-match-form {
        .login-match-form-wrapper {
            @include mobile-lg {
                
                margin-top: 0px !important;
            }
            .head-title {
                @include mobile-lg {
                    font-size: 28px !important;
                }

                .sub-text {
                    @include mobile-lg {
                        font-size: 18px !important;
                    }
                }
            }
        }
    }
</style>
