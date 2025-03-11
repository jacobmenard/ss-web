<template>
    <div class="ss-stories-card-container d-flex gap-20">
        <div class="header mobile">
            <slot name="header">
                <span>romantic connection</span>
            </slot>
        </div>
        <div class="story-image-wrapper rounded shadow position-relative">
            
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

        @include resolution(991px) {
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
                padding-top: 5px;
                padding-bottom: 5px;
                max-width: 250px;
                height: auto;
                font-size: 20px !important;
                line-height: normal !important;
                right: 1rem;
                bottom: -2rem !important;
            }

            @include resolution(991px) {
                bottom: 0px;
                right: 0px;
            }

            .long-name {
                @include mobile-lg {
                    font-size: 13px !important;
                }
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

            @include resolution(991px) {
                bottom: 0px;
                right: unset;
                left: 0;
            }
        }

        .story-image-wrapper {
            max-height: 500px;
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

            .ss-img-container {
                @include resolution(991px) {
                    margin: auto;
                    
                }


            }
        }
        
    }
</style>