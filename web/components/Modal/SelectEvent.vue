

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

    const config = useRuntimeConfig()
    const event = useEvent()
    const es = useEventStore()
    const emit = defineEmits(['go-event'])
    const utils = useUtils()
    const auth = useSanctumUser()

    const props = defineProps<{isOpen: boolean}>()

    watch(() => props.isOpen, async(val: any) => {
        if (val) {
            await event.getAllParticipantEvent()
        }
    })

    function goToEvent(data: any) {
        emit('go-event', data)
    }

    function goToResult(item: any) {
        window.open(`${config.public.clientUrl}/public/match-result/${auth.value.data.id}?eid=${item.id}&type=final_result`, '_blank')
    }

</script>

<template>
    <b-modal size="xl" no-footer title="Select an event" centered id="select-event-modal" class="ss-default-modal">
        <div v-if="es.listEvents && es.listEvents.length">
            
            <b-table-simple striped hover responsive>
                <b-thead>
                    <b-tr>
                        <b-th>Current / Future event</b-th>
                        <b-th>Action</b-th>
                    </b-tr>
                </b-thead>

                <b-tbody v-for="(item, i) in es.listEvents" :key="`event-${i}`">
                    <b-tr>
                        <b-td>{{ `${item.name.text}` }}
                            <small class="d-block">Event starts @ {{ utils.momentTimezone(item.start.local) }}</small>
                        </b-td>
                        <b-td>
                            <b-button variant="ss-primary-button" class="width-100" @click="goToEvent(item)">Select</b-button>
                        </b-td>
                    </b-tr>
                </b-tbody>
            </b-table-simple>
        </div>

        <div v-if="es.listEventsPast && es.listEventsPast.length">
            <b-table-simple striped hover responsive>
                <b-thead>
                    <b-tr>
                        <b-th>Last five previous events</b-th>
                        <b-th>Action</b-th>
                    </b-tr>
                </b-thead>

                <b-tbody v-for="(item, i) in es.listEventsPast" :key="`event-${i}`">
                    <b-tr>
                        <b-td>{{ `${item.name.text}` }}
                            <small class="d-block">Ended {{ utils.momentTimezone(item.start.local) }}</small>
                        </b-td>
                        <b-td>
                            <b-button variant="ss-primary-button" class="width-100" @click="goToResult(item)">Result</b-button>
                        </b-td>
                    </b-tr>
                </b-tbody>
            </b-table-simple>
        </div>
    </b-modal>
</template>

<style lang="scss" scoped>
    
</style>
