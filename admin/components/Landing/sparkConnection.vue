<template>
    <div class="spark-connection-container d-flex gap-115 justify-content-center align-items-center">
        
        <div class="spark-connection-content letter-spacing-1">
            SPARK CONNECTIONS <span class="d-block">TODAY!</span>
        </div>

        <b-button variant="ss-default-button">BUY TICKETS</b-button>
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