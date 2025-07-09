<script lang="ts" setup>
import { nextTick, onMounted, ref, watch } from 'vue'
import { useEvent } from '@/composables/useEvent'
import friend from '@/assets/images/friend.svg'
import date from '@/assets/images/date.svg'
import none from '@/assets/images/none.svg'
import business from '@/assets/images/business.svg'

definePageMeta({
    middleware: ['sanctum:auth'],
});

const router = useRouter()
const event = useEventStore()
const ev = useEvent()
const auth = useSanctumUser()

const screenNumber = ref(1)
const selectionType = ref([
    { value: 2, text: 'friend', image: friend },
    { value: 3, text: 'date', image: date },
    { value: 4, text: 'business', image: business },
    // { value: 1, text: 'none', image: none },
])

const shareType = ref([
    { value: 1, text: 'Yes, share my email.' },
    { value: 0, text: 'No, keep me anonymous' }
])
const selected = ref([])
const matchup_notes = ref('')
const phonenumber = ref('')
const selectedEvent = ref(null) 
const isLoading = ref(false)

onMounted(async() => {
    console.log(auth.value.data.id)
    await nextTick()
    await event.getParticipant({
        id: router.currentRoute.value.params._id,
        eventId: router.currentRoute.value.query.eid
    })
    await ev.getSelectEvent({
        user_id: auth.value.data.id,
        event_id: router.currentRoute.value.query.eid
    })
    if (event.selectedUser && event.selectedUser.match_feedback.length) {
        event.selectedUser.match_feedback.forEach((item: any) => {
            const selectedFeedback = selectionType.value.find((n: any) => n.value == item.matchup_status)

            if (selectedFeedback) {
                selected.value.push(selectedFeedback)
                matchup_notes.value = item.matchup_notes
            }

        });
    }
    selectedEvent.value = shareType.value.find((n: any) => n.value == event.getSelectedEvent.is_share_contact)
    phonenumber.value = auth.value.data.cell_phone
})

function changeScreenNumber() {
    if (screenNumber.value == 1) {
        // screenNumber.value = 2
        goToFeedback()
    } else {
        screenNumber.value = 1
    }
}

async function setShareContact() {
    await ev.updateVenueStatus({
        user_id: auth.value.data.id,
        event_id: router.currentRoute.value.query.eid,
        is_share_contact: selectedEvent.value.value
    })

}

function goToFeedback() {
    router.push({ path: `/feedback/${auth.value.data.id}`, query: { eid: router.currentRoute.value.query.eid } 
    })
}

function goToList() {

    router.push({ path: '/match-form/listview' })
}

async function addParticipantStatus() {
    isLoading.value = true
    let selectedFeedback = []
    if (selected.value.length) {
        selectedFeedback = selected.value.map((n) => {
            return n.value
        })
    } 
    await ev.setParticipantStatus({
        event_id: router.currentRoute.value.query.eid,
        matchup_id: router.currentRoute.value.params._id,   
        matchup_status: selectedFeedback,
        matchup_notes: matchup_notes
    })
    isLoading.value = false

}

async function goToListView() {
    if (!selected.value.length) {
        useNuxtApp().$toast('Error, please select match feedback.', {type: 'error'});
        return
    }

    await addParticipantStatus()
    router.back()
}

</script>

