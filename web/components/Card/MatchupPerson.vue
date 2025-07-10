<script lang="ts" setup>

    import none from '@/assets/images/none.svg'
    import friend from '@/assets/images/friend.svg'
    import date from '@/assets/images/date.svg'
    import business from '@/assets/images/business.svg'

    const props = defineProps<{
        profile_image: string,
        name: string,
        notes: string,
        selections: any
    }>()

    const emit = defineEmits(['open'])
    
</script>

<template>
    <div class="max-width-300 w-100 position-relative" @click="emit('open')">
        <div class="match-person d-flex align-items-start border-radius-5 border gap-10 p-3 shadow w-100 mb-2">
            <img v-if="props.profile_image" :src="`${props.profile_image}`" width="80" height="80" class="object-fit-contain border-radius-20 border" alt="">
            <img v-if="!props.profile_image" src="~assets/images/profile-group.svg" height="80" width="80" class="object-fit-contain border-radius-20 border" alt="">
            <div class="d-flex w-100 gap-16 justify-content-between align-items-center">
                <span class="font-weight-bold">{{ props.name }}</span>
                <div class="d-flex gap-10">
                    <div v-for="item in props.selections" :key="item">
                        <img v-if="item == '1'" :src="none" height="20" alt="none">
                        <img v-if="item == '2'" :src="friend" height="20" alt="friend">
                        <img v-if="item == '3'" :src="date" height="20" alt="date">
                        <img v-if="item == '4'" :src="business" height="20" alt="business">
                    </div>
                </div>
            </div>
        </div>

        <!-- <span class="px-2 position-absolute" style="bottom: -1.5rem;">
            Feedback notes: <span class="font-weight-bold">{{ props.notes }}</span>
        </span> -->
    </div>
</template>

<style lang="scss">

</style>