<script lang="ts" setup>
import { nextTick, onMounted, ref } from 'vue';

definePageMeta({
  middleware: ['sanctum:auth'],
});

const feedback = useFeedback();
const fs = useFeedbackStore();
const pageNumber = ref(1);
const openViewFeedback = ref(false);
const info = ref(null);

async function getFeedbacks(isNext: boolean) {
  if (isNext) {
    pageNumber.value++;
  } else {
    pageNumber.value--;
  }

  await feedback.userFeedback({
    pageSize: 20,
    page: pageNumber.value,
  });
}

function openFeedbackModal(data: any) {
  info.value = data;
  openViewFeedback.value = true;
}

function getStarRating(points: number): string | undefined {
  if (!points) return undefined;
  return `~assets/images/star${points}.svg`;
}

onMounted(async () => {
  await nextTick();
  await feedback.userFeedback({
    pageSize: 20,
    page: pageNumber.value,
  });
});
</script>

<template>
  <div class="feedback-container">
    <div class="header-title">
      <span>Feedback list</span>
    </div>

    <card-container>
      <!-- Responsive Table with Horizontal Scroll -->
      <div class="table-responsive">
        <b-table-simple hover striped class="border feedback-table">
          <b-thead>
            <b-tr>
              <b-th class="col-event-id">Event ID</b-th>
              <b-th class="col-host">Host</b-th>
              <b-th class="col-venue">Venue</b-th>
              <b-th class="col-event">Event</b-th>
              <b-th class="col-website">Website</b-th>
              <b-th class="col-others">Others</b-th>
              <b-th class="col-action">Action</b-th>
            </b-tr>
          </b-thead>

          <b-tbody>
            <b-tr v-for="(item, i) in fs.feedbackList" :key="`feedback-${i}`" class="cursor-pointer">
              <b-td class="col-event-id">
                <a href="#" class="fw-bold">{{ item.event.event_id }}</a>

                <div class="fw-bold">
                  {{ item.event.user.name }}
                  <span class="d-block">
                    {{ item.event.user.email }}
                  </span>
                </div>
                <div>
                  <small>{{ `${item.created_at} (${item.created_at_human})` }}</small>
                </div>
              </b-td>
              <b-td class="col-host">
                <div class="d-flex flex-column gap-10">
                  <template v-if="item.host_points">
                    <img :src="getStarRating(item.host_points)" class="stars" :alt="`${item.host_points} stars`" />
                  </template>
                  <span class="truncate truncate--3">{{ item.host_feedback }}</span>
                </div>
              </b-td>
              <b-td class="col-venue">
                <div class="d-flex flex-column gap-10">
                  <template v-if="item.venue_points">
                    <img :src="getStarRating(item.venue_points)" class="stars" :alt="`${item.venue_points} stars`" />
                  </template>
                  <span class="truncate truncate--3">{{ item.venue_feedback }}</span>
                </div>
              </b-td>
              <b-td class="col-event">
                <div class="d-flex flex-column gap-10">
                  <template v-if="item.event_points">
                    <img :src="getStarRating(item.event_points)" class="stars" :alt="`${item.event_points} stars`" />
                  </template>
                  <span class="truncate truncate--3">{{ item.event_feedback }}</span>
                </div>
              </b-td>
              <b-td class="col-website">
                <div class="d-flex flex-column gap-10">
                  <template v-if="item.website_points">
                    <img
                      :src="getStarRating(item.website_points)"
                      class="stars"
                      :alt="`${item.website_points} stars`"
                    />
                  </template>
                  <span class="truncate truncate--3">{{ item.website_feedback }}</span>
                </div>
              </b-td>
              <b-td class="col-others">
                <span class="truncate truncate--3">{{ item.other_feedback }}</span>
              </b-td>
              <b-td class="col-action">
                <b-button variant="ss-primary-button" size="sm" @click="openFeedbackModal(item)">View</b-button>
              </b-td>
            </b-tr>
          </b-tbody>
        </b-table-simple>
      </div>

      <!-- Pagination -->
      <div v-if="fs.getlink" class="pagination-container">
        <b-button
          variant="ss-primary-button"
          :disabled="!fs.getlink.prev"
          @click="getFeedbacks(false)"
          class="pagination-btn"
        >
          Prev
        </b-button>
        <b-button
          variant="ss-primary-button"
          :disabled="!fs.getlink.next"
          @click="getFeedbacks(true)"
          class="pagination-btn"
        >
          Next
        </b-button>
      </div>
    </card-container>

    <modal-view-feedback
      v-model="openViewFeedback"
      :info="info"
      @close="openViewFeedback = false"
    ></modal-view-feedback>
  </div>
</template>

<style lang="scss" scoped>
.feedback-container {
  .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .feedback-table {
    min-width: 800px; // Ensure minimum width to prevent severe compression
    
    .stars {
      width: 100px;
      height: auto;
      object-fit: contain;
    }

    // Column width definitions
    .col-event-id {
      min-width: 150px;
      width: 20%;
    }

    .col-host,
    .col-venue,
    .col-event,
    .col-website {
      min-width: 120px;
      width: 15%;
    }

    .col-others {
      min-width: 100px;
      width: 12%;
    }

    .col-action {
      min-width: 80px;
      width: 8%;
      text-align: center;
    }

    // Mobile responsive adjustments
    @media (max-width: 768px) {
      min-width: 600px; // Smaller minimum width for mobile
      font-size: 0.875rem;

      .stars {
        width: 60px;
      }

      .col-event-id {
        min-width: 130px;
      }

      .col-host,
      .col-venue,
      .col-event,
      .col-website {
        min-width: 100px;
      }

      .col-others {
        min-width: 80px;
      }

      .col-action {
        min-width: 70px;
      }

      // Better text handling on mobile
      .truncate {
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
    }

    @media (max-width: 480px) {
      min-width: 500px;
      font-size: 0.8rem;

      .stars {
        width: 50px;
      }

      .col-event-id {
        min-width: 110px;
      }

      .col-host,
      .col-venue,
      .col-event,
      .col-website {
        min-width: 80px;
      }

      .col-others {
        min-width: 60px;
      }

      .col-action {
        min-width: 60px;
      }

      .truncate {
        max-width: 80px;
      }
    }
  }

  // Pagination
  .pagination-container {
    display: flex;
    justify-content: center;
    gap: 1rem;
    padding: 1.5rem 0;
    margin-top: 1rem;
    border-top: 1px solid #f0f0f0;

    @media (max-width: 768px) {
      gap: 0.5rem;
      padding: 1rem 0;
    }

    .pagination-btn {
      min-width: 80px;
      height: 40px;

      @media (max-width: 768px) {
        min-width: 60px;
        height: 36px;
        font-size: 0.875rem;
      }
    }
  }
}
</style>
