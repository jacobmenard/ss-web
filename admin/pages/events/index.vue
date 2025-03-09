<script lang="ts" setup>
import { nextTick, onMounted } from "vue"
import { useEvents } from '@/composables/useEvents'
import { useUtils } from '@/composables/useUtils'

    const event = useEvents()

    const es = useEventStore()
    const utils = useUtils()
    const router = useRouter()
    
    onMounted(async() => {
        await nextTick()
        await event.getList({
            order_by: 'start_asc',
            page_size: '20',
            time_filter: 'current_future'
        })
    })

    function goToEventAttendees(eid: any) {
        router.push(`events/attendees/${eid}`)
    }
</script>

<template>
    <div class="events-container">
        <div class="header-title">
            <span>Events</span>
        </div>

        <div class="event-wrapper d-flex gap-32 flex-wrap">
            <div v-for="(item, i) in es.getEvents" :key="`event-${i}`" @click="goToEventAttendees(item.id)" class="event-card-container shadow-sm w-100 p-3 cursor-pointer">
                <div class="d-flex justify-content-between flex-column h-100">
                    <div>
                        <div class="mb-3">
                            <img class="w-100 object-fit-contain" :src="item.logo.url" alt="">
                        </div>
                        <div>
                            <p class="fw-bold truncate truncate--2" v-html="item.name.html"></p>
                        </div>
                    </div>

                    <div>
                        <small class="fw-semibold">Event starts @ {{ utils.momentTimezone(item.start.local) }}
                        </small>
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
