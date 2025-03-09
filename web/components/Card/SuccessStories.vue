<template>
    <div class="ss-stories-card-container d-flex gap-20">
        <div class="header mobile">
            <slot name="header">
                <span>romantic connection</span>
            </slot>
        </div>
        <div class="story-image-wrapper position-relative">
            
            <div class="story-image-container overflow-hidden border-radius-10">
                <slot name="image">
                    <img src="~assets/images/romantic-connection.svg" class="w-100 object-fit-contain" alt="">
                </slot>
            </div>

            <div class="name text-uppercase position-absolute border-radius-5 p-x-10 text-center">
                <slot name="tag">
                    <span>Name</span>
                </slot>
            </div>

        </div>
        
        <div class="content mobile">
            <slot name="content">
                <p>Lorem ipsum dolor sit amet consectetur. Est viverra enim nunc amet. Et sed condimentum a nascetur aliquet tincidunt ultrices. Mauris diam lorem imperdiet eget vitae facilisi velit viverra morbi. Fames suspendisse risus duis tincidunt etiam pellentesque ut dolor.</p>
            </slot>
        </div>

        <div class="story-container">
            <div class="story d-flex flex-column gap">
                <div class="header">
                    <slot name="header">
                        <span>romantic connection</span>
                    </slot>
                </div>

                <div class="content">
                    <slot name="content">
                        <p>Lorem ipsum dolor sit amet consectetur. Est viverra enim nunc amet. Et sed condimentum a nascetur aliquet tincidunt ultrices. Mauris diam lorem imperdiet eget vitae facilisi velit viverra morbi. Fames suspendisse risus duis tincidunt etiam pellentesque ut dolor.</p>
                    </slot>
                </div>
            </div>
            
            
        </div>
    </div>
</template>

<style lang="scss">
    .ss-stories-card-container {

        @include mobile-lg {
            flex-direction: column !important;
        }
        .header {
            @include bugaki-font(48px, 73.2px, 400, $red1);
            @include mobile-lg {
                display: none;
            }
        }

        .content {
            @include font-custom(20px, 28px, 400, $red1);
            @include mobile-lg {
                display: none;
            }
        }
        .mobile {
            display: none;
            @include mobile-lg {
                display: block;
                gap: 20px !important;
                &.header {
                    font-size: 30px !important;
                    line-height: 45.75px !important;
                    span {
                        
                    }
                }

                &.content {
                    font-size: 16px !important;
                    line-height: 22.4px !important;
                    margin-top: 2rem;
                    p {
                        margin-bottom: 0px !important;
                    }
                }
            }
        }

        .name {
            @include bugaki-font(32px, 56px, 400, $white1) {
                max-width: 400px;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: $red;
                bottom: -50px;
                right: 1rem;
            }

            @include mobile-lg {
                width: unset;
                min-width: 185px;
                max-width: 250px;
                height: 68px;
                font-size: 20px !important;
                line-height: 28px !important;
                right: 1rem;
                bottom: -2rem;
            }
        }

        &.reverse {
            .name {
                right: unset !important;
                left: 1rem;
                @include mobile-lg {
                    right: 1rem !important;
                    left: unset;
                }
            }
        }

        .story-image-wrapper {
            .story-image-container {
                min-width: 500px;
                @include mobile-lg {
                    min-width: unset;
                    width: 100%;
                    height: 200px;
                    display: flex;
                    align-items: center;
                }
            
            }
        }
        
    }
</style>