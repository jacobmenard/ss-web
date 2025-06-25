<script lang="ts" setup>
    const props = defineProps<{
        status: any
    }>()
</script>

<template>
    <div class="matchup-status-container">
        <img v-if="props.status == 2" src="~assets/images/friend.svg" alt="">
        <img v-if="props.status == 3" src="~assets/images/date.svg" alt="">
        <img v-if="props.status == 4" src="~assets/images/business.svg" alt="">
        <img v-if="!props.status || props.status == 1" src="~assets/images/none.svg" alt="">
    </div>
</template>