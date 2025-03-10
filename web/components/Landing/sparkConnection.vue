<script lang="ts" setup>
    import { useGlobal } from '@/composables/useEvent';

    const utils = useGlobal()
</script>

<template>
    <div class="spark-connection-container d-flex gap-50 flex-column justify-content-center align-items-center">
        
        <!-- <div class="spark-connection-content letter-spacing-1">
            SPARK CONNECTIONS <span class="d-block">TODAY!</span>
        </div> -->

        <div class="new-spark-connection-content">
            <span class="d-block">Ready to Meet Someone Who Makes Dating Feel Exciting Again
                <span style="font-family: Montserrat, sans-serif !important; font-weight: 700 !important;">?</span>
            </span>
            <p class="fw-normal">
                Our events consistently sell out because they work. People who attend don't just leave with phone numbers… they leave with stories, butterflies, and the reminder of what authentic connection feels like.
            </p>
        </div>

        <b-button variant="ss-default-button" @click="utils.redirectToEventbrite()">BROWSE UPCOMING EVENTS</b-button>
    </div>
    
</template>

<style lang="scss" scoped>
    .spark-connection-container {
        @include mobile-lg {
            flex-direction: column;
            gap: 17px !important;
        }
        .spark-connection-content {

            @include font-custom(51px, normal, 700, $red1);
            @include mobile-lg {
                font-size: 28px !important;
                line-height: 40px !important;
            }
            > span {
                @include font-custom(154px, 142px, 700, $red1);
                @include mobile-lg {
                    font-size: 83px !important;
                    line-height: 75px !important;
                }
            }
        }

        .new-spark-connection-content {
            span {
                @include bugaki-font(50px, normal, 500, $red1) {
                    margin-bottom: 1rem;
                }

                @include mobile-lg {
                    font-size: 22px !important;
                }
            }

            p {
                font-size: 22px;
                color: $red1;
                @include mobile-lg {
                    font-size: 16px;
                }
            }
        }

        .new-spark-connection-content {
            
        }

        .btn-ss-default-button {
            width: 368px;
            height: 104px;

            @include mobile-lg {
                height: 60px;
                width: 203px;
                @include mobile-lg {
                    font-size: 14px !important;
                }
            }
        }
    }
</style>