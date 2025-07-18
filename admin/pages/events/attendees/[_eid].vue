<script lang="ts" setup>
import { nextTick, onMounted, ref } from 'vue';

definePageMeta({
  middleware: ['sanctum:auth'],
});

const config = useRuntimeConfig();

const events = useEvents();
const es = useEventStore();
const router = useRouter();
const utils = useUtils();
const { $swal } = useNuxtApp();

const openAttendees = ref(false);
const openSelectAttendees = ref(false);
const loading = ref(false);
const isLoading = ref(false);
const loadingMatchup = ref(false);
const isLoadingFinish = ref(false);

onMounted(async () => {
  await nextTick();
  isLoading.value = true;
  await events.getEventBriteEvent({ eid: router.currentRoute.value.params._eid });
  await events.getEventAttendees({ eid: router.currentRoute.value.params._eid });
  isLoading.value = false;
});

async function generateEventbriteAttendees() {
  $swal
    .fire({
      title: 'Are you sure?',
      text: 'Do you want to Import Eventbrite attendees?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
    })
    .then(async (result: any) => {
      if (result.isConfirmed) {
        loading.value = true;
        await events.getEventBriteEventsParticipantsList({ eid: router.currentRoute.value.params._eid });

        await events.getEventAttendees({ eid: router.currentRoute.value.params._eid });
        loading.value = false;
      }
    });
}

async function selectAttendees(data: any) {
  $swal
    .fire({
      title: 'Are you sure?',
      text: 'Add selected attendee for this event?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, add it!',
    })
    .then(async (result: any) => {
      if (result.isConfirmed) {
        await events.attendeeAddToEvent({
          eid: router.currentRoute.value.params._eid,
          user_id: data.id,
        });

        await events.getEventAttendees({ eid: router.currentRoute.value.params._eid });
      }
    });
}

async function openMatchup(data: any) {
  loadingMatchup.value = true;
  await events.getMatchupResult({
    eid: data.event_id,
    user_id: data.user.id,
  });
  loadingMatchup.value = false;
}

async function openPublicResultPage(item: any) {
  window.open(
    `${config.public.clientUrl}/public/match-result/${item.user.id}?eid=${router.currentRoute.value.params._eid}&type=final_result`,
    '_blank'
  );
}

async function setCheckinUser(user: any, chechinStatus: any) {
  console.log();
  $swal
    .fire({
      title: 'Confirmation',
      text: `Check-${chechinStatus ? 'In' : 'out'} ${user.user.first_name} ${user.user.last_name} now?`,
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
    })
    .then(async (result: any) => {
      if (result.isConfirmed) {
        await events.changeCheckInStatus(user.id, {
          checkin: chechinStatus,
        });

        await events.getEventAttendees({ eid: router.currentRoute.value.params._eid });
      }
    });
}

async function finishEvent() {
  $swal
    .fire({
      title: 'Finish event?',
      text: 'Do you want to finish this event and send selection email to the attendees ?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
    })
    .then(async (result: any) => {
      if (result.isConfirmed) {
        isLoadingFinish.value = true;
        await events.sendSelectionEmail({ eid: router.currentRoute.value.params._eid });
        isLoadingFinish.value = false;

        $swal.fire({
          title: 'Success',
          text: 'Selection email successfully sent to the attendees',
          icon: 'success',
        });
      }
    });
}

async function getAllMatchParticipants(item: any) {
  await events.getAllMatchParticipants({
    gender: item.user.gender,
    eid: router.currentRoute.value.params._eid,
    user_id: item.user.id,
  });
}

async function getIndividualResult(item: any) {
  $swal
    .fire({
      title: 'Send final result?',
      text: `Do you want to send match selected user match final result?`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      showLoaderOnConfirm: true,
      preConfirm: async () => {
        await events.getIndividualResult({
          eid: router.currentRoute.value.params._eid,
          user_id: item.user.id,
        });
      },
      allowOutsideClick: () => !$swal.isLoading(),
    })
    .then(async (result: any) => {
      if (result.isConfirmed) {
      }
    });
}

