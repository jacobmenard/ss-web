

<script lang="ts" setup>
import { onMounted, ref } from "vue";

    const events = useEvent()
    const es = useEventStore()
    const router = useRouter()
    const utils = useUtils()
    const us = useUserStore()
    const { $swal } = useNuxtApp()

    const isLoadingMatchresult = ref(false)
    const reportType = ref(null)

    const isFinalResult = ref(true)
    
    onMounted(async () => {
        isFinalResult.value = true
        isLoadingMatchresult.value = true
        await events.getMatchupResult({
            eid: router.currentRoute.value.query.eid,
            user_id: router.currentRoute.value.params._userId,
            urlForm: true,
            type: router.currentRoute.value.query.type
        })
        isLoadingMatchresult.value = false
    })

    async function getYourSelection(isFinal: any) {
        isFinalResult.value = isFinal
        isLoadingMatchresult.value = true
        await events.getMatchupResult({
            eid: router.currentRoute.value.query.eid,
            user_id: router.currentRoute.value.params._userId,
            urlForm: true,
            type: isFinalResult.value ? router.currentRoute.value.query.type : null
        })
        isLoadingMatchresult.value = false
    }

    function openResult(userEvent: any, info: any, showType: any) {
        if (showType == 1 && !info.matchup_share_contact) {
            $swal.fire({
                title: `Oops...`,
                html: `<strong>${info.matchup_owner.first_name} ${info.matchup_owner.last_name}</strong> doesn't allow to share ${info.matchup_owner.gender == 'male' ? 'his' : 'her'} information`,
                icon: `error`
            });

            return
        }
        us.setOpenMatchupResultFinal(true, userEvent, info, showType)
    }

</script>

