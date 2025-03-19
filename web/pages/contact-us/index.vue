<template>
    <div class="ss-match-form-container d-flex flex-column align-items-center gap-50">
        <header-title-one class="max-width-1020">
            <template #header>
                CONTACT US
            </template>

            <template #sub-header>
                <div>
                    <span class="title">Let's Connect</span>
                </div>
                <p>Have a question about our events? Interested in collaborating? Want to bring Sips & Sparks to your city or company? We'd love to hear from you.</p>
                <p>Our team personally responds to every message because great connections start with great communication.</p>
            </template>
        </header-title-one>

        <b-form class="match-form-container d-flex flex-column gap-50 w-100 max-width-1020">
            <div class="row-container d-flex gap-20 w-100">
                <div class="input-wrapper w-100">
                    <span>NAME*</span>
                    <b-input class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>
                <div class="input-wrapper w-100">
                    <span>EMAIL ADDRESS*</span>
                    <b-input class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>
            </div>

            <div class="row-container d-flex gap-20 w-100 margin-bottom-30">
                <div class="input-wrapper w-100">
                    <span>WHAT CAN WE HELP YOU WITH?</span>
                    <b-form-textarea class="help-text ss-input-form-default border-radius-5 border-black-1 padding-all-20" rows="8" max-rows="20"></b-form-textarea>
                </div>
            </div>

            <div class="row-container d-flex gap-20 w-100 margin-bottom-30">
                <div class="input-wrapper w-100">
                    <span class="text-uppercase">Venue Owners: Complete This Form to Partner With Us</span>
                </div>
            </div>

            <div class="row-container d-flex gap-20 w-100">
                <div class="input-wrapper w-100">
                    <span>BUSINESS NAME</span>
                    <b-input class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>
                <div class="input-wrapper w-100">
                    <span>INSTAGRAM HANDLE</span>
                    <b-input class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>
            </div>

            <div class="row-container d-flex gap-20 w-100">
                <div class="input-wrapper w-100">
                    <span class="text-uppercase">Venue Location (City & State)</span>
                    <b-input class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>
            </div>

            <div class="row-container d-flex gap-20 w-100">
                <div class="input-wrapper w-100">
                    <span>WEBSITE</span>
                    <b-input class="ss-input-form-default border-radius-5 border-black-1 w-100"></b-input>
                </div>
            </div>

            <b-button variant="ss-default-button margin-top-30 max-width-350 m-auto w-100">SUBMIT</b-button>

        </b-form>

        
    </div>
</template>

<style lang="scss">
.ss-match-form-container {
    @include mobile-lg {
        gap: 30px !important;
    }
    .match-form-container {
        @include mobile-lg {
            gap: 30px !important;        }
        .row-container {
            @include mobile-lg {
                flex-direction: column;
            }
        }
        .ss-input-form-default {
            height: 65px;

            @include mobile-lg {
                    font-size: 20px !important;
                    line-height: 28px !important;
                }
        }

        .input-wrapper {
            
            span {
                @include font-custom(24px, 33.6px, 700, $red1);

                @include mobile-lg {
                    font-size: 20px !important;
                    line-height: 28px !important;
                }
            }
        }

        .btn-ss-default-button {
            height: 104px !important;
            @include mobile-lg {
                height: 60px !important;
                width: 165px !important;
                line-height: 14px;
                font-size: 14px !important;
                line-height: 12px !important;
            }
        }
    }
}
</style>