

<script lang="ts" setup>
import { onMounted, ref, watch } from "vue"

    const event = useEvent()
    const es = useEventStore()  
    const props = defineProps<{isOpen: boolean}>()

    // watch(() => props.isOpen, async(val: any) => {
    //     if (val) {
            
    //     }
    // })

</script>

<template>
    <b-modal size="xl" no-footer title="Add Attendees" centered id="add-participants-modal" class="ss-default-modal">
        <div class="mb-3">
            <span class="fw-bold">Select event</span>
            testing onle
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
                        <b-button variant="ss-primary-button" class="width-100">Select</b-button>
                    </b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
    </b-modal>
</template>

<style lang="scss" scoped>
    
</style>