<template>
    <div class="match-result-container">
        <div v-if="es.user" class="head-title text-center fw-bold">
            Hi {{ es.user.first_name }}
            <div v-if="es.event && router.currentRoute.value.query.type == 'final_result'" class="sub-header">
                <template v-if="isFinalResult">
                    Below is the summary of your match results for the event <span class="fw-bold">{{ `${es.event.name.text}` }}</span>
                </template>
                <template v-else>
                    Below is the summary of your selection for the event <span class="fw-bold">{{ `${es.event.name.text}` }}</span> 
                </template>
            </div>
            <div v-if="es.event && router.currentRoute.value.query.type != 'final_result'" class="sub-header">Below is the summary of your selection for the event <span class="fw-bold">{{ `${es.event.name.text}` }}</span></div>
        </div>
        
        <div v-if="router.currentRoute.value.query.type == 'final_result' && isFinalResult">
            <div class="d-flex justify-content-end mb-3">
                <b-button variant="ss-primary-button" class="px-4" @click="getYourSelection(false)">Show Selections</b-button>
            </div>
            <div v-if="!isLoadingMatchresult">
                <div v-if="es.dates && es.dates.length" class="matchup-main-container max-width-1020 m-auto">
                    <div class="d-flex justify-content-center align-items-center gap-10 mb-4 px-2 text-center">
                        <span class="display-6 fw-bold mr-2">DATE</span> <card-matchup-status :status="3"></card-matchup-status>
                    </div>
                    <div v-for="(item, i) in es.dates" :key="`items-${i}`" class="d-flex align-items-center justify-content-center gap-16 pb-4">
                        <card-matchup-person class="cursor-pointer" @open="openResult(es.user_event, item, 1)" :profile_image="item.matchup_owner.profile_image ? item.matchup_owner.profile_picture : null" :name="`${item.matchup_owner.first_name}`" :notes="item.matchup_notes"></card-matchup-person>
                        <!-- <card-matchup-status class="match-icon" :status="item.matchup_final"></card-matchup-status> -->
                        <!-- <card-matchup-person class="cursor-pointer owner-matchup" @open="openResult(es.user_event, item, 2)" :profile_image="item.matchup_user.profile_picture" :name="`${item.matchup_user.first_name} ${item.matchup_user.last_name}`" :notes="item.matchup_user_to_owner_notes"></card-matchup-person> -->

                    </div>
                </div>
                <div v-if="es.business && es.business.length" class="matchup-main-container max-width-1020 m-auto">
                    <div class="d-flex justify-content-center align-items-center gap-10 mb-4 px-2 text-center">
                        <span class="display-6 fw-bold mr-2">BUSINESS</span> <card-matchup-status :status="4"></card-matchup-status>
                    </div>
                    <div v-for="(item, i) in es.business" :key="`items-${i}`" class="d-flex align-items-center justify-content-center gap-16 pb-4">
                        <card-matchup-person class="cursor-pointer" @open="openResult(es.user_event, item, 1)" :profile_image="item.matchup_owner.profile_image ? item.matchup_owner.profile_picture : null" :name="`${item.matchup_owner.first_name}`" :notes="item.matchup_notes"></card-matchup-person>
                    </div>
                </div>
                <div v-if="es.friends && es.friends.length" class="matchup-main-container max-width-1020 m-auto mt-3">
                    <div class="d-flex justify-content-center align-items-center gap-10 mb-4 px-2 text-center">
                        <span class="display-6 fw-bold mr-2">FRIEND</span> <card-matchup-status :status="2"></card-matchup-status>
                    </div>
                    <div v-for="(item, i) in es.friends" :key="`items-${i}`" class="d-flex align-items-center justify-content-center gap-16 pb-4">
                        <card-matchup-person class="cursor-pointer" @open="openResult(es.user_event, item, 1)" :profile_image="item.matchup_owner.profile_image ? item.matchup_owner.profile_picture : null" :name="`${item.matchup_owner.first_name}`" :notes="item.matchup_notes"></card-matchup-person>
                        <!-- <card-matchup-status  class="match-icon" :status="item.matchup_final"></card-matchup-status> -->
                        <!-- <card-matchup-person class="cursor-pointer owner-matchup" @open="openResult(es.user_event, item, 2)" :profile_image="item.matchup_user.profile_picture" :name="`${item.matchup_user.first_name} ${item.matchup_user.last_name}`" :notes="item.matchup_user_to_owner_notes"></card-matchup-person> -->

                    </div>
                </div>

                <div v-if="!es.dates.length && !es.business.length && !es.friends.length" class="text-center my-5">
                    <span class="display-6 fw-bold">No matches available</span>    
                </div>

            </div>
        </div>

        <div v-else-if="router.currentRoute.value.query.type == 'final_result' && !isFinalResult">
            <div class="d-flex justify-content-end mb-3">
                <b-button variant="ss-primary-button" class="px-4" @click="getYourSelection(true)">Show Results</b-button>
            </div>
            <div v-if="!isLoadingMatchresult">
                <div v-if="es.dates && es.dates.length" class="matchup-main-container max-width-1020 m-auto">
                    <div class="d-flex justify-content-center align-items-center gap-10 mb-4 px-2 text-center">
                        <span class="display-6 fw-bold mr-2">DATE</span> <card-matchup-status :status="3"></card-matchup-status>
                    </div>
                    <div v-for="(item, i) in es.dates" :key="`items-${i}`" class="d-flex align-items-center justify-content-center gap-16 pb-4">
                        <card-matchup-person class="cursor-pointer owner-matchup" @open="openResult(es.user_event, item, 2)" :profile_image="item.matchup_owner.profile_image ? item.matchup_owner.profile_picture : null" :name="`${item.matchup_user.first_name}`" :notes="item.matchup_user_to_owner_notes"></card-matchup-person>
                    </div>
                </div>
                <div v-if="es.business && es.business.length" class="matchup-main-container max-width-1020 m-auto">
                    <div class="d-flex justify-content-center align-items-center gap-10 mb-4 px-2 text-center">
                        <span class="display-6 fw-bold mr-2">BUSINESS</span> <card-matchup-status :status="4"></card-matchup-status>
                    </div>
                    <div v-for="(item, i) in es.business" :key="`items-${i}`" class="d-flex align-items-center justify-content-center gap-16 pb-4">
                        <card-matchup-person class="cursor-pointer owner-matchup" @open="openResult(es.user_event, item, 2)" :profile_image="item.matchup_owner.profile_image ? item.matchup_owner.profile_picture : null" :name="`${item.matchup_user.first_name}`" :notes="item.matchup_user_to_owner_notes"></card-matchup-person>
                    </div>
                </div>
                <div v-if="es.friends && es.friends.length" class="matchup-main-container max-width-1020 m-auto mt-3">
                    <div class="d-flex justify-content-center align-items-center gap-10 mb-4 px-2 text-center">
                        <span class="display-6 fw-bold mr-2">FRIEND</span> <card-matchup-status :status="2"></card-matchup-status>
                    </div>
                    <div v-for="(item, i) in es.friends" :key="`items-${i}`" class="d-flex align-items-center justify-content-center gap-16 pb-4">
                        <!-- <card-matchup-person class="cursor-pointer" @open="openResult(es.user_event, item, 1)" :profile_image="item.matchup_owner.profile_picture" :name="`${item.matchup_owner.first_name} ${item.matchup_owner.last_name}`" :notes="item.matchup_notes"></card-matchup-person>
                        <card-matchup-status  class="match-icon" :status="item.matchup_final"></card-matchup-status> -->
                        <card-matchup-person class="cursor-pointer owner-matchup" @open="openResult(es.user_event, item, 2)" :profile_image="item.matchup_owner.profile_image ? item.matchup_owner.profile_picture : null" :name="`${item.matchup_user.first_name}`" :notes="item.matchup_user_to_owner_notes"></card-matchup-person>

                    </div>
                </div>
            </div>
        </div>

        <div v-else>
            <div v-if="es.dates && es.dates.length" class="matchup-main-container max-width-1020 m-auto">
                <div class="d-flex justify-content-center align-items-center gap-10 mb-4 px-2 text-center">
                    <span class="display-6 fw-bold mr-2">DATE</span> <card-matchup-status :status="3"></card-matchup-status>
                </div>
                <div v-for="(item, i) in es.dates" :key="`items-${i}`" class="d-flex align-items-center justify-content-center gap-16 pb-4">
                    <!-- <card-matchup-person class="cursor-pointer" @open="openResult(es.user_event, item, 1)" :profile_image="item.matchup_owner.profile_picture" :name="`${item.matchup_owner.first_name} ${item.matchup_owner.last_name}`" :notes="item.matchup_notes"></card-matchup-person>
                    <card-matchup-status class="match-icon" :status="item.matchup_final"></card-matchup-status> -->
                    <card-matchup-person class="cursor-pointer owner-matchup" @open="openResult(es.user_event, item, 2)" :profile_image="item.matchup_owner.profile_image ? item.matchup_owner.profile_picture : null" :name="`${item.matchup_user.first_name}`" :notes="item.matchup_user_to_owner_notes"></card-matchup-person>

                </div>
            </div>
            <div v-if="es.friends && es.friends.length" class="matchup-main-container max-width-1020 m-auto mt-3">
                <div class="d-flex justify-content-center align-items-center gap-10 mb-4 px-2 text-center">
                    <span class="display-6 fw-bold mr-2">FRIEND</span> <card-matchup-status :status="2"></card-matchup-status>
                </div>
                <div v-for="(item, i) in es.friends" :key="`items-${i}`" class="d-flex align-items-center justify-content-center gap-16 pb-4">
                    <!-- <card-matchup-person class="cursor-pointer" @open="openResult(es.user_event, item, 1)" :profile_image="item.matchup_owner.profile_picture" :name="`${item.matchup_owner.first_name} ${item.matchup_owner.last_name}`" :notes="item.matchup_notes"></card-matchup-person>
                    <card-matchup-status  class="match-icon" :status="item.matchup_final"></card-matchup-status> -->
                    <card-matchup-person class="cursor-pointer owner-matchup" @open="openResult(es.user_event, item, 2)" :profile_image="item.matchup_owner.profile_image ? item.matchup_owner.profile_picture : null" :name="`${item.matchup_user.first_name}`" :notes="item.matchup_user_to_owner_notes"></card-matchup-person>

                </div>
            </div>
        </div>

        <div v-if="router.currentRoute.value.query.type == 'final_result'" class="mt-5 text-center">
            <p>
                <strong>Thanks so much for joining us!</strong> We hope you’re excited to explore any new connections that came out of this event.
            </p>
            <p>
                Every event brings a fresh mix of people and possibilities, so whether you think you found your person or didn’t quite feel a spark this time, we’re really glad you put yourself out there.
            </p>
            <p>Keep going, stay open, and remember there are always more opportunities to connect. We’d love to see you again soon.</p>
        </div>

        <div v-else class="mt-5 text-center">
            <p>
                <span class="fw-bold">Want to make changes?</span> You have until <span class="fw-bold">7:00 AM tomorrow</span> to modify your selections. After this time, match results will already be sent out, and no further modifications can be made.
            </p>
            <p>
                <strong>Friendly Reminder:</strong> If you selected "Friend" for someone who selected "Date" for you, you will still receive a Friend match. You don't need to select both options.
            </p>

            <p>
                We hope you made some meaningful connections tonight!
            </p>
        </div>
        
    </div>
</template>

<style lang="scss" scoped>
    .match-result-container {
        .head-title {
            font-weight: 900 !important;
            margin-bottom: 2rem;

            @include mobile-lg {
                font-size: 20px !important;
                word-wrap: break-word;
            }
        }

        .sub-header {
            font-size: 20px;
            margin-top: 2rem;
            font-weight: 500;
            @include mobile-lg {
                font-size: 16px;
            }
        }

        .matchup-main-container {
            .selection {
                @include mobile-lg {
                    flex-direction: column !important;
                    padding: 10px;
                    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                    margin-bottom: 1rem;
                    border-radius: 10px;
                }
            }
        }
    }
</style>
