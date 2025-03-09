<template>
    <div class="card-about-us d-flex gap-20">
        <div class="title mobile margin-bottom-25">
            <slot name="title">
                <span>
                    <span class="pink-color">FOUNDER</span>, ZOE CRAMER
                </span>
            </slot>
        </div>
        <div class="about-us-image">
            <slot name="image">
                <!-- <img src="~assets/images/aboutus1.svg" alt=""> -->
            </slot>
        </div>

        <div class="about-content w-100">
            <div class="title margin-bottom-25">
                <slot name="title">
                    <span>
                        <span class="pink-color">FOUNDER</span>, ZOE CRAMER
                    </span>
                </slot>
            </div>

            <div class="content">
                <slot name="content">
                    <!-- <p>
                        Lorem ipsum dolor sit amet consectetur. In donec morbi malesuada mauris id quam. Amet mauris integer phasellus sed ut pellentesque pretium vitae. Cursus pellentesque pulvinar consequat purus quis at imperdiet pellentesque. Nulla quam duis nam in semper. At sit vulputate amet odio orci rhoncus ut. Tortor tincidunt sem auctor ornare aliquet pellentesque. Ac mattis viverra tellus fames scelerisque eget sit ipsum ullamcorper. Lacus eleifend nec tortor vitae dictum at hendrerit sed. Feugiat magna diam pretium integer elementum lectus quisque.
                    </p> -->
                </slot>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
    .card-about-us {
        @include mobile-lg {
            flex-direction: column;
        }

        &:nth-child(odd) {
            flex-direction: row-reverse;
            @include mobile-lg {
                flex-direction: column;
            }
        }
        .about-us-image {
            background-color: $white1;
            min-width: 500px;
            max-width: 500px;

            @include mobile-lg {
                min-width: unset;
            }

            img {
                object-fit: contain;
                width: 100%;
            }
        }
        .title {
            @include bugaki-font(26px, 36.4px, 400, $red);

            @include mobile-lg {
                font-size: 24px !important;
                line-height: 33.6px !important;
                
            }

            @include mobile-lg {
                display: none;
            }

            &.mobile {
                display: none;
                @include mobile-lg {
                    display: block;
                    margin-bottom: 0px !important;
                }
            }
        }

        .content {
            @include font-custom(18px, 28px, 400, $red);

            @include mobile-lg {
                font-size: 14px !important;
                line-height: 22.4px !important;
            }
        }

    }
</style>