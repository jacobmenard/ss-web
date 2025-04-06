
<script lang="ts" setup>
    import { ref } from "vue";

    const us = useUserStore()

    const emit = defineEmits(['close'])

    const isLoading = ref(false)

    const email = ref('')

    async function resetPassword() {
        isLoading.value = true
        await us.forgotPassword({
            email: email.value
        })

        setTimeout(() => {
            isLoading.value = false  
            email.value = ''
            emit('close')
        }, 3000);
        
    }
</script>

<template>
    <b-modal size="md" no-footer centered id="resetpassword-match-form" class="ss-default-modal">
        <b-form @submit.stop.prevent="resetPassword">
            <div class="d-flex flex-column gap-20 p-3">
                <div>
                    <div class="head-title text-center ">
                        Reset password
                    </div>
                </div>
                <div class="d-flex flex-column gap-10">
                    <span class="fw-bold">Email</span>
                    <b-input v-model="email" class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>

                <b-button v-if="!isLoading" type="submit" variant="ss-form-default-button" class="w-100">
                    SEND RESET PASSWORD
                </b-button>

                <b-button v-if="isLoading" variant="ss-form-default-button" class="w-100" disabled>
                    <b-spinner variant="light" small class="mr-2"></b-spinner> SENDING...
                </b-button>
                
            </div>
        </b-form>
    </b-modal>
</template>

<style lang="scss" scoped>
    
</style>
