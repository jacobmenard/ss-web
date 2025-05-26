<script lang="ts" setup>
import { nextTick, onMounted, ref } from "vue"


    const feedback = useFeedback()
    const fs = useFeedbackStore()
    const pageNumber = ref(1)
    const openViewFeedback = ref(false)
    const info = ref(null)

    async function getFeedbacks(isNext: any) {

        if (isNext) {
            pageNumber.value++
        } else {
            pageNumber.value--
        }

        await feedback.userFeedback({
            pageSize: 20,
            page: pageNumber.value
        })
    }
    
    function openFeedbackModal(data: any) {
        info.value = data
        openViewFeedback.value = true
    }

    onMounted(async () => {
        await nextTick()
        await feedback.userFeedback({
            pageSize: 20,
            page: pageNumber.value
        })
    })


</script>

<template>
    <div class="feedback-container">
        

        <div class="header-title">
            <span>Feedback list</span>
        </div>

        <b-table-simple hover striped class="border">
            
            <b-thead>
                <b-tr>
                    <b-th>Event ID</b-th>
                    <b-th>Host</b-th>
                    <b-th>Venue</b-th>
                    <b-th>Event</b-th>
                    <b-th>Website</b-th>
                    <b-th>Others</b-th>
                    <b-th>Action</b-th>
                </b-tr>
            </b-thead>

            <b-tbody>
                <b-tr v-for="(item, i) in fs.feedbackList" :key="`feedback-${i}`" class="cursor-pointer">
                    <b-td>
                        <a href="#" class="fw-bold">{{ item.event.event_id }}</a>
                        
                        <div class="fw-bold">{{ item.event.user.name }}
                            <span class="d-block">
                                {{ item.event.user.email }}
                            </span>
                        </div>
                        <div>
                            <small>{{ `${item.created_at} (${item.created_at_human})` }}</small>
                        </div>
                    </b-td>
                    <b-td>
                        <div class="d-flex flex-column gap-10">
                            <template v-if="item.hostPoints">
                                <img v-if="item.hostPoints == 1" src="~assets/images/star1.svg" class="stars" alt="star1">
                                <img v-if="item.hostPoints == 2" src="~assets/images/star2.svg" class="stars" alt="star2">
                                <img v-if="item.hostPoints == 3" src="~assets/images/star3.svg" class="stars" alt="star3">
                                <img v-if="item.hostPoints == 4" src="~assets/images/star4.svg" class="stars" alt="star4">
                                <img v-if="item.hostPoints == 5" src="~assets/images/star5.svg" class="stars" alt="star5">
                            </template>
                            <span class="truncate truncate--3">{{ item.host_feedback }}</span>
                        </div>
                    </b-td>
                    <b-td>
                        <div class="d-flex flex-column gap-10">
                            <template v-if="item.venue_points">
                                <img v-if="item.venue_points == 1" src="~assets/images/star1.svg" class="stars" alt="star1">
                                <img v-if="item.venue_points == 2" src="~assets/images/star2.svg" class="stars" alt="star2">
                                <img v-if="item.venue_points == 3" src="~assets/images/star3.svg" class="stars" alt="star3">
                                <img v-if="item.venue_points == 4" src="~assets/images/star4.svg" class="stars" alt="star4">
                                <img v-if="item.venue_points == 5" src="~assets/images/star5.svg" class="stars" alt="star5">
                            </template>
                            <span class="truncate truncate--3">{{ item.venue_feedback }}</span>
                        </div>
                    </b-td>
                    <b-td>
                        <div class="d-flex flex-column gap-10">
                            <template v-if="item.event_points">
                                <img v-if="item.event_points == 1" src="~assets/images/star1.svg" class="stars" alt="star1">
                                <img v-if="item.event_points == 2" src="~assets/images/star2.svg" class="stars" alt="star2">
                                <img v-if="item.event_points == 3" src="~assets/images/star3.svg" class="stars" alt="star3">
                                <img v-if="item.event_points == 4" src="~assets/images/star4.svg" class="stars" alt="star4">
                                <img v-if="item.event_points == 5" src="~assets/images/star5.svg" class="stars" alt="star5">
                            </template>
                            <span class="truncate truncate--3">{{ item.event_feedback }}</span>
                        </div>
                    </b-td>
                    <b-td>
                        <div class="d-flex flex-column gap-10">
                            <template v-if="item.website_points">
                                <img v-if="item.website_points == 1" src="~assets/images/star1.svg" class="stars" alt="star1">
                                <img v-if="item.website_points == 2" src="~assets/images/star2.svg" class="stars" alt="star2">
                                <img v-if="item.website_points == 3" src="~assets/images/star3.svg" class="stars" alt="star3">
                                <img v-if="item.website_points == 4" src="~assets/images/star4.svg" class="stars" alt="star4">
                                <img v-if="item.website_points == 5" src="~assets/images/star5.svg" class="stars" alt="star5">
                            </template>
                            <span class="truncate truncate--3">{{ item.website_feedback }}</span>
                        </div>
                    </b-td>
                    <b-td>
                        <span class="truncate truncate--3">{{ item.other_feedback }}</span>
                    </b-td>
                    <b-td>
                        <b-button variant="ss-primary-button" @click="openFeedbackModal(item)">View</b-button>
                    </b-td>
                </b-tr>
            </b-tbody>  
        </b-table-simple>
        <div v-if="fs.getlink" class="d-flex justify-content-center gap-16 pb-5">
            <b-button variant="ss-primary-button" :disabled="!fs.getlink.prev ? true : false" @click="getFeedbacks(false)">Prev</b-button>
            <b-button variant="ss-primary-button" :disabled="!fs.getlink.next ? true : false" @click="getFeedbacks(true)">Next</b-button>
        </div>

        <modal-view-feedback v-model="openViewFeedback" :info="info" @close="openViewFeedback = false"></modal-view-feedback>
    </div>
</template>

<style lang="scss" scoped>
    .feedback-container {
        .stars {
            width: 100px;
            object-fit: contain;
        }
    }
</style>
