<script lang="ts" setup>

    import { nextTick, onMounted, ref } from "vue"

    
    definePageMeta({
        middleware: ['sanctum:auth'],
    });
    
    const config = useRuntimeConfig()
    
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
    const isLoadingFinish = ref(false)

    onMounted(async() => {
        await nextTick()
        isLoading.value = true
        await events.getEventBriteEvent({ eid: router.currentRoute.value.params._eid })
        await events.getEventAttendees({ eid: router.currentRoute.value.params._eid })
        isLoading.value = false
    })

    async function generateEventbriteAttendees() {
        $swal.fire({
            title: "Are you sure?",
            text: "Do you want to Import Eventbrite attendees?",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then(async (result: any) => {
            if (result.isConfirmed) {
                loading.value = true
                await events.getEventBriteEventsParticipantsList({ eid: router.currentRoute.value.params._eid })

                await events.getEventAttendees({ eid: router.currentRoute.value.params._eid })
                loading.value = false
            }
        });
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

    async function openPublicResultPage(item: any) {
        window.open(`${config.public.clientUrl}/public/match-result/${item.user.id}?eid=${router.currentRoute.value.params._eid}&type=final_result`, '_blank')
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

    async function finishEvent() {
        $swal.fire({
            title: "Finish event?",
            text: "Do you want to finish this event and send selection email to the attendees ?",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then(async (result: any) => {
            if (result.isConfirmed) {
                isLoadingFinish.value = true
                await events.sendSelectionEmail({ eid: router.currentRoute.value.params._eid })
                isLoadingFinish.value = false

                $swal.fire({
                    title: "Success",
                    text: "Selection email successfully sent to the attendees",
                    icon: "success",
                })
            }
        });
    }

    async function getAllMatchParticipants(item: any) {
        await events.getAllMatchParticipants({
            gender: item.user.gender,
            eid: router.currentRoute.value.params._eid,
            user_id: item.user.id
        })
    }

    async function getIndividualResult(item: any) {

        $swal.fire({
            title: "Send final result?",
            text: `Do you want to send match selected user match final result?`,
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                await events.getIndividualResult({
                    eid: router.currentRoute.value.params._eid,
                    user_id: item.user.id
                })
            },
            allowOutsideClick: () => !$swal.isLoading()
        }).then(async (result: any) => {
            if (result.isConfirmed) {
                
            }
        })
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

        <div v-if="!isLoading" class="my-5">
            <div class="header-title mb-3 d-flex justify-content-between">
                <span>Event attendees</span>
            </div>

            <div class="d-flex justify-content-between gap-16">
                <b-button variant="ss-primary-button" @click="finishEvent" :disabled="isLoadingFinish || router.currentRoute.value.query.type == 'past' ? true : false"><b-spinner variant="light" small v-if="isLoadingFinish"></b-spinner> <span>Finish event</span></b-button>

                <div class="d-flex gap-16">
                    <b-button variant="ss-primary-button" @click="openSelectAttendees = true" :disabled="router.currentRoute.value.query.type == 'past' ? true : false">Manually add attendee</b-button>
                    <b-button variant="ss-primary-button" @click="generateEventbriteAttendees" :disabled="loading || router.currentRoute.value.query.type == 'past' ? true : false"><b-spinner variant="light" small v-if="loading"></b-spinner> Import Eventbrite attendees</b-button>
                </div>
            </div>
        </div>
        
        <template v-if="es.getAllMale && es.getAllMale.length">
            <div class="header-title mb-3">
                <span>{{ `Male list (${es.getAllMale.length})` }}</span>
            </div>
            <div class="d-flex flex-wrap gap-32 pb-5 px-3">
                <div v-for="(item, i) in es.getAllMale" :key="`attendees-${i}`" class="w-100 attendees-wrapper border-radius-10 shadow py-3 px-4 border border-dark">
                    
                    <div class="d-flex gap-16">
                        <div class="attendees-image d-flex justify-content-center align-items-center border border-radius-10 shadow-sm">
                            <img v-if="item.user.profile_image" :src="item.user.profile_image" height="100" width="100" class="object-fit-contain" alt="profile">
                            <img v-else src="~assets/images/profile-group.svg" height="100" width="100" class="object-fit-contain" alt="profile">
                        </div>
                        <div class="d-flex flex-column justify-content-between w-100">
                            <div>
                                <div class="display-header-20 red-color mb-2 d-flex gap-10 justify-content-between">
                                    <span class="fw-bold">{{ item.user.first_name }}</span>
                                    <img v-if="item.is_checkin" src="~assets/images/green-circle.png" height="20" alt="checkin">
                                </div>
                                <!-- <div>
                                    <span class="fw-semibold d-block">{{ item.user.email }}</span>
                                    <span class="fw-semibold d-block">{{ item.user.cell_phone }}</span>
                                </div> -->
                            </div>

                            <!-- <div class="d-flex gap-32 mb-3">
                                <span>
                                    Age: <span class="fw-bold">{{ item.user.age }}</span>
                                </span>

                                <span>
                                    Gender: <span class="fw-bold text-capitalize">{{ item.user.gender }}</span>
                                </span>
                            </div> -->

                            <div class="d-flex gap-10">
                                <b-button @click="openPublicResultPage(item)" variant="ss-primary-button" class="attendee-button rounded">Result</b-button>
                                <b-button @click="getAllMatchParticipants(item)" variant="ss-primary-button" class="attendee-button rounded">Selections</b-button>

                                <b-button @click="setCheckinUser(item, 1)" v-if="!item.is_checkin" variant="ss-primary-button" class="attendee-button rounded">Check-in</b-button>
                                <b-button @click="setCheckinUser(item, 0)" v-if="item.is_checkin" variant="ss-primary-button" class="attendee-button rounded">Check-out</b-button>
                                <b-button @click="getIndividualResult(item)" variant="ss-primary-button" class="attendee-button rounded" :disabled="!item.is_checkin ? true : false">Send result</b-button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </template>
        
        <template v-if="es.getAllFemale && es.getAllFemale.length">
            <div class="header-title mb-3">
                <span>{{ `Female list (${es.getAllFemale.length})` }}</span>
            </div>
            <div class="d-flex flex-wrap gap-32 pb-5 px-3">
                <div v-for="(item, i) in es.getAllFemale" :key="`attendees-${i}`" class="w-100 attendees-wrapper border-radius-10 shadow py-3 px-4 border border-dark">
                    
                    <div class="d-flex gap-16">
                        <div class="attendees-image d-flex justify-content-center align-items-center border border-radius-10 shadow-sm">
                            <img v-if="item.user.profile_image" :src="item.user.profile_image" height="100" width="100" class="object-fit-contain" alt="profile">
                            <img v-else src="~assets/images/profile-group.svg" height="100" width="100" class="object-fit-contain" alt="profile">
                        </div>
                        <div class="d-flex flex-column justify-content-between">
                            <div>
                                <div class="display-header-20 red-color mb-2 d-flex gap-10 justify-content-between">
                                    <span class="fw-bold">{{ item.user.first_name }}</span>
                                    <img v-if="item.is_checkin" src="~assets/images/green-circle.png" height="20" alt="checkin">
                                </div>
                                <!-- <div>
                                    <span class="fw-semibold d-block">{{ item.user.email }}</span>
                                    <span class="fw-semibold d-block">{{ item.user.cell_phone }}</span>
                                </div> -->
                            </div>

                            <!-- <div class="d-flex gap-32 mb-3">
                                <span>
                                    Age: <span class="fw-bold">{{ item.user.age }}</span>
                                </span>

                                <span>
                                    Gender: <span class="fw-bold text-capitalize">{{ item.user.gender }}</span>
                                </span>
                            </div> -->

                            <div class="d-flex gap-10">
                                <b-button @click="openPublicResultPage(item)" variant="ss-primary-button" class="attendee-button rounded">Result</b-button>
                                <b-button @click="getAllMatchParticipants(item)" variant="ss-primary-button" class="attendee-button rounded">Selections</b-button>

                                <b-button @click="setCheckinUser(item, 1)" v-if="!item.is_checkin" variant="ss-primary-button" class="attendee-button rounded">Check-in</b-button>
                                <b-button @click="setCheckinUser(item, 0)" v-if="item.is_checkin" variant="ss-primary-button" class="attendee-button rounded">Check-out</b-button>
                                <b-button @click="getIndividualResult(item)" variant="ss-primary-button" class="attendee-button rounded" :disabled="!item.is_checkin ? true : false">Send result</b-button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </template>

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
