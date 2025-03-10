<script lang="ts" setup>
import { ref } from "vue";
    const faqs = ref([
        {
            title: 'How is this different from other dating events or apps?',
            description: `<p>Dating apps promise quantity. We deliver quality connections.</p>
                        <p>At Sips & Sparks, we've reimagined what meeting new people can feel like. Our carefully designed events create environments where connections happen naturally, where you can see someone's smile in real-time, hear their genuine laugh, and feel that indescribable chemistry that no algorithm can predict.</p>
                        <p>We're not just another dating service; we're bringing back the art of authentic connection in a digital world that's forgotten what it feels like.</p>`,
        },

        {
            title: `I'm not necessarily looking for a serious relationship right now. Is this still for me?`,
            description: `<p>Absolutely! Our community includes people seeking everything from serious partnerships to casual dating, new friendships, and expanded social circles. Many of our most enthusiastic attendees came initially "just to meet new people" and were pleasantly surprised by the connections they formed.</p>
                            <p>We create the environment. You decide what kind of connections you want to cultivate. No pressure, no expectations, just possibilities.</p>`
        },
        {
            title: `I get nervous in social situations. Will I feel comfortable?`,
            description: `<p>If you're feeling butterflies about attending, you're in good company. Nearly everyone walks through our doors with some nerves and almost everyone leaves wondering why they were anxious in the first place.</p>
                        <p>We've created welcoming environments that work for all personality types. Whether you're naturally outgoing or more reserved, our events have a warm, inclusive atmosphere where you can engage at your own comfort level. Our hosts are experts at creating spaces where conversation flows naturally and connections form organically.</p>
                        <p>Plus, there's something uniquely comforting about being in a room where everyone is open to connection. You already have something in common with every person there: you're both brave enough to show up.</p>`
        },
        {
            title: `What kind of people will I meet at your events?`,
            description: `<p>Our community is wonderfully diverse, yet united by a desire for genuine connection. You'll meet professionals, creatives, entrepreneurs, academics, and adventurers spanning different ages, backgrounds, and interests.</p>
                            <p>What they share is authenticity and intention. Our members are people who value real conversation over surface-level interactions. They're curious, engaged, and willing to be pleasantly surprised by someone who might not match their usual "type" on an app.</p>
                            <p>More importantly… they're real people looking for real connections, just like you.</p>
                            <p></p>`
        },
        {
            title: `What if I don't meet "the one"?`,
            description: `<p>Even our most successful love stories often began with people who attended several events before meeting someone special. Connection is a numbers game, but it's also about timing, readiness, and that unpredictable spark.</p>
                        <p>What we can promise is that you'll have genuine interactions with interesting people in a setting designed for connection. Many attendees form valuable friendships, professional networks, and activity partners along the way to finding romance.</p>
                        <p>Each event expands your community and brings you one step closer to the connections you're seeking while being a lot more fun than another night of swiping.</p>`
        }
    ])
</script>
<template>
    <div class="ss-faqs-container d-flex flex-column align-items-center gap-100">
        <header-title-one class="max-width-1020">
            <template #header>
                    FAQ<span class="symbol">'</span>S
            </template>

            <template #sub-header>
                We know trying something new can come with a lot of questions, and we’re here to make your experience as smooth and enjoyable as possible. Whether you're wondering how speed dating works, what to expect at an event, or how to prepare, you'll find everything you need to know right here. 
            </template>
        </header-title-one>

        <div class="faqs-accordion-container accordion max-width-1020 w-100" role="tablist">
            <b-card v-for="(item, i) in faqs" :key="`faqs-${i}`" no-body class="faq-wrapper border-radius-0 border-none">
                <b-card-header header-tag="header" class="p-0" role="tab">
                    <b-button block  v-b-toggle="`accordion-${i}`" variant="ss-accordion-button" class="d-block w-100 p-x-27 border-radius-0">
                        <div class="d-flex justify-content-between align-items-center gap-16">
                            <span>
                                {{ item.title }}
                            </span>

                            <img src="~assets/images/down-icon.svg" alt="">
                        </div>
                    </b-button>
                </b-card-header>
                <b-collapse :id="`accordion-${i}`" class="border-radius-0" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <b-card-text>
                            <p v-html="item.description" class="margin-bottom-0"></p>
                        </b-card-text>
                    </b-card-body>
                </b-collapse>
            </b-card>
        </div>
    </div>
</template>
<style lang="scss">
    .ss-faqs-container {
        @include mobile-lg {
            gap: 30px !important;
        }
        .symbol {
            @include font-custom(68px, 71.4px, 700, $red) {
                font-family: 'Montserrat', sans-serif !important;
                
                letter-spacing: -0.05em;
            }
        }   
        .faqs-accordion-container {
            .faq-wrapper {
                .btn-ss-accordion-button {
                    font-family: 'Montserrat', sans-serif !important;
                    gap: 10px;
                    min-height: 90px !important;
                    height: auto !important;
                    @include mobile-lg {
                        font-size: 20px !important;
                        line-height: 21px !important;
                    }
                }
                .card-header {
                    img {
                        @include mobile-lg {
                            height: 15px;
                        }
                    }

                    .btn-ss-accordion-button {
                        @include mobile-lg {
                            font-size: 18px !important;
                            font-weight: 500 !important;
                            padding-right: 1rem !important;
                            padding-left: 1rem !important;
                        }
                    }
                }
                .card-body {
                    border: 0px;
                    box-shadow: 0px 4px 10px 0px #00000040;
                    padding: 45px 20px;

                    @include mobile-lg {
                        padding: 20px;
                    }
                }
                .card-text {
                    p {
                        @include font-custom(20px, 28px, 400, $black3);
                        @include mobile-lg {
                            font-size: 16px !important;

                        }
                    }

                }
            }

        }
    }
</style>