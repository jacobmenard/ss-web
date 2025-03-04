<script lang="ts" setup>
    const events = ref([
        { eventId: '1214919088699', title: 'Mix & Mini Date for Ages 60+ in Woodbridge, CT at NEBCO' },
        { eventId: '1214919088699', title: 'Mix & Mini Date for Ages 60+ in Woodbridge, CT at NEBCO' }
    ])
    const fields = ref([
        { key: 'title', label: 'Event Title' },
        { key: 'actions', label: 'Actions' }
    ])


    const emit = defineEmits(['go-event'])

    function goToEvent(data: any) {
        emit('go-event', data)
    }
</script>

<template>
    <b-modal size="lg" no-footer title="Events list" centered id="select-event-modal" class="ss-default-modal">
        <div class="mb-3">
            <span class="fw-bold">Select event</span>
        </div>
        <b-table striped hover :fields="fields" :items="events">
            <template #cell(actions)="row">
                <b-button variant="ss-primary-button" @click="goToEvent">Go event</b-button>
            </template>
        </b-table>
    </b-modal>
</template>

<style lang="scss" scoped>
    
</style>
