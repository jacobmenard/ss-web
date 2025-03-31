<script lang="ts" setup>

    import { onMounted, ref, watch } from "vue"
    interface Props {
        isOpen: any, 
        eid: any, 
        info: any,
        isUpdate: any
    }

    const props = withDefaults(defineProps<Props>(), {
        info: null,
        isOpen: false,
        eid: '',
        isUpdate: false
    })


    const event = useEvents()
    const es = useEventStore()

    const form = ref({
        id: '',
        first_name: '',
        last_name: '',
        gender: '',
        cell_phone: '',
        email: '',
        password: '',
        age: '',
        eid: '',
    })

    const profile_image = ref(null)
    const selected_image = ref(null)

    async function previewImage(e: any) {
        profile_image.value = e.target.files[0]
        selected_image.value = URL.createObjectURL(e.target.files[0])
        console.log(profile_image.value)
    }

    const emit = defineEmits(['close'])

    // watch(() => props.isOpen, async(val: any) => {
    //     if (val) {
            
    //     }
    // })


    watch(() => props.info, async(val: any) => {
        if (val) {
            form.value.id = val.id
            form.value.first_name = val.first_name
            form.value.last_name = val.last_name
            form.value.gender = val.gender
            form.value.cell_phone = val.cell_phone
            form.value.email = val.email
            form.value.password = val.password
            form.value.age = val.age
            form.value.eid = val.eid
        } else {
            form.value.id = ''
            form.value.first_name = ''
            form.value.last_name = ''
            form.value.gender = ''
            form.value.cell_phone = ''
            form.value.email = ''
            form.value.password = ''
            form.value.age = ''
            form.value.eid = ''
            profile_image.value = null
            selected_image.value = null
        }
    })

    async function addAttendee() {
        if (props.eid) {
            form.value.eid = props.eid
        }

        let bodyFormData = new FormData()

        bodyFormData.append('isUpdate', props.isUpdate)

        for (const property in form.value) {
            bodyFormData.append(property, form.value[property])
        }

        if (!props.isUpdate) {
            if (profile_image.value) {
                bodyFormData.append('profile_image', profile_image.value, profile_image.value.name)
            }
        }

        const resData = await event.getEventAddAttendee(bodyFormData)
        if (resData.status == 'error') {
            useNuxtApp().$toast(resData.message, {type: 'error'});
        } 
        useNuxtApp().$toast(resData.message, {type: 'success'});
        emit('close')
    }
</script>

<template>
    <b-modal size="md" no-footer title="Add Attendee" centered id="select-event-modal" class="ss-default-modal">
        <div class="d-flex flex-column gap-10 mb-3">
            <!-- <div v-if="!isUpdate" class="d-flex justify-content-between align-items-center gap-20">
                <span>Upload attendee profile image</span>
                <b-button variant="success" class="my-2 mx-2" @click="$refs.profileImage.click()">Upload</b-button>
                <input type="file" ref="profileImage" @change="previewImage" accept=".jpg, .png, .svg" class="d-none">
            </div> -->
            <div v-if="profile_image" class="mt-2">
                <span>
                    Filename:
                    <span>{{ profile_image.name }}</span>
                </span>
            </div>
        </div>
        <!-- <div v-if="profile_image"><span>{{ profile_image.name }}</span></div> -->
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
                <!-- <b-input v-model="form.password" type="password" class="ss-input-default border-radius-5 w-100" placeholder="Password" required></b-input> -->
                
                <b-button type="submit" variant="ss-primary-button" class="height-50">{{ props.isUpdate ? 'UPDATE ATTENDEE' : 'ADD NEW ATTENDEE' }} </b-button>
            </div>
        </form>
    </b-modal>  
</template>

<style lang="scss" scoped>
    
</style>
