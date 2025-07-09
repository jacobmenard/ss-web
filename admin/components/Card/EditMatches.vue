<script lang="ts" setup>
    import { onMounted, ref, watch } from "vue"
    import friend from '@/assets/images/friend.svg'
    import date from '@/assets/images/date.svg'
    import none from '@/assets/images/none.svg'
    import business from '@/assets/images/business.svg'
    const es = useEventStore()
    const events = useEvents()

    const props = defineProps<{
        info: any
    }>()

    const allSelections = ref(null)

    watch(() => props.info, async(val: any) => {
        if (val) {
            allSelections.value = val
        }
    })

    const selectionType = ref([
        { value: 2, text: 'friend', image: friend },
        { value: 3, text: 'date', image: date },
        { value: 4, text: 'business', image: business },
        // { value: 1, text: 'none', image: none },
    ])

    async function addParticipantStatus(selection: any) {
        let selectedFeedback = []
        if (!selection.matchFeedbackForEdit.length) {
            useNuxtApp().$toast('Select atleast one to edit match feedback', {type: 'error'});
            return
        }
        if (selection.matchFeedbackForEdit.length) {
            selectedFeedback = selection.matchFeedbackForEdit.map((n: any) => {
                return n.value
            })
        } 
        await events.setParticipantStatus({
            event_id: selection.event_id,
            user_id: selection.matchFeedback[0].user_id,
            matchup_id: selection.user_id,   
            matchup_status: selectedFeedback,
            matchup_notes: ''
        })

    }
    
</script>

<template>
    <div class="selection-main-container d-flex gap-16 h-100 flex-column">
        <div class="selection-wrapper d-flex flex-column h-100 gap-16">
            <div v-for="(item, i) in es.getSelections" :key="`selections-${i}`" class="participants gap-16 border-radius-10 shadow-sm border p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fw-bold">
                        <span>{{ `${item.user.first_name} ${item.user.last_name}` }}</span>
                    </div>
                    

                    <div class="d-flex gap-16 align-items-start">
                        <b-form-checkbox-group v-model="item.matchFeedbackForEdit" class="d-flex justify-content-center flex-wrap gap-16">
                            <b-form-checkbox v-for="(item, i) in selectionType" class="ss-checkbox-default d-flex align-items-center gap-6" :key="`selection-${i}`" :value="item">
                                <img :src="item.image" height="20" class="object-fit-contain" :alt="item.text">
                            </b-form-checkbox>
                        </b-form-checkbox-group>

                        <div @click="addParticipantStatus(item)" class="green-circle-container cursor-pointer">
                            <img src="~assets/images/green-circle.png" height="20" alt="green-circle">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="d-flex justify-content-end w-100">
            <b-button variant="ss-primary-button" class="h-50 fw-bold" @click="updateSelection" :disabled="isLoadingUpdateSelection">Save selection</b-button>
        </div> -->
    </div>
</template>

<style lang="postcss" scoped>
    
</style>
