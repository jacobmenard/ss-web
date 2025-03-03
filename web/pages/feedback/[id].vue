<script setup lang="ts">
    import { ref } from 'vue'
    const dropdown1 = ref(0)
    const dropdown2 = ref(0)
    const dropdown3 = ref(0)
    const dropdown4 = ref(0)
    const dropdown5 = ref(0)
</script>
<template>
    <div class="mf-feedback d-flex flex-column gap-50">
        <header-title-one class="max-width-1100 match-form">
            <template #header>
                    SIPS <span class="symbol">&</span> SPARKS
                    <span class="d-block black1">HELP US</span>
                    <span class="d-block black1">HELP YOU<span class="symbol">!</span></span>
            </template>
            <template #sub-header>
                <p class="feedback-introduction">
                    We’d love your feedback! Please let us know how we can improve by rating us on this 5 - 1 scale.

                </p>
            </template>
        </header-title-one>

        <card-feedback-items v-model="dropdown1" labelTitle="‘The host helped me feel comfortable during the event.’"></card-feedback-items>
        <card-feedback-items v-model="dropdown2" labelTitle="‘The venue was a good fit for the event.’"></card-feedback-items>
        <card-feedback-items v-model="dropdown3" labelTitle="‘The event flow and rotations were satisfactory.’"></card-feedback-items>
        <card-feedback-items v-model="dropdown4" labelTitle="‘The website and match form were easy to navigate.’"></card-feedback-items>
        <card-feedback-items v-model="dropdown5" labelTitle="Any other questions or comments?" :noRadio="true"></card-feedback-items>

        <div>
            <span class="d-block mb-3 font-weight-bold">Where did you hear about us?</span>
            <b-dropdown size="lg"  variant="link" text="CHOOSE ONE" block toggle-class="text-decoration-none header-menu-list feedback-dropdown" menu-class="w-100">
                <b-dropdown-item v-for="item in 10" :key="item">{{ `SELECTION ITEM ${item}` }}</b-dropdown-item>
            </b-dropdown>
        </div>
        
        <div class="text-center">
            <b-button variant="ss-default-button" class="mf-button" @click="goToListview">SUBMIT MATCHES AND FEEDBACK</b-button>
        </div>
    </div>
</template>

<style lang="scss">
.mf-feedback {
    
    .black1 {
        color: $black2;
    }

    .feedback-introduction {
        font-size: 20px;
        line-height: 28px;
    }

    .header-menu-list {
        background-color: $red1;
        width: 100%;
        color: $white1;
        font-weight: 500;
    }
    

}
</style>