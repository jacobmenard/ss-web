<script lang="ts" setup>
import { nextTick, onMounted } from "vue"

    const events = useEvents()
    const es = useEventStore()
    const router = useRouter()
    const utils = useUtils()

    onMounted(async() => {
        await nextTick()
        await events.getEventBriteEvent({ eid: router.currentRoute.value.params._eid })
        await events.getEventBriteEventsParticipantsList({ eid: router.currentRoute.value.params._eid })
    })
</script>

<template>
    <div class="attendees-container">
        <div class="header-title">
            <span>Event</span>
        </div>

        <div v-if="es.getEvent.name" class="header-title shadow p-4">
            <span>{{ `${es.getEvent.name.text}` }}</span>
            <small class="d-block">
                {{ utils.momentTimezone(es.getEvent.start.local) }}
            </small>
        </div>

        <div class="header-title">
            <span>Event attendees</span>
        </div>

        <div v-if="es.getAttendees" class="d-flex flex-wrap gap-32">
            <div v-for="(item, i) in es.getAttendees.attendees" :key="`attendees-${i}`" class="w-100 attendees-wrapper shadow py-3 px-4">
                
                <div class="d-flex flex-column justify-content-between h-100">
                    <div>
                        <div class="display-header-20 red-color mb-2">
                            <span class="fw-bold">{{ item.profile.name }}</span>
                        </div>
                        <div>
                            <span class="fw-semibold d-block">{{ item.profile.email }}</span>
                            <span class="fw-semibold d-block">{{ item.profile.cell_phone }}</span>
                        </div>
                    </div>

                    <div class="d-flex gap-32">
                        <span>
                            Age: <span class="fw-bold">{{ item.profile.age }}</span>
                        </span>

                        <span>
                            Gender: <span class="fw-bold text-capitalize">{{ item.profile.gender }}</span>
                        </span>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</template>

<style lang="scss" scoped>
    .attendees-container {
        .attendees-wrapper {
            max-width: 350px;
            height: 150px;

        }
    }
</style>