function showHideAttendeeFullname(idx: any, gender: any) {
  es.showHideAttendeeFullname(idx, gender);
}
</script>

<template>
  <div class="attendees-container">
    <div class="header-title">
      <span>Event</span>
    </div>

    <div v-if="es.getEvent.name" class="header-title shadow p-4">
      <span>{{ `${es.getEvent.name.text}` }}</span>
      <small class="d-block">
        {{ utils.momentTimezone(es.getEvent.start.local) }}
      </small>
    </div>

    <div v-else class="header-title shadow p-4">Loading event...</div>

    <div v-if="!isLoading" class="my-5">
      <div class="header-title mb-3 d-flex justify-content-between">
        <span>Event attendees</span>
      </div>

      <div class="d-flex justify-content-between gap-16">
        <b-button
          variant="ss-primary-button"
          @click="finishEvent"
          :disabled="isLoadingFinish || router.currentRoute.value.query.type == 'past' ? true : false"
          ><b-spinner variant="light" small v-if="isLoadingFinish"></b-spinner> <span>Finish event</span></b-button
        >

        <div class="d-flex gap-16">
          <b-button
            variant="ss-primary-button"
            @click="openSelectAttendees = true"
            :disabled="router.currentRoute.value.query.type == 'past' ? true : false"
            >Manually add attendee</b-button
          >
          <b-button
            variant="ss-primary-button"
            @click="generateEventbriteAttendees"
            :disabled="loading || router.currentRoute.value.query.type == 'past' ? true : false"
            ><b-spinner variant="light" small v-if="loading"></b-spinner> Import Eventbrite attendees</b-button
          >
        </div>
      </div>
    </div>

    <template v-if="es.getAllMale && es.getAllMale.length">
      <div class="header-title mb-3">
        <span>{{ `Male list (${es.getAllMale.length})` }}</span>
      </div>
      <div class="d-flex flex-wrap gap-32 pb-5 px-3">
        <AttendeeCard
          v-for="(item, i) in es.getAllMale"
          :key="`male-attendees-${i}`"
          :item="item"
          :index="i"
          @toggle-name="showHideAttendeeFullname"
          @check-in="setCheckinUser"
          @open-result="openPublicResultPage"
          @get-selections="getAllMatchParticipants"
          @send-result="getIndividualResult"
        />
      </div>
    </template>

    <template v-if="es.getAllFemale && es.getAllFemale.length">
      <div class="header-title mb-3">
        <span>{{ `Female list (${es.getAllFemale.length})` }}</span>
      </div>
      <div class="d-flex flex-wrap gap-32 pb-5 px-3">
        <AttendeeCard
          v-for="(item, i) in es.getAllFemale"
          :key="`female-attendees-${i}`"
          :item="item"
          :index="i"
          :show-info="true"
          @toggle-name="showHideAttendeeFullname"
          @check-in="setCheckinUser"
          @open-result="openPublicResultPage"
          @get-selections="getAllMatchParticipants"
          @send-result="getIndividualResult"
        />
      </div>
    </template>
    <modal-add-attendees
      v-model="openAttendees"
      @close="openAttendees = false"
      :eid="router.currentRoute.value.params._eid"
    ></modal-add-attendees>
    <modal-select-attendees
      v-model="openSelectAttendees"
      @close="openSelectAttendees = false"
      @select-attendees="selectAttendees"
    ></modal-select-attendees>
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
      <h3 class="text-center font-weight-bold">Storing attendees from Eventbrite</h3>
    </b-modal>
  </div>
</template>

<style lang="scss">
.attendees-container {
  @include mobile-lg {
    .header-title {
      font-size: 20px !important;
    }

    .d-flex.justify-content-between.gap-16 {
      flex-direction: column;
      width: 100%;

      .d-flex.gap-16 {
        flex-direction: column;
        width: 100%;
      }
    }

    .display-header-20 {
      font-size: 18px;
    }

    .btn,
    .b-button {
      font-size: 12px !important;
    }

    .shadow.p-4 {
      font-size: 18px;
    }
  }
}
</style>
