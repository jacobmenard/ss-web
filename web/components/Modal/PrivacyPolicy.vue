<script lang="ts" setup>
    
    const emit = defineEmits(['accept', 'decline']);

    function acceptPrivacy() {
        emit('accept')
    }

    function declinePrivacy() {
        emit('decline')
    }
</script>

<template>
    <b-modal size="xl" no-footer no-close-on-esc="true" no-close-on-backdrop="true" no-header centered id="privacy-policy-container" class="ss-default-modal">
        <div class="ss-privacy-policy-cotnainer">
            <div class="header text-center pt-5">
                <h2>We value your privacy</h2>
            </div>

            <div class="content text-center p-5">
                <p>We respect your privacy and are committed to protecting your data.</p>
                <p>
                    Our web app collects minimal information such as browser type, IP address, and usage data to ensure functionality, improve performance, and enhance user experience. We do not sell or share your personal information without your explicit consent.
                </p>
                <p>
                    By continuing to use this web app, you agree to our Privacy Policy, which explains how we collect, use, and protect your data.
                
                </p>
                <p>
                    You can change your privacy preferences anytime in your account settings.
                </p>

                <p>
                    Do you accept our Privacy Policy?
                </p>
            </div>
            <div class="button-container d-flex justify-content-center pb-5 gap-32">
                <b-button variant="ss-primary-button" class="accept py-3 px-5 h-auto" @click="acceptPrivacy">I ACCEPT</b-button>
                <b-button variant="ss-primary-button" class="no-accept py-3 px-5 h-auto" @click="declinePrivacy">MORE DETAILS</b-button>
            </div>
        </div>
    </b-modal>
</template>

<style lang="scss" scoped>
    .ss-privacy-policy-cotnainer {
        .header {
            h2 {
                font-weight: 700 !important;
                color: $red;
            }
            @include mobile-lg {
                padding-top: 1rem !important;
            }
        }

        .no-accept {
            background-color: transparent !important;
            border: 1px solid $red;
            color: $red !important;
        }

        .content {
            font-size: 18px !important;

            @include mobile-lg {
                font-size: 16px !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
        }
        
        .button-container {
            @include mobile-lg {
                flex-direction: column !important;
                gap: 5px !important;
                padding-bottom: 10px !important;
            }
        }
    }
</style>
