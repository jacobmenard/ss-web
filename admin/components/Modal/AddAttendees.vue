<script lang="ts" setup>

    import { onMounted, ref, watch } from "vue"
    const props = defineProps<{isOpen: boolean, eid: any, info: any}>()
    const event = useEvents()
    const es = useEventStore()

    const form = ref({
        first_name: '',
        last_name: '',
        gender: '',
        cell_phone: '',
        email: '',
        password: '',
        age: '',
        eid: ''
    })

    const emit = defineEmits(['close'])

    watch(() => props.isOpen, async(val: any) => {
        if (val) {
            
        }
    })

    async function addAttendee() {
        if (props.eid) {
            form.value.eid = props.eid
        }
        const resData = await event.getEventAddAttendee(form)
        if (resData.status == 'error') {
            useNuxtApp().$toast(resData.message, {type: 'error'});
        } 
        useNuxtApp().$toast('Attendee successfully added for this event', {type: 'success'});
        emit('close')
    }
</script>

<template>
    <b-modal size="md" no-footer title="Add Attendee" centered id="select-event-modal" class="ss-default-modal">
        <form @submit.stop.prevent="addAttendee">
            <div class="d-flex flex-column gap-16">
                <b-input v-model="form.first_name" class="ss-input-default w-100" placeholder="Firstname" required></b-input>
                <b-input v-model="form.last_name" class="ss-input-default w-100" placeholder="Lastname" required></b-input>
                <div class="d-flex gap-16">
                    <b-form-select v-model="form.gender" class="ss-input-default w-100" required>
                        <b-form-select-option value="" disabled>-- Select gender --</b-form-select-option>
                        <b-form-select-option value="male">Male</b-form-select-option>
                        <b-form-select-option value="female">Female</b-form-select-option>
                    </b-form-select>
                    <b-input v-model="form.age" type="number" class="ss-input-default w-100" placeholder="Age" required></b-input>

                </div>
                <b-input v-model="form.cell_phone" class="ss-input-default w-100" placeholder="Contact number" required></b-input>

                <b-input v-model="form.email" type="email" class="ss-input-default border-radius-5 w-100" placeholder="Email address" required></b-input>
                <b-input v-model="form.password" type="password" class="ss-input-default border-radius-5 w-100" placeholder="Password" required></b-input>
                
                <b-button type="submit" variant="ss-primary-button" class="height-50">ADD NEW ATTENDEE</b-button>
            </div>
        </form>
    </b-modal>  
</template>

<style lang="scss" scoped>
    
</style>
