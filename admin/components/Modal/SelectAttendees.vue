<script lang="ts" setup>
    import { ref } from "vue"
    
    const es = useEventStore()
    const event = useEvents()
    const emit = defineEmits(['select-attendees'])

    const search = ref('')
    const loading = ref(false)

    async function searchAttendees() {
        if (search.value == '') {
            return
        }
        loading.value = true
        await event.searchAttendeesDataList({search: search.value})
        loading.value = false
    }

</script>

<template>
    <b-modal size="lg" no-footer title="Select attendee to add" centered id="select-attendees-container" class="ss-default-modal">
        <div class="d-flex w-100 mb-3 align-items-center gap-10">
            <b-input v-model="search" class="ss-input-default border-radius-5 border-black-1 max-width-250" placeholder="Search attendees"></b-input>
            <b-button variant="ss-primary-button" @click="searchAttendees">Search</b-button>

        
        </div>
        <div class="border">
            <b-table-simple striped hover responsive>
                <b-thead>
                    <b-tr>
                        <b-th>Attendee name</b-th>
                        <b-th></b-th>
                    </b-tr>
                </b-thead>

                <b-tbody>
                    <b-tr v-for="(item, i) in es.getSearchAttendees" :key="`items-${i}`">
                        <b-td>
                            <span style="font-size: 18px !important;">
                                {{ item.name }}
                                <span class="d-block" style="font-size: 14px !important;">{{ item.email }}</span>
                            </span>
                        </b-td>
                        <b-td class="text-center"><b-button variant="ss-primary-button" class="w-100 text-uppercase" @click="emit('select-attendees', item)">ADD</b-button></b-td>
                    </b-tr>
                </b-tbody>
            </b-table-simple>
        </div>
    </b-modal>
</template>

<style lang="scss" scoped>
    
</style>
