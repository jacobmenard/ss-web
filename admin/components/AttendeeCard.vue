<template>
  <div class="w-100 attendees-wrapper border-radius-10 shadow py-3 px-4 border border-dark">
    <div class="d-flex justify-content-between gap-16 w-100">
      <div class="d-flex gap-16">
        <div class="attendees-image d-flex justify-content-center align-items-center border rounded-circle shadow-sm">
          <img
            v-if="item.user.profile_image"
            :src="item.user.profile_image"
            height="70"
            width="70"
            class="object-fit-contain"
            alt="profile"
          />
          <img
            v-else
            src="~assets/images/profile-group.svg"
            height="70"
            width="70"
            class="object-fit-contain"
            alt="profile"
          />
        </div>
        <div class="d-flex justify-content-center w-100 align-items-center">
          <div>
            <div class="display-header-20 red-color mb-2 d-flex gap-10 justify-content-center align-items-center">
              <span class="fw-bold">{{ item.isShow ? item.user.name : item.user.first_name }}</span>

              <img
                v-if="!item.isShow"
                src="~assets/images/eye.png"
                @click="$emit('toggle-name', index, item.user.gender)"
                height="20"
                class="object-fit-contain cursor-pointer"
                alt=""
              />
              <img
                v-if="item.isShow"
                src="~assets/images/hidden.png"
                @click="$emit('toggle-name', index, item.user.gender)"
                height="20"
                class="object-fit-contain cursor-pointer"
                alt=""
              />
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex">
        <div class="d-flex gap-16 align-items-center">
          <img v-if="item.is_checkin" src="~assets/images/green-circle.png" height="20" alt="checkin" />

          <b-dropdown text="Action" variant="ss-action-menu">
            <b-dropdown-item v-if="showInfo" @click="$emit('show-info', item)">Show info</b-dropdown-item>
            <b-dropdown-item @click="$emit('check-in', item, 1)" v-if="!item.is_checkin">Check-in</b-dropdown-item>
            <b-dropdown-item @click="$emit('check-in', item, 0)" v-if="item.is_checkin">Check-out</b-dropdown-item>
            <b-dropdown-divider v-if="!showInfo"></b-dropdown-divider>
            <b-dropdown-item @click="$emit('open-result', item)">Result</b-dropdown-item>
            <b-dropdown-item @click="$emit('get-selections', item)">Selections</b-dropdown-item>
            <b-dropdown-item @click="$emit('send-result', item)">Send result</b-dropdown-item>
          </b-dropdown>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  item: {
    type: Object,
    required: true
  },
  index: {
    type: Number,
    required: true
  },
  showInfo: {
    type: Boolean,
    default: false
  }
})

defineEmits(['toggle-name', 'show-info', 'check-in', 'open-result', 'get-selections', 'send-result'])
</script>

<style lang="scss" scoped>
.attendees-image {
  min-height: 70px;
  min-width: 70px;
  max-height: 70px;
  max-width: 70px;
}

@include mobile-lg {
  .attendees-wrapper {
    padding: 12px !important;
    
    .d-flex.justify-content-between.gap-16.w-100 {
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 16px !important;
    }

    .d-flex.gap-16 {
      flex-direction: column;
      align-items: center;
      width: 100%;
      gap: 12px !important;
    }

    .d-flex.justify-content-center.w-100.align-items-center {
      justify-content: center !important;
    }

    .display-header-20 {
      justify-content: center !important;
      font-size: 18px;
    }
  }

  .attendees-image {
    min-height: 50px;
    min-width: 50px;
    max-height: 50px;
    max-width: 50px;
  }
}
</style>