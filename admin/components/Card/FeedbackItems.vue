<script lang="ts" setup>

    import { defineProps, ref } from 'vue'

    const prop = defineProps({
        labelTitle: { default: 'testing question' },
        noRadio: { default: false },
        dropdownId: { default: 'dropdown' }
    })

    const selected = ref(0)

</script>
<template>
    <div class="mf-feedback-items d-flex flex-column gap-25">
        <p>
            {{ prop.labelTitle }}
        </p>

        <b-form-group v-if="!noRadio" :id="dropdownId" class="d-flex justify-content-center flex-wrap gap-25 w-100">
            <b-form-radio  v-for="(item) in 5" v-model="selected" :state="false" :aria-describedby="ariaDescribedby" :name="item" :value="item" class="ss-radio-feedback" :key="`selection-${item}`">
                {{ item }}
            </b-form-radio>
        </b-form-group>

        <b-form-textarea class="ss-textarea-form-default" placeholder="Additional Comments" rows="5" max-rows="10"></b-form-textarea>

    </div>
</template>

<style lang="scss">
    .mf-feedback-items {
        @include font-custom(18px, 25.2px, 600, $black2);

        p {
            margin-bottom: 0px;
        }
    }
</style>