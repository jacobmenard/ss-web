<script lang="ts" setup>

    definePageMeta({
        layout: 'login',
    });
    
    const router = useRouter()
    const user = useUserStore()
    const login = useLogin()

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
</script>

<template>
    <div class="login-match-form">
        <b-form @submit.stop.prevent="loginUser">
            <div class="d-flex flex-column gap-20 p-5 my-5 max-width-500 mx-auto rounded shadow">
                <div>
                    <div class="head-title text-center ">
                        SIPS <span class="symbol">&</span> SPARKS
                    </div>
                    <div class="text-center fw-semibold">
                        <span>Admin portal</span>
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

                <b-button type="submit" variant="ss-form-default-button" class="w-100">Login</b-button>
                
            </div>
        </b-form>
    </div>
</template>

<style lang="scss" scoped>
    
</style>
