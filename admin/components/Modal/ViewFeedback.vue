<script lang="ts" setup>
    const props = defineProps<{
        info: any
    }>()
    
</script>

<template>
    <b-modal size="xl" no-footer title="Feedback information" centered id="view-feedback" class="ss-default-modal">
        <div v-if="info" class="view-feedback-container px-3">
            <div class="d-flex flex-column gap-10 mb-3 border-bottom py-3">
                <span>Event ID: <span class="fw-bold">{{ info.event.event_id }}</span></span>
                <span>Attendee name: <span class="fw-bold">{{ info.event.user.name }}</span></span>
                <span>Created at: <span class="fw-bold">{{ `${info.created_at} (${info.created_at_human})` }}</span></span>
            </div>

            <div class="d-flex flex-column gap-10">
                <div class="border-bottom py-1">
                    <div class="d-flex align-items-center gap-10 mb-2">
                        <span>Host feedback:</span>
                        <template v-if="info.hostPoints">
                            <img v-if="info.hostPoints == 1" src="~assets/images/star1.svg" class="stars" alt="star1">
                            <img v-if="info.hostPoints == 2" src="~assets/images/star2.svg" class="stars" alt="star2">
                            <img v-if="info.hostPoints == 3" src="~assets/images/star3.svg" class="stars" alt="star3">
                            <img v-if="info.hostPoints == 4" src="~assets/images/star4.svg" class="stars" alt="star4">
                            <img v-if="info.hostPoints == 5" src="~assets/images/star5.svg" class="stars" alt="star5">
                        </template>
                    </div>

                    <p v-if="info.host_feedback">{{ info.host_feedback }}</p>
                    <p v-else>No host feedback provided</p>
                </div>

                <div class="border-bottom py-2">
                    <div class="d-flex align-items-center gap-10 mb-2">
                        <span>Venue feedback:</span>
                        <template v-if="info.venue_points">
                            <img v-if="info.venue_points == 1" src="~assets/images/star1.svg" class="stars" alt="star1">
                            <img v-if="info.venue_points == 2" src="~assets/images/star2.svg" class="stars" alt="star2">
                            <img v-if="info.venue_points == 3" src="~assets/images/star3.svg" class="stars" alt="star3">
                            <img v-if="info.venue_points == 4" src="~assets/images/star4.svg" class="stars" alt="star4">
                            <img v-if="info.venue_points == 5" src="~assets/images/star5.svg" class="stars" alt="star5">
                        </template>
                    </div>

                    <p v-if="info.venue_feedback">{{ info.venue_feedback }}</p>
                    <p v-else>No venue feedback provided</p>
                </div>
                
                <div class="border-bottom py-2">
                    <div class="d-flex align-items-center gap-10 mb-2">
                        <span>Venue feedback:</span>
                        <template v-if="info.event_points">
                            <img v-if="info.event_points == 1" src="~assets/images/star1.svg" class="stars" alt="star1">
                            <img v-if="info.event_points == 2" src="~assets/images/star2.svg" class="stars" alt="star2">
                            <img v-if="info.event_points == 3" src="~assets/images/star3.svg" class="stars" alt="star3">
                            <img v-if="info.event_points == 4" src="~assets/images/star4.svg" class="stars" alt="star4">
                            <img v-if="info.event_points == 5" src="~assets/images/star5.svg" class="stars" alt="star5">
                        </template>
                    </div>

                    <p v-if="info.event_feedback">{{ info.event_feedback }}</p>
                    <p v-else>No event feedback provided</p>
                </div>
                
                <div class="border-bottom py-2">
                    <div class="d-flex align-items-center gap-10 mb-2">
                        <span>Venue feedback:</span>
                        <template v-if="info.website_points">
                            <img v-if="info.website_points == 1" src="~assets/images/star1.svg" class="stars" alt="star1">
                            <img v-if="info.website_points == 2" src="~assets/images/star2.svg" class="stars" alt="star2">
                            <img v-if="info.website_points == 3" src="~assets/images/star3.svg" class="stars" alt="star3">
                            <img v-if="info.website_points == 4" src="~assets/images/star4.svg" class="stars" alt="star4">
                            <img v-if="info.website_points == 5" src="~assets/images/star5.svg" class="stars" alt="star5">
                        </template>
                    </div>

                    <p v-if="info.website_feedback">{{ info.website_feedback }}</p>
                    <p v-else>No website feedback provided</p>
                </div>
                
                <div class="border-bottom py-2">
                    <p v-if="info.other_feedback">{{ info.other_feedback }}</p>
                    <p v-else>No other feedback provided</p>
                </div>

            </div>
        </div>
    </b-modal>
</template>

<style lang="scss" scoped>
    #view-feedback {
        span {
            font-size: 16px !important;
        }
        .stars {
            width: 100px;
            object-fit: contain;
        }
    }
</style>
