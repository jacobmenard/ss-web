<template>
    <div class="ss-landing-container d-flex flex-column gap-177">
        <div class="d-flex justify-content-between gap-32">
            <div class="d-flex flex-column display-header-container gap-48">
                <div>
                    <div class="small-header display-header-36 font-weight-700 letter-spacing-1">REAL PEOPLE.</div>
                    <div class="big-header display-header-128 font-weight-700 letter-spacing-1">REAL CHEMISTRY. <br> REAL LIFE.</div>

                    <div class="margin-top-10">
                        <p>
                            Remember what it felt like to meet someone and instantly feel that spark? The kind that doesn't come from a perfectly filtered profile photo or a witty text exchange, but from genuine eye contact, shared laughter, and the unmistakable energy of being in the same room? That's what we're bringing back. Welcome to Sips & Sparks, where we've created the antidote to dating app burnout. In a world of endless scrolling and ghosting, we're building spaces where authentic connections thrive, conversations flow naturally, and people rediscover the joy of meeting someone who makes their heart beat a little faster in person, in real time.

                        </p>
                    </div>
                </div>

                <b-button variant="ss-default-button ss-landing-header-button" @click="utils.redirectToEventbrite()">BUY TICKETS</b-button>
            </div>

            <div class="ss-landing header">
                <img src="~assets/images/landing-header.svg" alt="">
            </div>
        </div>

        <!-- <div data-events-calendar-app data-project-id="proj_xkk9tgEVssGlE8nEbGCIK" ></div> -->

        <card-event></card-event>

        <landing-event></landing-event>

        <landing-recent-post></landing-recent-post>

        <landing-spark-connection></landing-spark-connection>
    </div>
</template>

<script setup lang="ts">
    import { onMounted } from 'vue';
    import { useGlobal } from '@/composables/useEvent'

    const event = useEventStore()
    const user = useUserStore()
    const utils = useGlobal()

    

    onMounted(async () => {
        await event.getEventList()
    })
    
    
</script>

<style lang="scss">
    .ss-landing-container {
        @include mobile-lg {
            gap: 30px !important;
        }
        .display-header-container {
            color: $red1;

            @include mobile-lg {
                .small-header {
                    font-size: 20px !important;
                    line-height: 20px !important;
                }

                .big-header {
                    font-size: 34px !important;
                    line-height: normal !important;
                }

                gap: 20px !important;
            }
        }

        .ss-landing {
            @include mobile-lg {
                display: none;
            }
        }

        .ss-landing-header-button {
            height: 104px;
            width: 500px;

            @include mobile-lg {
                width: 203px;
                height: 61px;

                font-size: 12px !important;
                line-height: 12px !important;

            }
        }
    }
</style>