<script lang="ts" setup>
    const props = defineProps<{
        status: any
    }>()
</script>

<template>
    <div class="matchup-status-container">
        <img v-if="props.status == 2" src="~assets/images/friend.svg" height="20" class="object-fit-contain" alt="">
        <img v-else-if="props.status == 3" src="~assets/images/date.svg" height="20" class="object-fit-contain" alt="">
        <img v-else-if="props.status == 4" src="~assets/images/business.svg" height="20" class="object-fit-contain" alt="">
        <img v-else src="~assets/images/none.svg" alt="">
    </div>
</template>