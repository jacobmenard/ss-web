<script lang="ts" setup>

    import { nextTick, onMounted, ref } from "vue"
    
    const events = useEvents()
    const es = useEventStore()
    const router = useRouter()
    const utils = useUtils()
    const { $swal } = useNuxtApp()

    const openAttendees = ref(false)
    const openSelectAttendees = ref(false)
    const loading = ref(false)
    const isLoading = ref(false)
    const loadingMatchup = ref(false)

    onMounted(async() => {
        await nextTick()
        isLoading.value = true
        await events.getEventBriteEvent({ eid: router.currentRoute.value.params._eid })
        await events.getEventAttendees({ eid: router.currentRoute.value.params._eid })
        isLoading.value = false
    })

    async function generateEventbriteAttendees() {
        loading.value = true
        await events.getEventBriteEventsParticipantsList({ eid: router.currentRoute.value.params._eid })
        loading.value = false
    }

    async function selectAttendees(data: any) {
        $swal.fire({
            title: "Are you sure?",
            text: "Add selected attendee for this event?",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, add it!"
        }).then(async (result: any) => {
            if (result.isConfirmed) {
                await events.attendeeAddToEvent({
                    eid: router.currentRoute.value.params._eid,
                    user_id: data.id
                })

                await events.getEventAttendees({ eid: router.currentRoute.value.params._eid })
            }
        });
    }

    async function openMatchup(data: any) {
        loadingMatchup.value = true
        await events.getMatchupResult({
            eid: data.event_id,
            user_id: data.user.id
        })
        
        loadingMatchup.value = false
        
    }

    async function setCheckinUser(user: any, chechinStatus: any) {
        console.log()
        $swal.fire({
            title: "Confirmation",
            text: `Check-${chechinStatus ? 'In' : 'out'} ${user.user.first_name} ${user.user.last_name} now?`,
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then(async (result: any) => {
            if (result.isConfirmed) {
                await events.changeCheckInStatus(user.id, {
                    checkin: chechinStatus,
                })
                
                await events.getEventAttendees({ eid: router.currentRoute.value.params._eid })
            }
        });
    }
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

        <div v-else class="header-title shadow p-4">
            Loading event...
        </div>

        <div class="header-title my-5 d-flex justify-content-between">
            <span>Event attendees</span>

            <div class="d-flex gap-16">
                <b-button variant="ss-primary-button" @click="openSelectAttendees = true">Manually add attendee</b-button>

                <!-- <b-button variant="ss-primary-button" @click="openAttendees = true">Add Attendees</b-button> -->
                <b-button variant="ss-primary-button" @click="generateEventbriteAttendees">Import Eventbrite attendees</b-button>
            </div>
        </div>

        <div v-if="es.getAttendees" class="d-flex flex-wrap gap-32 pb-5 px-3">
            <div v-for="(item, i) in es.getAttendees" :key="`attendees-${i}`" class="w-100 attendees-wrapper border-radius-10 shadow py-3 px-4 border border-dark">
                
                <div class="d-flex flex-column justify-content-between">
                    <div>
                        <div class="display-header-20 red-color mb-2 d-flex gap-10 justify-content-between">
                            <span class="fw-bold">{{ item.user.name }}</span>
                            <img v-if="item.is_checkin" src="~assets/images/green-circle.png" height="20" alt="checkin">
                        </div>
                        <div>
                            <span class="fw-semibold d-block">{{ item.user.email }}</span>
                            <span class="fw-semibold d-block">{{ item.user.cell_phone }}</span>
                        </div>
                    </div>

                    <div class="d-flex gap-32 mb-3">
                        <span>
                            Age: <span class="fw-bold">{{ item.user.age }}</span>
                        </span>

                        <span>
                            Gender: <span class="fw-bold text-capitalize">{{ item.user.gender }}</span>
                        </span>
                    </div>

                    <div class="d-flex gap-10">
                        <b-button variant="ss-primary-button" class="attendee-button rounded" :disabled="item.feedback ? false : true">Feedback</b-button>
                        <b-button v-if="loadingMatchup" variant="ss-primary-button" class="attendee-button rounded" disabled>
                            <b-spinner variant="light" small class="mr-2"></b-spinner>
                        </b-button>
                        <b-button v-else variant="ss-primary-button" class="attendee-button rounded" @click="openMatchup(item)">
                            Match result
                        </b-button>
                        <b-button @click="setCheckinUser(item, 1)" v-if="!item.is_checkin" variant="ss-primary-button" class="attendee-button rounded">Check-in</b-button>
                        <b-button @click="setCheckinUser(item, 0)" v-if="item.is_checkin" variant="ss-primary-button" class="attendee-button rounded">Check-out</b-button>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- <modal-select-event v-model="openAttendees" @close="openAttendees = false"></modal-select-event> -->
        <modal-add-attendees v-model="openAttendees" @close="openAttendees = false" :eid="router.currentRoute.value.params._eid"></modal-add-attendees>
        <modal-select-attendees v-model="openSelectAttendees" @close="openSelectAttendees = false" @select-attendees="selectAttendees"></modal-select-attendees>
        <b-modal v-model="loading" size="md" no-footer :hide-header="true" :hide-header-close="true" :no-close-on-backdrop="true" :no-close-on-esc="true" centered id="select-event-modal" class="ss-default-modal">
            <div>
                <img src="~assets/images/heart-loading.gif" class="w-100 object-fit-contain" alt="">
            </div>
            <h3 class="text-center font-weight-bold">Storing attendees from Eventbrite</h3>
        </b-modal>

    </div>
</template>

<style lang="scss" scoped>
</style>