<template>
    <div class="mf-selection-container d-flex flex-column align-items-center">
        
        <header-title-one class="max-width-1100 match-form">
            <template #header>
                    SIPS <span class="symbol">&</span> SPARKS
            </template>
        </header-title-one>
        <div v-if="event.selectedUser" class="d-flex flex-column align-items-center gap-50 min-height-250 w-100 max-width-500">
            <div class="mf-selection-sub-header w-100 p-y-10 d-flex align-items-center justify-content-between p-x-20 gap-50">
                <span v-if="screenNumber == 1">Notes & selections</span>
                <span v-if="screenNumber == 2">Share contact info (Optional)</span>

                <div class="d-flex gap-20 selection-title-header-icons">
                    <template v-if="screenNumber == 1">
                        <img src="~assets/images/user-info.svg" height="30" class="object-fit-contain" alt="">
                        <img src="~assets/images/check.svg" height="30" class="object-fit-contain" alt="">
                    </template>

                    <template v-else>
                        <img src="~assets/images/telephone.svg" height="30" class="object-fit-contain" alt="">
                    </template>
                </div>
            </div>

            <div v-if="screenNumber == 1" class="mf-user-info-container d-flex flex-column w-100 gap-18">
                <div class="d-flex align-items-center flex-column gap-11">
                    <div v-if="event.selectedUser.matchup_user" class="user-img flex-shrink-0 border-radius-10 overflow-hidden">
                        <img v-if="event.selectedUser.matchup_user.profile_image" :src="event.selectedUser.matchup_user.profile_image" class="w-100 object-fit-contain" alt="">
                        <img v-else src="~assets/images/profile-group.svg" class="w-100 object-fit-contain" alt="">
                        <!-- <img src="~assets/images/matchform/user1.svg" class="w-100 object-fit-contain" alt=""> -->
                    </div>
                    
                    <span class="padding-all-8" v-if="event.selectedUser.matchup_user">
                        {{ event.selectedUser.matchup_user.first_name }}
                    </span>
                </div>
                
                <!-- <b-form-group class="d-flex justify-content-center flex-wrap gap-16"> -->
                    <!-- <b-form-radio v-for="(item, i) in selectionType" v-model="selected" @change="addParticipantStatus()" :state="false" :name="item.text" :value="item" class="ss-radio-default" :key="`selection-${i}`"> -->
                    <!-- <b-form-radio v-for="(item, i) in selectionType" v-model="selected" :state="false" :name="item.text" :value="item" class="ss-radio-default" :key="`selection-${i}`">
                        {{ item.text }}
                        <img :src="item.image" height="21" class="object-fit-contain" :alt="item.text">
                    </b-form-radio> -->
                <!-- </b-form-group> -->
                 
                <b-form-checkbox-group v-model="selected" class="d-flex justify-content-center flex-wrap gap-10 text-capitalize">
                    <b-form-checkbox v-for="(item, i) in selectionType" class="ss-checkbox-default" :key="`selection-${i}`" :value="item">
                        <div>{{ item.text }}</div>
                        <img :src="item.image" height="21" class="object-fit-contain" :alt="item.text">
                    </b-form-checkbox>
                </b-form-checkbox-group>
                
                <b-form> 
                    <!-- <b-form-textarea v-model="matchup_notes" @change="addParticipantStatus" class="ss-textarea-form-default" placeholder="Notes" rows="5" max-rows="10"></b-form-textarea> -->
                    <b-form-textarea v-model="matchup_notes" class="ss-textarea-form-default" placeholder="Notes" rows="5" max-rows="10"></b-form-textarea>
                </b-form>
            </div>

            <div v-if="screenNumber == 2" class="mf-user-info-container d-flex flex-column w-100 gap-18">
                <p>
                    Psst... we wanted to let you know that email addresses are not shared with those you check off. Do you want to change that?
                </p>
                <!-- <b-input v-model="phonenumber" class="ss-input-form-default" placeholder="Phone Number"></b-input> -->

                <b-form-group class="d-flex flex-column flex-wrap gap-16">
                    <b-form-radio v-for="(item, i) in shareType" v-model="selectedEvent" @change="setShareContact" :state="false"  :name="item.text" :value="item" class="ss-radio-default share" :key="`selection-${i}`">
                        {{ item.text }}
                    </b-form-radio>
                </b-form-group>
            </div>

            <div class="d-flex flex-column gap-10 max-width-350 w-100">

                <!-- <b-button v-if="screenNumber == 2" variant="ss-default-button" class="mf-button" @click="goToFeedback()">CONTINUE</b-button> -->
                <b-button v-if="screenNumber == 1" variant="ss-default-button" class="mf-button w-100" @click="goToListView()">SAVE AND BACK</b-button>
                <!-- <b-button variant="ss-default-button" class="mf-button" @click="changeScreenNumber()">{{ screenNumber == 1 ? 'CONTINUE' : 'BACK' }}</b-button> -->

            </div>

        </div>
    </div>
</template>

<style lang="scss">

.mf-selection-container {
    .mf-selection-sub-header {
        background-color: $red1;
        min-height: 93px;
        
        span {
            @include font-custom(24px, normal, 700, $white1) {
                text-transform: uppercase;
            }
        }

        
    }

    .mf-user-info-container {
        .user-img {
            width: 100%;
            max-width: 500px;
        }
        span {
            @include font-custom(24px, normal, 700, $red1) {
                // text-transform: uppercase;
                // background-color: $red1;
                // border-radius: 10px;
                // width: 100%;
            }
        }
    }

    .ss-radio-default.share {
        ~ .form-check-label {
            font-size: 20px !important;
            line-height: 28px !important;
            padding-left: 1rem !important;
        }
    }

    .selection-title-header-icons {
        @include resolution(374px) {
            display: none !important;
        }
    }
}
</style>