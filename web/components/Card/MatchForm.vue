<script setup lang="ts">

    definePageMeta({
        middleware: ['sanctum:auth'],
    });
    
    const router = useRouter()
    const auth = useSanctumUser();

    function openSelectedUser() {
        console.log(auth.value)
        router.push({ path: "/match-form/selection/1" })
    }
</script>
<template>
    <div class="card-matchform border-bottom-black1-1 d-flex gap-25 p-y-25" @click="openSelectedUser">
        <div class="mf-img-container flex-shrink-0 overflow-hidden border-radius-10">
            <slot name="img">
                <img src="~assets/images/matchform/user1.svg" alt="">
            </slot>
        </div>
        
        <div class="mf-info-container d-flex align-items-center w-100">
            <slot name="name">
                <span>CHRISTINE</span>
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