<script setup lang="ts">
    import { nextTick, onMounted, ref } from 'vue'
    import { useEvent } from '@/composables/useEvent'

    definePageMeta({
        middleware: ['sanctum:auth'],
    });
    
    const event = useEvent()
    const es = useEventStore()
    const router = useRouter()
    const auth = useSanctumUser();

    const form = ref({
        host_points: '',
        host_feedback: '',
        venue_points: '',
        venue_feedback: '',
        event_points: '',
        event_feedback: '',
        website_points: '',
        website_feedback: '',
        other_feedback: '',
        user_id: '',
        name: '',
        eid: '',
        email: ''
    })

    const loading = ref(false)

    async function submitFeedback() {
        loading.value = true
        form.value.user_id = router.currentRoute.value.params._id
        form.value.eid = router.currentRoute.value.query.eid
        form.value.email = auth.value.data.email
        form.value.name = auth.value.data.first_name
        await event.sendFeedback(form.value)
        loading.value = false 
    }

    onMounted(async () => {
        await nextTick()
        await event.getFeedback({
            user_id: router.currentRoute.value.params._id,
            eid: router.currentRoute.value.query.eid
        })

        form.value = es.getFeedback
        
    })
</script>
<template>
    <div class="mf-feedback d-flex flex-column gap-50">
        <header-title-one class="max-width-1100 m-auto match-form">
            <template #header>
                    SIPS <span class="symbol">&</span> SPARKS
                    <span class="d-block black1">HELP US</span>
                    <span class="d-block black1">HELP YOU<span class="symbol">!</span></span>
            </template>
            <template #sub-header>
                <p class="feedback-introduction text-center">
                    We’d really appreciate your feedback! Please rate each statement from 1 (strongly disagree) to 5 (strongly agree).

                </p>
            </template>
        </header-title-one>

        <!-- <card-feedback-items v-model="host" :dropdownId="host" labelTitle="‘The host helped me feel comfortable during the event.’"></card-feedback-items>
        <card-feedback-items v-model="venue" :dropdownId="venue" labelTitle="‘The venue was a good fit for the event.’"></card-feedback-items>
        <card-feedback-items v-model="event" :dropdownId="event" labelTitle="‘The event flow and rotations were satisfactory.’"></card-feedback-items>
        <card-feedback-items v-model="website" :dropdownId="website" labelTitle="‘The website and match form were easy to navigate.’"></card-feedback-items>
        <card-feedback-items v-model="other" :dropdownId="other" labelTitle="Any other questions or comments?" :noRadio="true"></card-feedback-items> -->

        <b-form @submit.stop.prevent="submitFeedback">
            <div class="mf-feedback-items d-flex flex-column gap-25 mb-4">
                <p>The host helped me feel comfortable during the event.</p>
                <b-form-group class="d-flex justify-content-center flex-wrap gap-25 w-100">
                    <b-form-radio  v-for="(item) in 5" v-model="form.host_points" :state="false" name="host_points" :value="item" class="ss-radio-feedback" :key="`selection-${item}`">
                        {{ item }}
                    </b-form-radio>
                </b-form-group>
                <b-form-textarea v-model="form.host_feedback" class="ss-textarea-form-default" placeholder="Additional Comments" rows="5" max-rows="10"></b-form-textarea>
            </div>
            
            <div class="mf-feedback-items d-flex flex-column gap-25 mb-4">
                <p>The venue was a good fit for the event.</p>
                <b-form-group class="d-flex justify-content-center flex-wrap gap-25 w-100">
                    <b-form-radio  v-for="(item) in 5" v-model="form.venue_points" :state="false" name="venue_points" :value="item" class="ss-radio-feedback" :key="`selection-${item}`">
                        {{ item }}
                    </b-form-radio>
                </b-form-group>
                <b-form-textarea v-model="form.venue_feedback" class="ss-textarea-form-default" placeholder="Additional Comments" rows="5" max-rows="10"></b-form-textarea>
            </div>

            <div class="mf-feedback-items d-flex flex-column gap-25 mb-4">
                <p>The event flow and rotations were satisfactory.</p>
                <b-form-group class="d-flex justify-content-center flex-wrap gap-25 w-100">
                    <b-form-radio  v-for="(item) in 5" v-model="form.event_points" :state="false" name="event_points" :value="item" class="ss-radio-feedback" :key="`selection-${item}`">
                        {{ item }}
                    </b-form-radio>
                </b-form-group>
                <b-form-textarea v-model="form.event_feedback" class="ss-textarea-form-default" placeholder="Additional Comments" rows="5" max-rows="10"></b-form-textarea>
            </div>

            <div class="mf-feedback-items d-flex flex-column gap-25 mb-4">
                <p>The website and match form were easy to navigate.</p>
                <b-form-group class="d-flex justify-content-center flex-wrap gap-25 w-100">
                    <b-form-radio  v-for="(item) in 5" v-model="form.website_points" :state="false" name="website_points" :value="item" class="ss-radio-feedback" :key="`selection-${item}`">
                        {{ item }}
                    </b-form-radio>
                </b-form-group>
                <b-form-textarea v-model="form.website_feedback" class="ss-textarea-form-default" placeholder="Additional Comments" rows="5" max-rows="10"></b-form-textarea>
            </div>

            <div class="mf-feedback-items d-flex flex-column gap-25 mb-5">
                <p>Any other questions or comments?</p>
                <b-form-textarea v-model="form.other_feedback" class="ss-textarea-form-default" placeholder="Additional Comments" rows="5" max-rows="10"></b-form-textarea>
            </div>

            <!-- <div>
                <span class="d-block mb-3 font-weight-bold">Where did you hear about us?</span>
                <b-dropdown size="lg"  variant="link" text="CHOOSE ONE" block toggle-class="text-decoration-none header-menu-list feedback-dropdown" menu-class="w-100">
                    <b-dropdown-item v-for="item in 10" :key="item">{{ `SELECTION ITEM ${item}` }}</b-dropdown-item>
                </b-dropdown>
            </div> -->
            
            <div class="text-center">
                <b-button v-if="!loading" type="submit" variant="ss-default-button" class="mf-button">SUBMIT</b-button>
                <b-button v-if="loading" variant="ss-default-button" class="mf-button" disabled>SUBMITTING...</b-button>
            </div>
        </b-form>
    </div>
</template>

<style lang="scss">
.mf-feedback {
    
    .black1 {
        color: $black2;
    }

    .feedback-introduction {
        font-size: 20px;
        line-height: 28px;
    }

    .header-menu-list {
        background-color: $red1;
        width: 100%;
        color: $white1;
        font-weight: 500;
    }
    

}
</style>