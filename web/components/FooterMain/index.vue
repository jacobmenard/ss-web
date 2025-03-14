<template>
    <div class="ss-footer-container d-flex justify-content-center position-relative">
        <div class="footer-menu d-flex justify-content-center flex-column gap-13 h-100 position-absolute">
            <div class="menu"><span>ABOUT US</span></div>
            <div class="menu"><span>FAQ'S</span></div>
            <div class="menu"><span>SUCCESS STORIES</span></div>
            <div class="menu"><span>MATCH FORM</span></div>
            <div class="menu"><span>CONTACT US</span></div>
        </div>

        <div class="footer-menu-mobile d-flex justify-content-start gap-25 h-100">
            
            <div>
                <div class="menu margin-bottom-8"><span>ABOUT US</span></div>
                <div class="menu margin-bottom-8"><span>MATCH FORM</span></div>
                <div class="menu margin-bottom-8"><span>CONTACT US</span></div>
            </div>
            <div>
                <div class="menu margin-bottom-8"><span>FAQ'S</span></div>
                <div class="menu margin-bottom-8"><span>SUCCESS STORIES</span></div>
            </div>
        </div>

        <div class="footer-news-container d-flex align-items-center flex-column gap-30">
            <div class="footer-news-header"><span class="text-uppercase">stay up to date with our newsletter!</span></div>

            <div class="d-flex gap-22">
                <b-input class="ss-input-default border-radius-5 border-black-1 fst-italic w-100" placeholder="First Name"></b-input>
                <b-input class="ss-input-default border-radius-5 border-black-1 fst-italic w-100" placeholder="Last Name"></b-input>
            </div>

            <div class="w-100">
                <b-input class="ss-input-default border-radius-5 border-black-1 fst-italic" placeholder="Email"></b-input>
            </div>

            <b-button variant="ss-tertiary-button" class="ss-tertiary-button sign-up">SIGN UP</b-button>

            <div class="disclaimor">
                <span>DISCLAIMER</span>
            </div>
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
                width: 184px;
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
    }
</style>