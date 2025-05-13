
<script setup lang="ts">
    import { nextTick, onMounted, ref } from "vue";

    definePageMeta({
        middleware: ['sanctum:auth'],
    });

    const router = useRouter()
    const auth = useSanctumUser();
    const isLoggedIn = ref(false)
    const isOpen = ref(false)
    const us = useUserStore()
    const openUploadImage = ref(false)
    const openChangePassword = ref(false)
    const isLoading = ref(true)

    async function getStarted() {
        router.push({ path: "/match-form/instruction" })
        isOpen.value = true
    }

    onMounted(async() => {
        await nextTick()
        await us.get()
        if (!us.getUser.profile_image) {
            openUploadImage.value = true
        }
        isLoading.value = false
    })

</script>
<template>
    <div class="mf-introduction d-flex flex-column align-items-center gap-60">
        <header-title-one class="max-width-1100 match-form">
            <template #header>
                    SIPS <span class="symbol">&</span> SPARKS
                    <span class="d-block black1">MATCH FORM</span>
            </template>

            <template #sub-header>
                This form is for our in-person singles events that feature mini dates ❤️ and match selections 📝
                <br><br>
                At one of our events now? Click the button below to get sparking!  
            </template>
        </header-title-one>

        <b-button variant="ss-default-button" class="mf-button" @click="getStarted" :disabled="isLoading">START MARCH FORM</b-button>
        
        <modal-upload-image v-model="openUploadImage" @close="openUploadImage = false"></modal-upload-image>
        <!-- <modal-change-password v-model="openChangePassword" @close="openChangePassword = false"></modal-change-password> -->
        <!-- <modal-login v-model="isLoggedIn" @close="isLoggedIn = false"></modal-login> -->
    </div>
</template>

<style lang="scss">
.mf-introduction {
    
    .black1 {
        color: $black2;
    }

}
</style>