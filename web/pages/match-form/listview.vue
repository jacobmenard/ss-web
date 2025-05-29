<script setup lang="ts">
import { nextTick, onMounted, ref } from "vue";


    definePageMeta({
        middleware: ['sanctum:auth'],
    });
    
    const router = useRouter()
    const user = useUserStore()
    const event = useEventStore()
    const auth = useSanctumUser()
    const isAllGender = ref('0')
    const isLoading = ref(false)

    function goToListview() {
        router.push({ path: "match-form/selection" })
    }

    async function viewBy(view: any) {
        if (isAllGender.value == view) {
            return
        }
        isLoading.value = true
        sessionStorage.setItem('isAllGender', view)
        isAllGender.value = sessionStorage.getItem('isAllGender')
        await event.participants({eventId: router.currentRoute.value.query.eid, isAllGender: isAllGender})
        isLoading.value = false
    }

    onMounted(async () => {
        await nextTick()
        isLoading.value = true
        await event.participants({eventId: router.currentRoute.value.query.eid, isAllGender: isAllGender})
        isLoading.value = false
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
        <div class="d-flex align-items-center mb-2 mt-5 w-100 border-radius-10 overflow-hidden border">
            <b-button :variant="isAllGender == 1 ? 'ss-primary-secondary' : 'ss-primary-button'" class="w-100 border-radius-0 height-50" @click="viewBy(0)">
                <b-spinner variant="light" small v-if="isLoading && isAllGender == '0'"></b-spinner> {{ `${auth.data.gender == 'male' ? 'Female' : 'Male'} only` }}
            </b-button>
            <b-button :variant="isAllGender == 0 ? 'ss-primary-secondary' : 'ss-primary-button'" class="w-100 border-radius-0 height-50" @click="viewBy(1)">
                <b-spinner variant="light" small v-if="isLoading && isAllGender == '1'"></b-spinner> All gender
            </b-button>
        </div>

        <div class="mf-listviiew-wrapper w-100 h-100 margin-bottom-60">

            <card-match-form v-for="(item, i) in event.participantsList" :key="`participants-${i}`" :item="item" :event_id="router.currentRoute.value.query.eid">
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