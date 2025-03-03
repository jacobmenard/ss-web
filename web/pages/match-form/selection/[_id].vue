<script lang="ts" setup>
import { ref } from 'vue'

definePageMeta({
    middleware: ['sanctum:auth'],
});

const router = useRouter()

const screenNumber = ref(1)
const selectionType = ref([
    { value: 1, text: 'friend' },
    { value: 2, text: 'date' },
    { value: 3, text: 'none' },
])

const shareType = ref([
    { value: 1, text: 'Yes, share my contact info with people I selected who didn’t pick me' },
    { value: 0, text: 'No, keep me anonymous' }
])
const selected = ref(selectionType[0])

function changeScreenNumber() {
    if (screenNumber.value == 1) {
        screenNumber.value = 2
    } else {
        screenNumber.value = 1
    }
}

function goToFeedback() {
    router.push({ path: '/feedback/1' })
}

</script>

<template>
    <div class="mf-selection-container d-flex flex-column align-items-center">
        <header-title-one class="max-width-1100 match-form">
            <template #header>
                    SIPS <span class="symbol">&</span> SPARKS
            </template>
        </header-title-one>

        <div class="d-flex flex-column align-items-center gap-50">
            <div class="mf-selection-sub-header w-100 p-y-10 d-flex align-items-center justify-content-between p-x-20 gap-50">
                <span v-if="screenNumber == 1">Notes & selections</span>
                <span v-if="screenNumber == 2">Share contact info (Optional)</span>

                <div class="d-flex gap-20">
                    <template v-if="screenNumber == 1">
                        <img src="~assets/images/user-info.svg" height="44" class="object-fit-contain" alt="">
                        <img src="~assets/images/check.svg" height="44" class="object-fit-contain" alt="">
                    </template>

                    <template v-else>
                        <img src="~assets/images/telephone.svg" height="44" class="object-fit-contain" alt="">
                    </template>
                </div>
            </div>

        

            <div v-if="screenNumber == 1" class="mf-user-info-container d-flex flex-column w-100 gap-18">
                <div class="d-flex align-items-end gap-11">
                    <div class="user-img flex-shrink-0 border-radius-10 overflow-hidden">
                        <img src="~assets/images/matchform/user1.svg" class="w-100 object-fit-contain" alt="">
                    </div>
                    
                    <span class="padding-all-8 max-width-350">
                        Christine
                    </span>
                </div>

                <b-form>
                    <b-form-textarea class="ss-textarea-form-default" placeholder="Notes" rows="5" max-rows="10"></b-form-textarea>
                </b-form>

                <b-form-group class="d-flex justify-content-center flex-wrap gap-16">
                    <b-form-radio v-for="(item, i) in selectionType" v-model="selected" :state="false" :aria-describedby="ariaDescribedby" :name="item.text" :value="item" class="ss-radio-default" :key="`selection-${i}`">
                        {{ item.text }}
                        <img v-if="item.value == 1" src="~assets/images/friend.svg" alt="">
                        <img v-if="item.value == 2" src="~assets/images/date.svg" alt="">
                        <img v-if="item.value == 3" src="~assets/images/none.svg" alt="">
                    </b-form-radio>
                </b-form-group>
            </div>

            <div v-if="screenNumber == 2" class="mf-user-info-container d-flex flex-column w-100 gap-18">
                <p>
                    Psst... we wanted to let you know that contact info is not shared with those you check off that didn’t check you. Want to change that?
                </p>

                <b-input class="ss-input-form-default" placeholder="Phone Number"></b-input>

                <b-form-group class="d-flex flex-column flex-wrap gap-16">
                    <b-form-radio v-for="(item, i) in shareType" v-model="selected" :state="false" :aria-describedby="ariaDescribedby" :name="item.text" :value="item" class="ss-radio-default share" :key="`selection-${i}`">
                        {{ item.text }}
                    </b-form-radio>
                </b-form-group>
            </div>

            <div class="d-flex flex-column gap-10">
                <b-button v-if="screenNumber == 2" variant="ss-default-button" class="mf-button" @click="goToFeedback()">CONTINUE</b-button>

                <b-button variant="ss-default-button" class="mf-button" @click="changeScreenNumber()">{{ screenNumber == 1 ? 'CONTINUE' : 'BACK' }}</b-button>
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
            width: 116px;
            height: 116px;
        }
        span {
            @include font-custom(24px, normal, 700, $white1) {
                text-transform: uppercase;
                background-color: $red1;
                border-radius: 10px;
                width: 100%;
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
}
</style>