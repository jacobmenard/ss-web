<script lang="ts" setup>
    interface Props {
        info: any,
        event: any
    }
    const props = defineProps<Props>()
</script>

<template>
    <div class="matchup-result-final-container d-flex flex-column gap-30 w-100">
        <div class="">
            <div class="mb-2"><span class="fw-bold">MATCH RESULT:</span></div>
            <div class="w-100 d-flex flex-column gap-10 shadow-sm border border-radius-10 p-4">
                <div class="d-flex gap-10">
                    <span class="fw-bold">Match status: </span> <card-matchup-status :status="info.matchup_status"></card-matchup-status>
                </div>
                
                <div class="d-flex gap-10">
                    <div>
                        <span class="fw-bold">Match notes: </span>
                    </div> 
                    <div>
                        <span>{{ info.matchup_notes }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div v-if="info.matchup_owner" class="">
            <div class="mb-2"><span class="fw-bold">USER INFORMATION:</span></div>
            <div class="w-100 shadow-sm border border-radius-10 p-4">
                <div v-if="info.matchup_owner.profile_image" class="d-flex flex-column gap-20 mb-3">
                    <span class="fw-bold">Profile image:s </span>
                    <img :src="info.matchup_owner.profile_image" width="100%" class="object-fit-contain" alt="">
                </div>
                <div class="d-flex gap-10 mb-3">
                    <span class="fw-bold">Fullname: </span> {{ `${info.matchup_owner.first_name} ${info.matchup_owner.last_name}` }}
                </div>
                <div class="d-flex gap-10 mb-3">
                    <span class="fw-bold">Age: </span> {{ `${info.matchup_owner.age}` }}
                </div>
                
                <div class="d-flex gap-10 mb-3">
                    <span class="fw-bold">Gender: </span> {{ `${info.matchup_owner.gender}` }}
                </div>
                <div class="d-flex gap-10 mb-3">
                    <span class="fw-bold">Email Address: </span> {{ `${info.matchup_owner.email}` }}
                </div>
                <div class="d-flex gap-10 mb-3">
                    <span class="fw-bold">Contact number: </span> {{ `${info.matchup_owner.cell_phone}` }}
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .matchup-result-final-container {
        
    }
</style>
