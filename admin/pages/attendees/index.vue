<script lang="ts" setup>
import { nextTick, onMounted, ref } from 'vue';

definePageMeta({
  middleware: ['sanctum:auth'],
});

const event = useEvents();
const es = useEventStore();
const loading = ref(false);
const openAttendees = ref(false);
const info = ref(null);
const isUpdate = ref(false);

const search = ref('');

onMounted(async () => {
  await nextTick();
  await event.getAttendeesDataList({});
});

async function searchAttendees() {
  loading.value = true;
  await event.getAttendeesDataList({ search: search.value });
  loading.value = false;
}

function openAttendeesDialog(data: any = null) {
  openAttendees.value = true;
  info.value = data;
  isUpdate.value = data ? true : false;
}
</script>

<template>
  <div class="attendees-container">
    <div class="header-title">
      <span>Attendees</span>
    </div>

    <div class="header-title my-5 d-flex justify-content-between">
      <div class="d-flex gap-10">
        <b-input
          v-model="search"
          class="ss-input-default border-radius-5 border-black-1 max-width-250"
          placeholder="Search attendees"
        ></b-input>
        <b-button variant="ss-primary-button" @click="searchAttendees">Search</b-button>
      </div>
      <div class="d-flex gap-16">
        <b-button variant="ss-primary-button" @click="openAttendeesDialog()">New Attendees</b-button>
      </div>
    </div>

    <div v-if="es.getAttendees" class="d-flex flex-wrap gap-32">
      <div
        v-for="(item, i) in es.getAttendees"
        :key="`attendees-${i}`"
        @click="openAttendeesDialog(item)"
        class="w-100 attendees-wrapper border-radius-10 shadow py-3 px-4 border border-dark cursor-pointer"
      >
        <div class="d-flex gap-16">
          <div
            class="attendees-image d-flex justify-content-center align-items-center border border-radius-10 shadow-sm"
          >
            <img
              v-if="item.profile_image"
              :src="item.profile_image"
              height="100"
              width="100"
              class="object-fit-contain"
              alt="profile"
            />
            <img
              v-else
              src="~assets/images/profile-group.svg"
              height="100"
              width="100"
              class="object-fit-contain"
              alt="profile"
            />
          </div>
          <div class="d-flex flex-column justify-content-between w-100">
            <div>
              <div class="display-header-20 red-color mb-2">
                <span class="fw-bold">{{ item.first_name }}</span>
              </div>
              <!-- <div>
                                <span class="fw-semibold d-block">{{ item.email }}</span>
                                <span class="fw-semibold d-block">{{ item.cell_phone }}</span>
                            </div> -->
            </div>

            <!-- <div class="d-flex gap-32 mb-3">
                            <span>
                                Age: <span class="fw-bold">{{ item.age }}</span>
                            </span>

                            <span>
                                Gender: <span class="fw-bold text-capitalize">{{ item.gender }}</span>
                            </span>
                        </div> -->
          </div>
        </div>
      </div>
    </div>

    <modal-add-attendees
      v-model="openAttendees"
      @close="openAttendees = false"
      :eid="null"
      :info="info"
      :isUpdate="isUpdate"
    ></modal-add-attendees>

    <b-modal
      v-model="loading"
      size="md"
      no-footer
      :hide-header="true"
      :hide-header-close="true"
      :no-close-on-backdrop="true"
      :no-close-on-esc="true"
      centered
      id="select-event-modal"
      class="ss-default-modal"
    >
      <div>
        <img src="~assets/images/heart-loading.gif" class="w-100 object-fit-contain" alt="" />
      </div>
      <h3 class="text-center font-weight-bold">Search Attendee, Please wait...</h3>
    </b-modal>
  </div>
</template>

<style lang="scss" scoped>
.header-title {
  @include mobile-lg {
    &.my-5 {
      flex-direction: column;
      gap: 1rem;

      .d-flex.gap-10 {
        flex-direction: column;
        gap: 0.75rem;

        .ss-input-default {
          max-width: 100%;
        }
      }

      .d-flex.gap-16 {
        align-self: stretch;

        .btn {
          width: 100%;
        }
      }
    }
  }
}

.attendees-wrapper {
  @include mobile-lg {
    .d-flex.gap-16 {
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 1rem;

      .attendees-image {
        align-self: center;
      }

      .d-flex.flex-column {
        align-items: center;
      }
    }
  }
}
</style>
