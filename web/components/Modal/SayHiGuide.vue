<script lang="ts" setup>
    import { onMounted, ref, watch } from "vue"
    interface Props {
        info: any,
        isOpen: any, 
    }

    const props = withDefaults(defineProps<Props>(), {
        info: null,
        isOpen: false,
    })

    
    const emit = defineEmits(['close'])
</script>

<template>
    <b-modal size="md" no-footer title="" centered id="say-hi-guide-modal" class="ss-default-modal">
        <div class="say-hi-container p-3">
            <p class="fw-bold mb-0">Before You Click "Send Hi!👋", Please Read:</p>
            <p>When you click "Hi!" on a match's profile, you're giving us permission to share YOUR contact information with that person.</p>

            <div class="mb-4">
                <p class="fw-bold mb-0">What we'll share:</p>
                <ul>
                    <li>Your name</li>
                    <li>Your email address</li>
                    <li>Your phone number</li>
                </ul>
            </div>

            <p><span class="fw-bold">Important:</span> Only click "Hi!" if you're genuinely interested in connecting and comfortable sharing your contact details with that person.</p>

            <div class="mt-5 d-flex w-100 justify-content-center">
                <b-button variant="ss-primary-button" class="send-hi-button w-100">Send Hi!👋</b-button>
            </div>
        </div>
    </b-modal>
</template>

<style lang="scss" scoped>
    .say-hi-container {
        .send-hi-button {
            height: 50px;
        }
    }
</style>
