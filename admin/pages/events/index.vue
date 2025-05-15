<script lang="ts" setup>
import { nextTick, onMounted, ref } from "vue"
import { useEvents } from '@/composables/useEvents'
import { useUtils } from '@/composables/useUtils'

    definePageMeta({
        middleware: ['sanctum:auth'],
    });

    const event = useEvents()

    const es = useEventStore()
    const utils = useUtils()
    const router = useRouter()
    const isLoadingEvents = ref(false)

    const viewBy = ref(1)
    
    onMounted(async() => {
        await nextTick()
        await viewData(1)
    })

    function goToEventAttendees(eid: any) {
        router.push({
            path: `events/attendees/${eid}`, 
            query: { type: viewBy.value == 1 ? 'current_future' : 'past' }
        })
    }

    async function viewData(type: any) {
        isLoadingEvents.value = true
        await event.getList({
            order_by: viewBy.value == 1 ? 'start_asc' : 'start_desc',
            page_size: '20',
            time_filter: viewBy.value == 1 ? 'current_future' : 'past'
        })
        isLoadingEvents.value = false
    }

    async function viewDataBy(type: any) {
        viewBy.value = type
        await viewData(type)
    }
</script>

<template>
    <div class="events-container">
        <div class="header-title">
            <span>Events</span>

            <b-button v-if="viewBy == 1" variant="ss-primary-button d-flex gap-10 align-items-center my-4" class="px-4" @click="viewDataBy(2)" :disabled="isLoadingEvents">
                <b-spinner variant="light" small v-if="isLoadingEvents"></b-spinner>
                <span v-if="!isLoadingEvents">Show past events</span>
            </b-button>

            <b-button v-if="viewBy == 2" variant="ss-primary-button d-flex gap-10 align-items-center my-4" class="px-4" @click="viewDataBy(1)" :disabled="isLoadingEvents">
                <b-spinner variant="light" small v-if="isLoadingEvents"></b-spinner>
                <span v-if="!isLoadingEvents">Show current events</span>
            </b-button>
        </div>

        <div class="event-wrapper d-flex gap-32 flex-wrap">
            <div v-for="(item, i) in es.getEvents" :key="`event-${i}`" @click="goToEventAttendees(item.id)" class="event-card-container shadow-sm w-100 p-3 cursor-pointer border">
                <div class="d-flex justify-content-between flex-column h-100">
                    <div>
                        <div v-if="item.logo" class="mb-3">
                            <img class="w-100 object-fit-contain" :src="item.logo.url" alt="">
                        </div>
                        <div v-if="!item.logo" class="d-flex align-items-center justify-content-center mb-3" style="width: 100%; height: 141.33px;">
                            <img src="~assets/images/no-image-available.png" height="120px" class="object-fit-contain" alt="">
                        </div>
                        <div>
                            <p class="fw-bold truncate truncate--2" v-html="item.name.html"></p>
                        </div>
                    </div>

                    <div v-if="!isLoadingEvents">
                        <small v-if="viewBy == 1" class="fw-semibold">Event starts @ {{ utils.momentTimezone(item.start.local) }}</small>
                        <small v-if="viewBy == 2" class="fw-semibold">Ended {{ utils.momentTimezone(item.start.local) }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .events-container {
        .event-wrapper {
            .event-card-container {
                max-width: 350px;
                height: 300px; 
            }
        }
    }
</style>
