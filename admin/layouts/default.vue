<script lang="ts" setup>
import { onMounted, ref } from 'vue';
import friend from '@/assets/images/friend.svg';
import date from '@/assets/images/date.svg';
import none from '@/assets/images/none.svg';
import business from '@/assets/images/business.svg';
const es = useEventStore();
const events = useEvents();
const us = useUserStore();
const router = useRouter();
const isLoadingUpdateSelection = ref(false);
function openMatchup(data: any) {
  console.log('open');
}
const isOpen = ref(false);
const selected = ref({});

function test() {
  console.log('test');
}

const allSelection = ref(null);

async function logoutUser() {
  await us.logoutUser();
}

const selectionType = ref([
  { value: 2, text: 'friend', image: friend },
  { value: 3, text: 'date', image: date },
  { value: 4, text: 'business', image: business },
  // { value: 1, text: 'none', image: none },
]);

async function updateSelection() {
  isLoadingUpdateSelection.value = true;
  const withFeedbackOnly = es.getSelections.filter((n: any) => n.matchFeedback);

  const selections = withFeedbackOnly.map((n: any) => {
    return {
      id: n.user.id,
      matchup_status: n.matchFeedback,
    };
  });

  await events.updateSelection({
    eid: router.currentRoute.value.params._eid,
    selections: selections,
  });
  isLoadingUpdateSelection.value = false;
}
</script>

<template>
  <div class="default-container">
    <div
      class="header-container w-100 d-flex align-items-center justify-content-between gap-16 position-fixed top-0 start-0 shadow-sm"
    >
      <nuxt-link to="/dashboard" class="header-button d-flex align-items-center justify-content-center">
        <span>
          SIPS
          <span class="symbol">&</span>
          SPARKS
        </span>
      </nuxt-link>

      <!-- Mobile Menu Button -->
      <b-button
        variant="outline-light"
        class="mobile-menu-toggle d-md-none"
        @click="isOpen = !isOpen"
        :aria-expanded="isOpen"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </b-button>

      <!-- Desktop Menu -->
      <div class="btn-menu-container d-none d-md-flex align-items-center gap-5px border-red-1 px-5px">
        <nuxt-link to="/events" class="btn-menu letter-spacing-1 d-flex align-items-center">Events</nuxt-link>
        <nuxt-link to="/attendees" class="btn-menu letter-spacing-1 d-flex align-items-center">Attendees</nuxt-link>
        <nuxt-link to="/feedback-list" class="btn-menu letter-spacing-1 d-flex align-items-center">Feedbacks</nuxt-link>
        <nuxt-link to="/subscribers-list" class="btn-menu letter-spacing-1 d-flex align-items-center"
          >Newsletter</nuxt-link
        >
        <nuxt-link class="btn-menu letter-spacing-1 d-flex align-items-center" @click="logoutUser">Logout</nuxt-link>
      </div>

      <!-- Mobile Menu Overlay -->
      <div
        v-if="isOpen"
        class="mobile-menu-overlay d-md-none position-fixed top-0 start-0 w-100 h-100"
        @click="isOpen = false"
      ></div>

      <!-- Mobile Menu -->
      <div class="mobile-menu d-md-none position-fixed top-0 end-0 h-100 shadow-lg" :class="{ show: isOpen }">
        <div class="mobile-menu-header d-flex align-items-center justify-content-between p-3">
          <span class="fw-bold text-white">Menu</span>
          <b-button variant="outline-light" size="sm" @click="isOpen = false">
            <span>&times;</span>
          </b-button>
        </div>
        <div class="mobile-menu-content d-flex flex-column">
          <nuxt-link to="/events" class="mobile-menu-item" @click="isOpen = false">Events</nuxt-link>
          <nuxt-link to="/attendees" class="mobile-menu-item" @click="isOpen = false">Attendees</nuxt-link>
          <nuxt-link to="/feedback-list" class="mobile-menu-item" @click="isOpen = false">Feedbacks</nuxt-link>
          <nuxt-link to="/subscribers-list" class="mobile-menu-item" @click="isOpen = false">Newsletter</nuxt-link>
          <a
            href="#"
            class="mobile-menu-item"
            @click="
              logoutUser;
              isOpen = false;
            "
            >Logout</a
          >
        </div>
      </div>
    </div>

    <div class="page-container">
      <slot></slot>

      <b-offcanvas
        v-model="es.isOpenSidebar"
        title="Matchup results"
        placement="end"
        @hide="es.setOpenSidebar(false, null)"
      >
        <div v-if="es.dates.length" class="matchup-main-container">
          <div class="mb-4 px-2 text-center">
            <span class="display-6 fw-bold">DATE</span>
          </div>
          <div
            v-for="(item, i) in es.dates"
            :key="`items-${i}`"
            class="d-flex align-items-center justify-content-center gap-16 pb-4"
          >
            <card-matchup-person
              :profile_image="item.matchup_owner.profile_image"
              :name="`${item.matchup_owner.first_name} ${item.matchup_owner.last_name}`"
              :notes="item.matchup_notes"
            ></card-matchup-person>
            <card-matchup-status :status="item.matchup_status"></card-matchup-status>
            <card-matchup-person
              :profile_image="item.matchup_user.profile_image"
              :name="`${item.matchup_user.first_name} ${item.matchup_user.last_name}`"
              :notes="item.matchup_user_to_owner_notes"
            ></card-matchup-person>
          </div>
        </div>
        <div v-if="es.friends.length" class="matchup-main-container mt-3">
          <div class="mb-4 px-2 text-center">
            <span class="display-6 fw-bold">FRIEND</span>
          </div>
          <div
            v-for="(item, i) in es.friends"
            :key="`items-${i}`"
            class="d-flex align-items-center justify-content-center gap-16 pb-4"
          >
            <card-matchup-person
              :profile_image="item.matchup_owner.profile_image"
              :name="`${item.matchup_owner.first_name} ${item.matchup_owner.last_name}`"
              :notes="item.matchup_notes"
            ></card-matchup-person>
            <card-matchup-status :status="item.matchup_status"></card-matchup-status>
            <card-matchup-person
              :profile_image="item.matchup_user.profile_image"
              :name="`${item.matchup_user.first_name} ${item.matchup_user.last_name}`"
              :notes="item.matchup_user_to_owner_notes"
            ></card-matchup-person>
          </div>
        </div>
      </b-offcanvas>

      <b-offcanvas
        v-model="es.isOpenSelectionSidebar"
        title="Edit Selection"
        class="selection-sidebar"
        placement="end"
        @hide="es.setOpenSelectionSidebar(false, null)"
      >
        <card-edit-matches :info="es.getSelections"></card-edit-matches>
      </b-offcanvas>
    </div>

    <!-- <b-sidebar v-model="es.isOpenSidebar" title="Sidebar with backdrop" backdrop-variant="dark" backdrop shadow>

            <div class="px-3 py-2">
                <p>
                Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis
                in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                </p>
                <b-img src="https://picsum.photos/500/500/?image=54" fluid thumbnail></b-img>
            </div>

        </b-sidebar> -->

    <!-- <div class="sidebar-container w-100 d-flex flex-column align-items-star position-fixed top-0 start-0 shadow-sm">
            <div class="menu w-100 px-3 py-2">
                <nuxt-link to="/dashboard" class="menu-item d-flex align-items-center justify-content-center">
                    <span class="fw-bold">Dashboard</span>
                </nuxt-link>
            </div>
            <div class="menu w-100 px-3 py-2">
                <nuxt-link to="/events" class="menu-item d-flex align-items-center justify-content-center">
                    <span class="fw-bold">Events</span>
                </nuxt-link>
            </div>
            
            <div class="menu w-100 px-3 py-2">
                <nuxt-link to="/attendees" class="menu-item d-flex align-items-center justify-content-center">
                    <span class="fw-bold">Attendees</span>
                </nuxt-link>
            </div>
        </div> -->
  </div>
