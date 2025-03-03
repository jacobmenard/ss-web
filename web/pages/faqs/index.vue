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
            <b-card no-body class="faq-wrapper border-radius-0 border-none">
                <b-card-header header-tag="header" class="p-0" role="tab">
                    <b-button block v-b-toggle.accordion-1 variant="ss-accordion-button" class="d-block w-100 p-x-27 border-radius-0">
                        <div class="d-flex justify-content-between">
                            <span>
                                Lorem ipsum dolor sit amet consectetur.
                            </span>

                            <img src="~assets/images/down-icon.svg" alt="">
                        </div>
                    </b-button>
                </b-card-header>
                <b-collapse id="accordion-1" class="border-radius-0" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <b-card-text>
                            <p class="margin-bottom-0">
                                Lorem ipsum dolor sit amet consectetur. Ipsum suspendisse neque ac odio faucibus. Nulla dapibus sed lacinia amet dis. Nulla amet pulvinar fermentum condimentum volutpat. Eget dolor quis at varius fringilla.
                            </p>
                        </b-card-text>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="faq-wrapper border-radius-0 border-none">
                <b-card-header header-tag="header" class="p-0" role="tab">
                    <b-button block v-b-toggle.accordion-2 variant="ss-accordion-button" class="d-block w-100 p-x-27 border-radius-0">
                        <div class="d-flex justify-content-between">
                            <span>
                                Lorem ipsum dolor sit amet consectetur.
                            </span>

                            <img src="~assets/images/down-icon.svg" alt="">
                        </div>
                    </b-button>
                </b-card-header>
                <b-collapse id="accordion-2" class="border-radius-0" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <b-card-text>
                            <p class="margin-bottom-0">
                                Lorem ipsum dolor sit amet consectetur. Ipsum suspendisse neque ac odio faucibus. Nulla dapibus sed lacinia amet dis. Nulla amet pulvinar fermentum condimentum volutpat. Eget dolor quis at varius fringilla.
                            </p>
                        </b-card-text>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="faq-wrapper border-radius-0 border-none">
                <b-card-header header-tag="header" class="p-0" role="tab">
                    <b-button block v-b-toggle.accordion-3 variant="ss-accordion-button" class="d-block w-100 p-x-27 border-radius-0">
                        <div class="d-flex justify-content-between">
                            <span>
                                Lorem ipsum dolor sit amet consectetur.
                            </span>

                            <img src="~assets/images/down-icon.svg" alt="">
                        </div>
                    </b-button>
                </b-card-header>
                <b-collapse id="accordion-3" class="border-radius-0" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <b-card-text>
                            <p class="margin-bottom-0">
                                Lorem ipsum dolor sit amet consectetur. Ipsum suspendisse neque ac odio faucibus. Nulla dapibus sed lacinia amet dis. Nulla amet pulvinar fermentum condimentum volutpat. Eget dolor quis at varius fringilla.
                            </p>
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
                    @include mobile-lg {
                        font-size: 20px !important;
                        line-height: 21px !important;
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