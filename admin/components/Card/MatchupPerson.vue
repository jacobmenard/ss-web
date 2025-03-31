<script lang="ts" setup>
    const props = defineProps<{
        profile_image: string,
        name: string,
        notes: string
    }>()
    
</script>

<template>
    <div class="max-width-300 w-100 position-relative">
        <div class="d-flex align-items-start border-radius-5 border gap-10 p-3 shadow w-100 mb-2">
            <img v-if="props.profile_image" :src="`${props.profile_image}`" width="80" height="80" class="object-fit-contain border-radius-20 border" alt="">
            <img v-if="!props.profile_image" src="~assets/images/profile-group.svg" height="80" width="80" class="object-fit-contain border-radius-20 border" alt="">
            <span class="font-weight-bold">{{ props.name }}</span>
        </div>

        <!-- <span class="px-2 position-absolute" style="bottom: -1.5rem;">
            Feedback notes: <span class="font-weight-bold">{{ props.notes }}</span>
        </span> -->
    </div>
</template>

<style lang="scss">

</style>