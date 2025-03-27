<template>
    <div class="ss-landing-container d-flex flex-column gap-50">
        <div class="d-flex justify-content-between gap-48">
            <div class="head-image-container position-relative w-100">
                <img src="~assets/images/header-image.png" class="w-100" alt="">

                <div class="d-flex flex-column position-absolute display-header-container gap-10">
                    <div>
                        <div class="big-header font-weight-700 letter-spacing-1">
                            <span>
                                REAL <span class="real-text" v-html="realText"></span>
                            </span>
                        </div>

                        <div class="margin-top-10">
                            <p>
                                Remember what it felt like to meet someone and instantly feel that spark? The kind that doesn't come from a perfectly filtered profile photo or a witty text exchange, but from genuine eye contact, shared laughter, and the unmistakable energy of being in the same room? That's what we're bringing back.
                            </p>
                            <p class="mb-5">
                                Welcome to Sips & Sparks, where we've created the antidote to dating app burnout. In a world of endless scrolling and ghosting, we're building spaces where authentic connections thrive, conversations flow naturally, and people rediscover the joy of meeting someone who makes their heart beat a little faster in person, in real time.
                            </p>
                        </div>
                    </div>

                    <b-button variant="ss-default-button ss-landing-header-button" class="shadow" @click="utils.redirectToEventbrite()">BROWSE EVENTS</b-button>
                </div>
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

    const realText = ref('')

    onMounted(async () => {
        wordFlick()
        await event.getEventList({order_by: 'start_asc', page_size : 4, time_filter: 'current_future'})
    })

    function wordFlick() {
        var words: any = ['People.', 'Chemistry.', 'Life.']
        var part: any = ''
        var i: any = 0
        var offset: any = 0
        var len: any = words.length
        var forwards: any = true
        var skip_count: any = 0
        var skip_delay: any = 15
        var speed: any = 70;
        setInterval(() => {
            
            if (forwards) {
                if (offset >= words[i].length) {
                    ++skip_count;
                    if (skip_count == skip_delay) {
                    forwards = false;
                    skip_count = 0;
                    }
                }
                }
                else {
                if (offset == 0) {
                    forwards = true;
                    i++;
                    offset = 0;
                    if (i >= len) {
                    i = 0;
                    }
                }
                }

                part = words[i].substr(0, offset);
                if (skip_count == 0) {
                if (forwards) {
                    offset++;
                }
                else {
                    offset--;
                }
                }
                realText.value = part
        }, speed);
    }
    
    
</script>


<style lang="scss">
    .ss-landing-container {
        @include mobile-lg {
            gap: 30px !important;
        }

        .head-image-container {
            @include resolution(1200px) {
                img {
                    display: none;
                }
            }
        }
        .display-header-container {
            color: $white1;
            top: 6rem;
            left: 1rem;
            width: 50%;
            padding: 0 1.5rem;

            @include resolution(1400px) {
                top: 2rem;
            }

            @include resolution (1200px) {
                position: relative !important;
                top: 0px;
                p {
                    color: $red1;
                }
                width: 100%;
                padding-left: 0px;
            }

            

            @include mobile-lg {
                margin-bottom: 1rem;
                .small-header {
                    font-size: 20px !important;
                    line-height: 20px !important;
                }

                .big-header {
                    font-size: 34px !important;
                    line-height: normal !important;
                }

                gap: 20px !important;

                p {
                    margin-bottom: 1rem !important;
                }
            }

            .big-header {
                font-size: 6em;
                line-height: normal;
                letter-spacing: 0;
                @include resolution(1610px) {
                    font-size: 72px;
                }

                @include resolution(1400px) {
                    font-size: 48px;
                }

                @include resolution(1200px) {
                    color: $red1;
                }

                .real-text {
                    font-family: "Pacifico", cursive;
                    font-weight: 400;
                    font-style: normal;
                    letter-spacing: 0;
                    
                }
            }
        }

        .ss-landing {
            @include mobile-lg {
                display: none;
            }

            @include resolution(1024px) {
                display: none;
            }
        }

        .ss-landing-header-button {
            height: 80px;
            width: 300px;
            color: $red1 !important;
            background-color: $white1 !important;
            letter-spacing: normal;
            @include mobile-lg {
                width: 203px !important;
                height: 61px !important; 

                font-size: 12px !important;
                line-height: 12px !important;

            }

            @include resolution(1200px) {
                color: $white1 !important;
                background-color: $red1 !important;
            }

            @include resolution(1024px) {
                height: 80px;
                width: 250px;
            }
        }
    }
</style>