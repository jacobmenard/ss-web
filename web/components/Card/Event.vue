<script lang="ts" setup>
    import { useUtils} from '@/composables/useUtils'
    const es = useEventStore()
    const utils = useUtils()
    function gotoEvent(url) {
        window.open(url, '_blank');
    }

    function goToMarchForm(event_id) {
        // const url = new URL(, "_blank")
        // window.location.href = url.toString()
    }
</script>

<template>
    
    <div v-if="es.getEvents && es.getEvents.length" class="event-container d-flex justify-content-center flex-column gap-22 w-100">
        <h3 class="header text-center font-weight-700 m-0 text-uppercase mb-3">
            UPCOMING EVENTS
        </h3>
        <div class="d-flex justify-content-center flex-wrap gap-22">
            <div class="ss-event-wrapper rounded overflow-hidden flex-column gap-16" v-for="(item, i) in es.getEvents" :key="i">
                <div class="event-img-container d-flex align-items-center justify-content-center overflow-hidden">
                    <img :src="item.logo.url" class="object-fit-contain" alt="">
                </div>

                <div class="ss-event-content">
                    <div class="padding-all-13 d-flex flex-column gap-10">
                        <p class="fw-bold margin-bottom-0 truncate truncate--2">
                            {{ item.name.text }}
                        </p>
                        <div>
                            <span class="d-block">Event starts at 
                                <span class="font-weight-bold">{{ `${utils.momentTimezone(item.start.local)}` }}</span>
                            </span>
                        </div>

                        <b-button variant="ss-primary-button" @click="gotoEvent(item.url)">View event</b-button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<style lang="scss" scoped>
    .event-container {
        .header {
            font-size: 128px;
            letter-spacing: -0.05em;
            color: $red1;
            @include mobile-lg {
                font-size: 34px !important;
                line-height: normal !important;
            }
            @include resolution(1610px) {
                font-size: 72px;
            }
        }
        .ss-event-wrapper {
            width: 450px;
            cursor: pointer;
            .event-img-container {
                width: 100%;
                height: 150px;
            }

            box-shadow: 0px 4px 4px 0px #00000040;
            background-color: transparent;
        }

        .ss-event-content {
            p {

            }
        }
    }
</style>
