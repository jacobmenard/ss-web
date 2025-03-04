<script setup lang="ts">
import { nextTick, onMounted } from "vue";


    definePageMeta({
        middleware: ['sanctum:auth'],
    });
    
    const router = useRouter()
    const user = useUserStore()
    const event = useEventStore()

    function goToListview() {
        router.push({ path: "match-form/selection" })
    }

    onMounted(async () => {
        await nextTick()
        await event.participants({eventId: '1214919088699'})

    })

</script>
<template>
    <div class="mf-listview d-flex flex-column align-items-center">
        <header-title-one class="max-width-1100 match-form">
            <template #header>
                    SIPS <span class="symbol">&</span> SPARKS
            </template>

            <template #sub-header>
                Click the name to write notes and make selections. 
            </template>
        </header-title-one>

        <div class="mf-listviiew-wrapper w-100 h-100 margin-bottom-60">

            <card-match-form v-for="(item, i) in event.participantsList" :key="`participants-${i}`" :item="item">
                <!-- <template #img>
                    <img v-if="item.user.profilePic" :src="item.user.profilePic" alt="">
                    <img v-else src="~assets/images/profile-group.svg" alt="">
                </template>
                <template #name>
                    <span>{{ item.user.first_name }}</span>
                </template> -->
            </card-match-form>

        </div>


    </div>
</template>