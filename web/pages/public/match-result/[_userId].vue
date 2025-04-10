
<script lang="ts" setup>
import { onMounted, ref } from "vue";

    const events = useEvent()
    const es = useEventStore()
    const router = useRouter()
    const utils = useUtils()
    const us = useUserStore()

    const isLoadingMatchresult = ref(false)
    
    onMounted(async () => {
        isLoadingMatchresult.value = true
        await events.getMatchupResult({
            eid: router.currentRoute.value.query.eid,
            user_id: router.currentRoute.value.params._userId,
            urlForm: true
        })
        isLoadingMatchresult.value = false
    })

    function openResult(userEvent: any, info: any) {
        us.setOpenMatchupResultFinal(true, userEvent, info)
    }

</script>

<template>
    <div class="match-result-container">
        <div v-if="es.user" class="head-title text-center fw-bold">
            Hi {{ es.user.first_name }}
            <div v-if="es.event" class="sub-header">Below are the summary of the selections you made for the event <span class="fw-bold">{{ `${es.event.name.text}` }}</span></div>
        </div>
        
        <div v-if="es.dates && es.dates.length" class="matchup-main-container max-width-1020 m-auto">
            <div class="mb-4 px-2 text-center">
                <span class="display-6 fw-bold">DATE</span>
            </div>
            <div v-for="(item, i) in es.dates" :key="`items-${i}`" class="d-flex align-items-center justify-content-center gap-16 pb-4">
                <card-matchup-person class="cursor-pointer" @open="openResult(es.user_event, item)" :profile_image="item.matchup_owner.profile_image" :name="`${item.matchup_owner.first_name} ${item.matchup_owner.last_name}`" :notes="item.matchup_notes"></card-matchup-person>
                <card-matchup-status :status="item.matchup_status"></card-matchup-status>
                <card-matchup-person :profile_image="item.matchup_user.profile_image" :name="`${item.matchup_user.first_name} ${item.matchup_user.last_name}`" :notes="item.matchup_user_to_owner_notes"></card-matchup-person>

            </div>
        </div>
        <div v-if="es.friends && es.friends.length" class="matchup-main-container max-width-1020 m-auto mt-3">
            <div class="mb-4 px-2 text-center">
                <span class="display-6 fw-bold">FRIEND</span>
            </div>
            <div v-for="(item, i) in es.friends" :key="`items-${i}`" class="d-flex align-items-center justify-content-center gap-16 pb-4">
                <card-matchup-person class="cursor-pointer" @open="openResult(es.user_event, item.matchup_owner)" :profile_image="item.matchup_owner.profile_image" :name="`${item.matchup_owner.first_name} ${item.matchup_owner.last_name}`" :notes="item.matchup_notes"></card-matchup-person>
                <card-matchup-status :status="item.matchup_status"></card-matchup-status>
                <card-matchup-person :profile_image="item.matchup_user.profile_image" :name="`${item.matchup_user.first_name} ${item.matchup_user.last_name}`" :notes="item.matchup_user_to_owner_notes"></card-matchup-person>

            </div>
        </div>

        <div class="mt-5 text-center">
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
    }
</style>
