

<script lang="ts" setup>
import { onMounted, ref, watch } from "vue"
    const events = ref([
        { eventId: '1214919088699', title: 'Mix & Mini Date for Ages 60+ in Woodbridge, CT at NEBCO' },
        { eventId: '1214919088699', title: 'Mix & Mini Date for Ages 60+ in Woodbridge, CT at NEBCO' }
    ])
    const fields = ref([
        { key: 'title', label: 'Event Title' },
        { key: 'actions', label: 'Actions' }
    ])

    const event = useEvent()
    const es = useEventStore()
    const emit = defineEmits(['go-event'])

    const props = defineProps<{isOpen: boolean}>()

    watch(() => props.isOpen, async(val: any) => {
        if (val) {
            await event.getAllParticipantEvent()
        }
    })

    function goToEvent(data: any) {
        emit('go-event', data)
    }

</script>

<template>
    <b-modal size="xl" no-footer title="Events list" centered id="select-event-modal" class="ss-default-modal">
        <div class="mb-3">
            <span class="fw-bold">Select event</span>
        </div>
        <b-table-simple striped hover responsive>
            <b-thead>
                <b-tr>
                    <b-th>Event name</b-th>
                    <b-th>Action</b-th>
                </b-tr>
            </b-thead>

            <b-tbody v-for="(item, i) in es.listEvents" :key="`event-${i}`">
                <b-tr>
                    <b-td>{{ `${item.name.text}` }}</b-td>
                    <b-td>
                        <b-button variant="ss-primary-button" class="width-100" @click="goToEvent(item)">Select</b-button>
                    </b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
    </b-modal>
</template>

<style lang="scss" scoped>
    
</style>
