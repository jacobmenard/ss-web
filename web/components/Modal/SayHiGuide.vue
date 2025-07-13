<script lang="ts" setup>
    import { onMounted, ref, watch } from "vue"

    const events = useEvent()

    interface Props {
        info: any,
        isOpen: any, 
    }

    const props = withDefaults(defineProps<Props>(), {
        info: null,
        isOpen: false,
    })

    const isLoading = ref(false)

    async function sendHi() {
        isLoading.value = true
        await events.sendHi({
            owner_id: props.info.matchup_owner.id,
            user_id: props.info.matchup_user.id
        })
        isLoading.value = false
        emit('close')
    }
    
    const emit = defineEmits(['close'])
</script>

<template>
    <b-modal size="md" no-footer title="" centered id="say-hi-guide-modal" class="ss-default-modal">
        <div v-if="info" class="say-hi-container p-3">
            
            <p class="fw-bold mb-0">Before You Click "Send Hi!👋", Please Read:</p>
            <p>When you click "Say Hi!" on a match's profile, you're giving us permission to <strong>share YOUR contact information with that person</strong>.</p>

            <div class="mb-4" v-if="info.matchup_user">
                <p class="fw-bold mb-0">What we'll share:</p>
                <ul>
                    <li><strong>Name: </strong>{{ `${info.matchup_user.first_name}` }}</li>
                    <li><strong>Email: </strong>{{ `${info.matchup_user.email}` }}</li>
                    <li><strong>Phone number: </strong>{{ `${info.matchup_user.cell_phone}` }}</li>
                </ul>
            </div>

            <p><span class="fw-bold">Important:</span> Only click "Hi!" if you're genuinely interested in connecting and comfortable sharing your contact details with that person.</p>

            <div class="mt-5 d-flex w-100 justify-content-center">
                <b-button variant="ss-primary-button" class="send-hi-button w-100" @click="sendHi()" :disabled="isLoading"><b-spinner variant="light" small v-if="isLoading"></b-spinner> Send Hi!👋</b-button>
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
