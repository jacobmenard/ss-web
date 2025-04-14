
<script lang="ts" setup>
    import { nextTick, onMounted, ref } from "vue"

    const auth = useSanctumUser()
    const form = ref({
        id: '',
        email: '',
        first_name: '',
        last_name: '',
        age: '',
        cell_phone: '',
        gender: '',
        height: '',
        interest: '',
        funFact: '',
        generalBio: '',
    })

    onMounted(async () => {
        await nextTick()
        if (auth.value.data) {
            const info = auth.value.data
            form.value.id = info.id
            form.value.email = info.email
            form.value.first_name = info.first_name
            form.value.last_name = info.last_name
            form.value.age = info.age
            form.value.gender = info.gender
            form.value.cell_phone = info.cell_phone
            form.value.height = info.height ? info.height : ''
            form.value.interest = info.interest ? info.interest : ''
            form.value.funFact = info.funFact ? info.funFact : ''
            form.value.generalBio = info.generalBio ? info.generalBio : ''
        }

    })
</script>

<template>
    <b-container class="user-information-container p-1 max-width-1200 m-auto">
        <b-form>
            <div class="p-3 border-radius-10 shadow mb-3">
                <b-row>
                    <b-col class="mb-3"><span class="d-block fw-bold w-100" style="font-size: 18px;">USER ACCOUNT DETAILS</span></b-col>
                </b-row>
                <b-row>     
                    <b-col class="mb-3" md="4">
                        <span class="d-block mb-2">Email Address:</span>
                        <b-input v-model="form.email" class="ss-input-default border-radius-5 border w-100" auto-complete="off" readonly></b-input>
                    </b-col>
                    <b-col class="mb-3" md="4">
                        <span class="d-block mb-2">Firsname:</span>
                        <b-input v-model="form.first_name" class="ss-input-default border-radius-5 border w-100" auto-complete="off" readonly></b-input>
                    </b-col>
                    <b-col class="mb-3" md="4">
                        <span class="d-block mb-2">Lastname:</span>
                        <b-input v-model="form.last_name" class="ss-input-default border-radius-5 border w-100" auto-complete="off" readonly></b-input>
                    </b-col>
                </b-row>
                <b-row class="mb-3">
                    <b-col class="mb-3" md="3">
                        <span class="d-block mb-2">Gender:</span>
                        <b-input v-model="form.gender" class="ss-input-default border-radius-5 border w-100" auto-complete="off" readonly></b-input>
                    </b-col>
                    <b-col class="mb-3" md="3">
                        <span class="d-block mb-2">Age:</span>
                        <b-input v-model="form.age" class="ss-input-default border-radius-5 border w-100" auto-complete="off"></b-input>
                    </b-col>
                    <b-col class="mb-3" md="3">
                        <span class="d-block mb-2">Cellphone:</span>
                        <b-input v-model="form.cell_phone" class="ss-input-default border-radius-5 border w-100" auto-complete="off"></b-input>
                    </b-col>
                    <b-col class="mb-3" md="3">
                        <span class="d-block mb-2">height:</span>
                        <b-input v-model="form.email" class="ss-input-default border-radius-5 border w-100" auto-complete="off"></b-input>
                    </b-col>
                </b-row>
            </div>
            
            <div class="p-3 border-radius-10 shadow mb-3">
                <b-row>
                    <b-col class="mb-3"><span class="d-block fw-bold w-100" style="font-size: 18px;">USER OTHER DETAILS</span></b-col>
                </b-row>
                <b-row>
                    <b-col class="mb-3">
                        <span class="d-block mb-2">Generail bio:</span>
                        <b-form-textarea v-model="form.generalBio" class="ss-textarea-form-default border" rows="5" max-rows="5"></b-form-textarea>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col class="mb-3">
                        <span class="d-block mb-2">Interests:</span>
                        <b-form-textarea v-model="form.interest" class="ss-textarea-form-default border" rows="5" max-rows="5"></b-form-textarea>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col class="mb-3">
                        <span class="d-block mb-2">Fun facts:</span>
                        <b-form-textarea v-model="form.funFact" class="ss-textarea-form-default border" rows="5" max-rows="5"></b-form-textarea>
                    </b-col>
                </b-row>
            </div>

            <div class="d-flex justify-content-center pt-4">
                <b-button variant="ss-primary-button" class="py-3 px-5">SAVE USER INFORMATION</b-button>
            </div>
        </b-form>
    </b-container>
</template>

<style lang="scss" scoped>
    .user-information-container {
        .ss-textarea-form-default {
            border: 1px solid #dee2e6 !important;
            font-size: 16px !important;
        }

        .btn-ss-primary-button {
            height: auto;
            @include mobile-lg {
                width: 100% !important;
            }
        }
    }
</style>
