<script setup lang="ts">

    definePageMeta({
        middleware: ['sanctum:auth'],
    });
    
    const router = useRouter()
    const auth = useSanctumUser();

    interface Props {
        item: any,
        event_id: any,
    }

    const props = defineProps<Props>()

    function openSelectedUser() {
        router.push({ path: `/match-form/selection/${props.item.user.id}`, query: { eid: props.event_id } })
    }
</script>
<template>
    <div class="card-matchform border-bottom-black1-1 d-flex gap-25 p-y-25 cursor-pointer" @click="openSelectedUser">
        <div class="mf-img-container flex-shrink-0 overflow-hidden border-radius-10">
            <img v-if="props.item.user.profilePic" :src="props.item.user.profilePic" alt="">
            <img v-else src="~assets/images/profile-group.svg" alt="">
        </div>
        
        <div class="mf-info-container d-flex align-items-center w-100">
            <slot name="name">
                <span>{{ props.item.user.first_name }}</span>
            </slot>
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