</template>

<style lang="scss">
.default-container {
  .header-container {
    height: 50px;
    padding: 0 2rem;
    background-color: $red1;
    z-index: 11;

    @include mobile-lg {
      padding: 0 1rem;
      height: 60px;
    }

    .header-button {
      text-decoration: unset !important;
      span {
        @include bugaki-font(18px, normal, 900, $white1) {
          .symbol {
            font-family: 'Montserrat', sans-serif !important;
          }
        }

        @include mobile-lg {
          font-size: 16px;
        }
      }
    }
  }

  .page-container {
    height: 100vh;
    width: 100vw;
    left: 0;
    padding: 50px 2rem 2rem 2rem;

    @include mobile-lg {
      padding: 60px 1rem 1rem 1rem;
    }
  }

  .sidebar-container {
    max-width: 250px;
    background-color: $white2;
    height: 100vh;
    z-index: 10;
    padding-top: 60px;
    .menu {
      &:hover {
        background-color: $red1;
        transition: 0.3s;
        .menu-item {
          color: $white2;
        }
      }

      .menu-item {
        color: $red1;
        text-decoration: unset;
      }
    }
  }

  .btn-menu-container {
    border-radius: 55px;
    gap: 5px;
    height: 100%;
    .btn-menu {
      height: 100%;
      cursor: pointer;
      @include font-custom(16px, normal, 500, $white1) {
        padding: 0px 1rem !important;
        transition: 0.3s;
        text-decoration: none;
        letter-spacing: 0.2px;
      }

      &:hover,
      &.router-link-exact-active {
        background-color: $white1 !important;
        color: $red !important;
        font-weight: 700 !important;
      }
    }
  }

  // Mobile Menu Styles
  .mobile-menu-toggle {
    border: none;
    background: transparent;

    .navbar-toggler-icon {
      display: inline-block;
      width: 1.5em;
      height: 1.5em;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: center;
      background-size: 100%;
    }
  }

  .mobile-menu-overlay {
    background: rgba(0, 0, 0, 0.5);
    z-index: 998;
  }

  .mobile-menu {
    background-color: $red1;
    width: 280px;
    z-index: 999;
    transform: translateX(100%);
    transition: transform 0.3s ease;

    &.show {
      transform: translateX(0);
    }

    .mobile-menu-header {
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      background-color: rgba(0, 0, 0, 0.1);
    }

    .mobile-menu-content {
      padding: 1rem 0;

      .mobile-menu-item {
        display: block;
        padding: 1rem 1.5rem;
        color: $white1;
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);

        &:hover,
        &.router-link-exact-active {
          background-color: rgba(255, 255, 255, 0.1);
          color: $white1;
        }
      }
    }
  }
}

.offcanvas {
  width: 100% !important;
  max-width: 1200px !important;

  &.selection-sidebar {
    max-width: 600px !important;
  }

  .selection-wrapper {
    overflow: hidden auto;
  }
}
</style>
