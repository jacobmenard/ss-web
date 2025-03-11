<template>
    <div class="ss-landing-events-container d-flex flex-column gap-130 w-100">
        <div class="event-head-container d-flex gap-25 flex-column">
            <h1 class="header text-center font-weight-700 m-0 text-uppercase">
                Experience the Difference
            </h1>

            <p class="header-description m-0 text-center">
                Sips & Sparks hosts singles events including mixers, speed dating, and activity based events<br>throughout CT and growing!
            </p>
        </div>

        <div class="event-items-container d-flex flex-column gap-55">
            <div class="event-items-wrapper d-flex align-items-center gap-32">
                <div class="event-items-image">
                    <img src="~assets/images/mini-dates.svg" alt="">
                </div>
                <div class="event-items-description d-flex gap-25 flex-column">
                    <div class="event-head-title text-uppercase"><span>Mix <span style="font-family: Montserrat, sans-serif !important; font-weight: 700 !important;">&</span> Mini Date</span></div>
                    <div>
                        <p>
                            Dating is time-consuming. A single app date can eat up hours of your evening and often with someone you know within minutes isn't right for you. Our signature Mix & Mini Dates transform how you meet people by letting you connect with multiple interesting singles in one efficient evening.
                        </p>
                        <p>
                            In just a few hours, you'll have meaningful conversations with a diverse group of people you'd otherwise spend weeks trying to meet. It's the perfect solution for busy professionals who value their time but don't want to compromise on finding genuine connection.
                        </p>
                        <p class="fst-italic">
                            "I connected more with people in one evening than I had in six months of online dating. The format makes it easy to be yourself and that's when something special happens." —Michael, 34
                        </p>
                    </div>
                </div>
            </div>
            <div class="event-items-wrapper d-flex align-items-center gap-32">
                <div class="event-items-image">
                    <img src="~assets/images/mix-parties.svg" alt="">
                </div>  
                <div class="event-items-description d-flex gap-25 flex-column">
                    <div class="event-head-title text-uppercase"><span>Singles Mixers</span></div>
                    <div>
                        <p>
                            Remember when meeting new people used to be fun? Our mixers bring that feeling back. Unlike a regular bar or social gathering, everyone at our mixers is single and open to connection… removing the guesswork and awkwardness of approaching strangers. Our laid-back atmosphere gives you the freedom to mingle at your own pace while our hosts ensure the energy stays vibrant throughout the night.
                        </p>
                        <p>
                            The best part? You can approach whoever catches your eye, knowing everyone is there for the same reason you are.
                        </p>
                        <p class="fst-italic">"The mixer made meeting new people feel so effortless. Three months later, I'm dating someone wonderful and have two new friends from the same night!" —Jen, 29</p>
                    </div>
                </div>
            </div>
            <div class="event-items-wrapper d-flex align-items-center gap-32">
                <div class="event-items-image">
                    <img src="~assets/images/activities.svg" alt="">
                </div>  
                <div class="event-items-description d-flex gap-25 flex-column">
                    <div class="event-head-title text-uppercase"><span>Activity Based Events</span></div>
                    <div>
                        <p>
                            Our pickleball tournaments, salsa dancing lessons, pottery classes, and fitness events provide a natural foundation for connection beyond just conversation. These activities reveal aspects of personality that never come through on dating profiles like the playfulness, creativity, movement, and genuine reactions. You'll connect through shared experiences while having fun, regardless of skill level.
                        </p>
                        <p>
                            These events are especially perfect for those who prefer getting to know someone while doing something engaging rather than sitting across a table for an interview-style date.
                        </p>
                        <p class="fst-italic">"I'm usually terrible at talking about myself, but playing pickleball made conversation flow naturally. You learn so much about someone when you're sharing an experience together." —David, 32</p>
                    </div>
                </div>
            </div>
            
            <div class="event-items-wrapper d-flex align-items-center gap-32">
                <div class="event-items-image">
                    <img src="~assets/images/retreats.png" alt="">
                </div>  
                <div class="event-items-description d-flex gap-25 flex-column">
                    <div class="event-head-title text-uppercase"><span>Retreats</span></div>
                    <div>
                        <p>
                            Based on feedback from our community, we're excited to introduce our very first immersive retreat experience! You've told us how much you value the authentic connections that happen at our events, and we've created something special in response.
                        </p>
                        <p>
                            Our inaugural retreat, Beach, Bonds & Breakthroughs, takes place at the luxurious Secrets Royal Beach Resort in Punta Cana (August 29 - September 1, 2025). This women-focused experience combines relationship skill-building with the perfect setting for meaningful connection:
                        </p>
                        <p>This is just the beginning of our retreat offerings. We plan to develop a variety of immersive experiences for different interests and communities based on your response.</p>
                        <p>Early bird pricing ends March 10th so secure your spot today! Learn More →</p>
                        <p class="fst-italic">For our male community members: We value you tremendously and are developing custom experiences specifically designed for your relationship journey. Our local events continue connecting you with women who are actively investing in their personal growth and relationship success.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.ss-landing-events-container {
    margin: auto;
    @include mobile-lg {
        gap: 20px !important;
    }
    .event-head-container {
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

        .header-description {
            @include font-custom(22px, 30.8px, 400, $red1);
            @include mobile-lg {
                font-size: 16px !important;
                line-height: 22.4px !important;
            }
        }
    }
    
    .event-items-container {
        @include mobile-lg {
            gap: 20px !important;
        }
        .event-items-wrapper {
            
            @include resolution(991px) {
                flex-direction: column !important;
            }

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

                        @include resolution(991px) {
                            text-align: center;
                        }
                    }
                }
            }

            .event-head-title {

                @include resolution(991px) {
                    text-align: center;
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