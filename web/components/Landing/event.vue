<template>
    <div class="ss-landing-events-container d-flex flex-column gap-130 w-100">
        <div class="event-head-container d-flex gap-25 flex-column">
            <h1 class="header text-center display-header-155 font-weight-700 m-0">
                EVENT TYPES
            </h1>

            <p class="header-description m-0">
                Sips & Sparks hosts singles events including mixers, speed dating, and activity based events throughout CT and growing!
            </p>
        </div>

        <div class="event-items-container d-flex flex-column gap-55">
            <div class="event-items-wrapper d-flex gap-20">
                <div class="event-items-image">
                    <img src="~assets/images/mini-dates.svg" alt="">
                </div>
                <div class="event-items-description d-flex gap-25 flex-column">
                    <div class="event-head-title"><span>MINI DATES</span></div>
                    <div>
                        <p>
                            Spend the evening engaging in quick, lively conversations with a series of potential matches. It’s friendly and designed to help you make authentic connections in a relaxed setting. Whether you’re looking for sparks to fly or just want to meet interesting people, speed dating is an unforgettable experience you won’t want to miss!
                        </p>
                    </div>
                </div>
            </div>
            <div class="event-items-wrapper d-flex gap-20">
                <div class="event-items-image">
                    <img src="~assets/images/mix-parties.svg" alt="">
                </div>  
                <div class="event-items-description d-flex gap-25 flex-column">
                    <div class="event-head-title"><span>MIXER PARTIES</span></div>
                    <div>
                        <p>
                            Our mixers combine great conversations, exciting activities, 
                            and a relaxed atmosphere to help you connect with others effortlessly. Whether you’re enjoying your favorite drink, diving into a friendly pickleball match, or mingling with an amazing crowd, these events are designed to create 
                            unforgettable moments.
                        </p>
                    </div>
                </div>
            </div>
            <div class="event-items-wrapper d-flex gap-20">
                <div class="event-items-image">
                    <img src="~assets/images/activities.svg" alt="">
                </div>  
                <div class="event-items-description d-flex gap-25 flex-column">
                    <div class="event-head-title"><span>ACTIVITIES</span></div>
                    <div>
                        <p>
                            Enjoy fun activities designed to bring people together. It’s the perfect way to meet new people, break the ice, and create lasting memories in a relaxed, lively atmosphere. Get involved in exciting activities including salsa dancing!
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="event-items-wrapper d-flex gap-20">
                <div class="event-items-image">
                    <img src="~assets/images/retreats.svg" alt="">
                </div>  
                <div class="event-items-description d-flex gap-25 flex-column">
                    <div class="event-head-title"><span>RETREATS</span></div>
                    <div>
                        <p>
                            Plans in development for unforgettable experiences including resorts, cruises and glamping!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.ss-landing-events-container {
    max-width: 1020px;
    margin: auto;
    @include mobile-lg {
        gap: 40px !important;
    }
    .event-head-container {
        .header {   
            letter-spacing: -0.05em;
            color: $red1;
            @include mobile-lg {
                font-size: 48px !important;
                line-height: 48px !important;
            }
        }

        .header-description {
            @include font-custom(22px, 30.8px, 400, $red1);
            @include mobile-lg {
                font-size: 16px !important;
                line-height: 22.4px !important;
            }
        }
    }
    
    .event-items-container {
        .event-items-wrapper {
            @include mobile-lg {
                flex-direction: column !important;
            }
            
            &:nth-child(even) {
                flex-direction: row-reverse;

                .event-items-description {
                    .event-head-title {
                        text-align: right;

                        @include mobile-lg {
                            text-align: center;
                        }
                    }
                }
            }


            .event-items-image {
                min-width: 370px;
                height: 370px;
                width: 370px;
                border-radius: 10px;
                overflow: hidden;

                @include mobile-lg {
                    min-width: unset;
                    width: 100%;
                    height: 200px;
                    display: flex;
                    align-items: center;
                }
                
                img {
                    width: 100%;
                }
            }

            .event-items-description {
                @include mobile-lg {
                    text-align: center;
                    gap: 5px !important;
                }
                span {
                    @include bugaki-font(48px, 67.2px, 400, $red1);
                    @include mobile-lg {
                        font-size: 24px !important;
                        line-height: 33.6px !important;
                    }
                }
                p {
                    @include font-custom(20px, 28px, 400, $red1);
                    @include mobile-lg {
                        text-align: left;
                        font-size: 16px !important;
                        line-height: 22.4px !important;
                    }
                }
            }
        }
    }
}
</style>