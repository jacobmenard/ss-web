<template>
    <div class="recent-post-container d-flex flex-column align-items-center gap-50">
        <div class="top text-center"><span>
            SEE OUR RECENT POSTS
        </span></div>

        <div class="post-container overflow-hidden d-flex flex-column border-radius-10">
            <img src="~assets/images/recent-post-1.svg" alt="">
            <div class="post-content w-100 h-100 d-flex align-items-center justify-content-center">
                <p class="m-0">
                    Lorem ipsum dolor sit amet consectetur. Lacus ligula volutpat et convallis. 
                </p>
            </div>
        </div>

        <div class="follow-us d-flex gap-16 justify-content-center">
            <span class="">
                FOLLOW US<span class="exclamation">!</span>
            </span>
            <img src="~assets/images/facebook.svg" alt="">
            <img src="~assets/images/instagram.svg" alt="">
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .recent-post-container {
        @include mobile-lg {
            gap: 25px !important;
        }
        .follow-us {
            @include bugaki-font(67px, 67px, 400, $red1);
            @include mobile-lg {
                font-size: 35px !important;
                line-height: 67px !important;
                flex-wrap: wrap;
            }

            img {
                width: 54px;
                object-fit: contain;
                @include mobile-lg {
                    width: 25px;
                }
            }

        }

        .exclamation {
            @include font-custom(67px, 67px, 900, $red1) {
                font-family: 'Montserrat', sans-serif !important;
            }
            @include mobile-lg {
                font-size: 35px !important;
                line-height: 67px !important;
            }
        }

        .top {
            @include font-custom(64px, 64px, 700, $red1) {
                letter-spacing: -0.05em;
            }

            @include mobile-lg {
                font-size: 40px !important;
                line-height: 40px !important;
            }
        }

        .post-container {
            width: 500px;
            height: 649px;
            box-shadow: 0px 4px 4px 0px #00000040;
            @include mobile-lg {
                width: 250px;
                height: 324.5px;
            }
            .post-content {
                padding: 24px;
                @include mobile-lg {
                    font-size: 10px !important;
                    line-height: 14px !important;
                    padding: 12px;
                }
                .description {
                    margin: 0;

                }
            }
        }
    }
</style>