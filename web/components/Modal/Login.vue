<script lang="ts" setup>
import { ref, computed } from 'vue'

    const router = useRouter()
    const user = useUserStore()
    const auth = useSanctumUser();
    const login = useLogin()

    const form = ref({
        email: null,
        password: null
    })


    const emit = defineEmits(['close'])

    async function loginUser() {
        await login.loginUser(form)
    }
    

</script>

<template>
    <b-modal size="md" no-footer centered id="login-match-form" class="ss-default-modal">
        <b-form @submit.stop.prevent="loginUser">
            <div class="d-flex flex-column gap-20 p-3">
                <div>
                    <div class="head-title text-center">
                        SIPS <span class="symbol">&</span> SPARKS
                    </div>
                    <div class="text-center fw-semibold">
                        <span>Sign in and start using Matchup form</span>
                    </div>
                </div>
                <div class="d-flex flex-column gap-10">
                    <span class="fw-bold">Email</span>
                    <b-input v-model="form.email" class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>
                
                <div class="d-flex flex-column gap-10">
                    <span class="fw-bold">Password</span>
                    <b-input v-model="form.password" class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>

                <b-button type="submit" variant="ss-form-default-button" class="w-100">Login</b-button>
                
            </div>
        </b-form> 
    </b-modal>
</template>

<style lang="scss" scoped>
    
</style>
