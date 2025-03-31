<template>
    <div class="ss-footer-container d-flex justify-content-center position-relative">
        <div class="footer-menu d-flex justify-content-center flex-column gap-13 h-100 position-absolute">
            <nuxt-link to="/about-us">
                <div class="menu"><span>ABOUT US</span></div>
            </nuxt-link>
            <nuxt-link to="/faqs">
                <div class="menu"><span>FAQ'S</span></div>
            </nuxt-link>
            <nuxt-link to="/success-stories">
                <div class="menu"><span>SUCCESS STORIES</span></div>
            </nuxt-link>
            <nuxt-link to="/match-form">
                <div class="menu"><span>MATCH FORM</span></div>
            </nuxt-link>
            <nuxt-link to="/contact-us">
                <div class="menu"><span>CONTACT US</span></div>
            </nuxt-link>
        </div>

        <div class="footer-menu-mobile d-flex justify-content-start gap-25 h-100">
            
            <div>
                <nuxt-link to="/about-us">
                    <div class="menu margin-bottom-8"><span>ABOUT US</span></div>
                </nuxt-link>
                
                <nuxt-link to="/match-form">
                    <div class="menu margin-bottom-8"><span>MATCH FORM</span></div>
                </nuxt-link>
                
                <nuxt-link to="/contact-us">
                    <div class="menu margin-bottom-8"><span>CONTACT US</span></div>
                </nuxt-link>
            </div>
            <div>
                <nuxt-link to="/faqs">
                    <div class="menu margin-bottom-8"><span>FAQ'S</span></div>
                </nuxt-link>
                
                <nuxt-link to="/success-stories">
                    <div class="menu margin-bottom-8"><span>SUCCESS STORIES</span></div>
                </nuxt-link>
            </div>
        </div>

        <div class="footer-news-container d-flex align-items-center flex-column gap-30">
            <div class="footer-news-header"><span class="text-uppercase">stay up to date with our newsletter!</span></div>

            <div class="d-flex gap-22">
                <b-input class="ss-input-default border-radius-5 border-black-1 fst-italic w-100" placeholder="First Name" readonly></b-input>
                <b-input class="ss-input-default border-radius-5 border-black-1 fst-italic w-100" placeholder="Last Name" readonly></b-input>
            </div>

            <div class="w-100">
                <b-input class="ss-input-default border-radius-5 border-black-1 fst-italic" placeholder="Email" readonly></b-input>
            </div>

            <b-button variant="ss-tertiary-button" class="ss-tertiary-button sign-up" disabled>COMING SOON</b-button>

            <!-- <b-button variant="ss-tertiary-button" class="ss-tertiary-button sign-up">SIGN UP</b-button>

            <div class="disclaimor">
                <span>DISCLAIMER</span>
            </div> -->
        </div>

    </div>
</template>

<style lang="scss">
    .ss-footer-container {
        min-height: 200px;
        @include resolution(768px) {
            flex-direction: column !important;
            padding: 20px 10px !important;
        }
        .footer-menu, .footer-menu-mobile {
            left: 0;
            .menu {
                max-width: 140px;
                width: 100%;
                span {
                    @include font-custom(18px, 25.2px, 700, $white2) {
                        cursor: pointer;
                        transition: 0.3s;
                    }
                    
                    &:hover {
                        color: $white3 !important;
                    }
                }
            }
        }

        .footer-menu {
            @include resolution(768px) {
                display: none !important;
            }
        }

        .footer-menu-mobile {
            display: none !important;
            @include resolution(768px) {
                display: flex !important;
            }

            .menu {
                width: 140px;
                span {
                    font-size: 14px !important;
                    line-height: 19.6px !important;
                }
            }
        }

        .footer-news-container {
            margin: auto;
            padding-top: 47px;
            padding-bottom: 51px;
            @include mobile-lg {
                text-align: center;
                padding-top: 35px !important;
                gap: 10px !important;
            }

            > div {
                @include mobile-lg {
                    gap: 13px !important;
                }
            }

            @include font-custom(21.5px, 30.1px, 700, $white2);

            .footer-news-header {
                
                span {
                    @include mobile-lg {
                        font-size: 20px !important;
                        line-height: 28px !important;
                    }
                }
            }
            
            .ss-tertiary-button {
                height: 52px;
                max-width: 300px;
            }

            .disclaimor {
                cursor: pointer;
                @include font-custom(18px, 25.2px, 700, $white2);
            }

            .ss-input-default {
                @include mobile-lg {
                    font-size: 14px !important;
                    font-style: normal !important;
                    width: 100% !important;
                    height: 40px !important;
                }
            }

            .sign-up {
                @include mobile-lg {
                    width: 100%;
                    height: 100%;
                    max-width: 113px;
                    font-size: 12px !important;
                    margin-top: 10px;
                }
            }

            .disclaimor {
                @include mobile-lg {
                    font-size: 14px !important;
                    margin-top: 50px !important;
                }

            }

        }

        a {
            text-decoration: none;
            &.router-link-active {
                span {
                    
                    color: $white3 !important;
                }
            }
        }
    }
</style>