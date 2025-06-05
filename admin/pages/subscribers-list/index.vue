<script lang="ts" setup>
import { nextTick, onMounted, ref } from "vue"
import { useNewsletter } from '@/composables/useNewsletter'

    const newsletter = useNewsletter()
    const ns = useNewsletterStore()

    const search = ref('')

    async function getNewsletter() {
        await newsletter.getNewsletter({
            search: search.value
        })
    }

    onMounted(async () => {
        await nextTick()
        await newsletter.getNewsletter({
            search: search.value
        })
    })
</script>

<template>
    <div class="subscribers-list-container">
        <div class="header-title">
            <span>Subscribers list</span>
        </div>

        
        <card-container>
            <div class="d-flex justify-content-between align-items-center mb-3">

                <div class="d-flex gap-10">
                    <b-input v-model="search" class="ss-input-default" placeholder="Search"></b-input>
                    <b-button variant="ss-primary-button" @click="getNewsletter">Search</b-button>
                </div>

                <b-button variant="ss-primary-button">Export to CSV</b-button>
            </div>
            <b-table-simple hover striped class="border">
                
                <b-thead>
                    <b-tr>
                        <b-th>Name</b-th>
                        <b-th>Email</b-th>
                    </b-tr>
                </b-thead>

                <b-tbody>
                    <b-tr v-for="(item, i) in ns.newsletters" :key="`feedback-${i}`" class="cursor-pointer">
                        <b-td>
                            <span>{{ item.name }}</span>
                        </b-td>
                        <b-td>
                            <span>{{ item.email }}</span>
                        </b-td>
                    </b-tr>
                </b-tbody> 
            </b-table-simple>
        </card-container>
        
    </div>
</template>

<style lang="scss" scoped>
    
</style>
