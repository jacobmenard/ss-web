<script setup lang="ts">

    definePageMeta({
        middleware: ['sanctum:auth'],
    });
    
    const router = useRouter()
    const auth = useSanctumUser();

    interface Props {
        item: any,
        event_id: any,
        isListview: boolean
    }

    const props = defineProps<Props>()

    function openSelectedUser() {
        router.push({ path: `/match-form/selection/${props.item.user.id}`, query: { eid: props.event_id } })
    }
</script>
<template>
    <div class="card-matchform border-bottom-black1-1 d-flex gap-25 justify-content-between flex-wrap align-items-center p-y-25 cursor-pointer" @click="openSelectedUser">
        <div class="d-flex gap-25">
            <div class="mf-img-container flex-shrink-0 overflow-hidden border-radius-10 d-flex align-items-center justify-content-center border">
                <img v-if="props.item.user.profile_image" :src="props.item.user.profile_image"  alt="">
                <img v-else class="no-img" src="~assets/images/profile-group.svg" alt="">
            </div>
            
            <div class="mf-info-container d-flex align-items-center w-100">
                <slot name="name">
                    <span>{{ props.item.user.first_name }}</span>
                </slot>
            </div>
        </div>

        <div v-if="props.isListview && props.item.matchup_status" class="d-flex gap-10">
            <img v-if="props.item.matchup_status.matchup_status == '3'" src="~assets/images/date.svg" alt="date" height="20" class="object-fit-contain">
            <img v-if="props.item.matchup_status.matchup_status != '3'" src="~assets/images/date-gray.png" alt="date-gray" height="20" class="object-fit-contain">
            <img v-if="props.item.matchup_status.matchup_status == '2'" src="~assets/images/friend.svg" alt="friend" height="20" class="object-fit-contain">
            <img v-if="props.item.matchup_status.matchup_status != '2'" src="~assets/images/friend-gray.png" alt="friend-gray" height="20" class="object-fit-contain">
            <img v-if="props.item.matchup_status.matchup_status == '1'" src="~assets/images/none.svg" alt="none" height="20" class="object-fit-contain">
            <img v-if="props.item.matchup_status.matchup_status != '1'" src="~assets/images/none-gray.png" alt="none-gray" height="20" class="object-fit-contain">
        </div>
        <div v-if="props.isListview && !props.item.matchup_status" class="d-flex gap-10">
            <img src="~assets/images/date-gray.png" alt="date-gray" height="20" class="object-fit-contain">
            <img src="~assets/images/friend-gray.png" alt="friend-gray" height="20" class="object-fit-contain">
            <img src="~assets/images/none-gray.png" alt="none-gray" height="20" class="object-fit-contain">
        </div>

    </div>
</template>

<style lang="scss">
.card-matchform {

    @include mobile-lg {
    }
    .mf-img-container {
        width: 90px;
        height: 90px;
        img {
            width: 100%;
            object-fit: contain;
            
            &.no-img {
                width: 80%;
            }
        }
    }

    .mf-info-container {
        span {
            @include font-custom(24px, normal, 700, $red1) {
                text-transform: uppercase;
            }
        }
    }
}
</style>