<script setup lang="ts">

    definePageMeta({
        middleware: ['sanctum:auth'],
    });

    const router = useRouter()
    const event = useEvent()
    const isOpen = ref(false)
    
    function goToListview() {
        isOpen.value = true
        // router.push({ path: "/match-form/listview" })
    }

    async function goToInstruction(data: any) {
        isOpen.value = false
        router.push({ path: `/match-form/listview`, query: { eid: data.id } })
    }

</script>
<template>
    <div class="mf-instruction d-flex flex-column align-items-center gap-60">
        <header-title-one class="max-width-1100 match-form">
            <template #header>
                    SIPS <span class="symbol">&</span> SPARKS
            </template>

            <template #sub-header>
                When the bell rings 🛎️  
                <br>
                Pause the convo 💬  
                <br>
                Pull up this match form 📝  
                <br>
                And get ready to move! ➡️ 
                <br><br>
                Try to hold off on drinks 🍹 and the restroom 🚽  until the 15-minute break ⏲️
                <br><br>
                Stay curious 🔍 , be kind 😄 , and let the good vibes 🌈  flow!
            </template>
        </header-title-one>

        <b-button variant="ss-default-button" class="mf-button" @click="goToListview">LET'S GET SPARKING!</b-button>

        <modal-select-event v-model="isOpen" :isOpen="isOpen" @close="isOpen = false" @goEvent="goToInstruction"></modal-select-event>
    </div>
</template>

<style lang="scss">
.mf-instruction {
    .mf-instruction-button {
        letter-spacing: 1;
    }
}
</style>
