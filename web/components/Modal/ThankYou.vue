<script lang="ts" setup>
    const props = defineProps<{isOpen: boolean}>()
    const emit = defineEmits(['close'])
</script>

<template>
    <b-modal size="lg" no-footer title="" :no-close-on-backdrop="true" :no-close-on-esc="true" centered id="select-event-modal" class="ss-default-modal">
        <div class="d-flex justify-content-center gap-16 py-3 px-5">
            <div>
                <h1 class="fw-bold text-center mb-4">
                    Selections Confirmed!
                </h1>

                <p>Thank you so much for attending today's event! We've successfully received your selections and preferences from tonight.</p>
                <p>We truly appreciate the time you took to connect with new people and share your thoughts with us. Your participation helps make these events better for everyone.</p>
                
                <div class="my-4">
                    <span class="mb-2 d-block fw-bold">What's Next:</span>
                    <ul class="mb-3">
                        <li>Match results will be sent to you tomorrow morning, so keep an eye on your inbox!</li>
                        <li>If you want to make any changes to your selections, you can return to this page until 7:00 AM tomorrow</li>
                        <li>Remember, these events are all about exploring possibilities and creating opportunities to meet new people</li>
                    </ul>
                </div>

                <p>If you didn't make a connection tonight, don't be discouraged! We host events regularly with different groups of people, so there are always new opportunities to meet someone special. Every event brings fresh faces and new possibilities.</p>
                <p>We can't wait to see you at a future event!</p>
                <p>Stay tuned for updates since we're always working to make things better!</p>

                <div class="text-center">
                    <b-button @click="emit('close')" variant="ss-primary-button" class="mt-4 px-4">Close</b-button>
                </div>
            </div>
        </div>
    </b-modal>
</template>

<style lang="scss" scoped>
    
</style>
