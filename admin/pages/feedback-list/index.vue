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
      <!-- Desktop Table View -->
      <div class="d-none d-lg-block desktop-table-view">
        <b-table-simple hover striped class="border">
          <b-thead>
            <b-tr>
              <b-th>Event ID</b-th>
              <b-th>Host</b-th>
              <b-th>Venue</b-th>
              <b-th>Event</b-th>
              <b-th>Website</b-th>
              <b-th>Others</b-th>
              <b-th>Action</b-th>
            </b-tr>
          </b-thead>

          <b-tbody>
            <b-tr v-for="(item, i) in fs.feedbackList" :key="`feedback-${i}`" class="cursor-pointer">
              <b-td>
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
              <b-td>
                <div class="d-flex flex-column gap-10">
                  <template v-if="item.host_points">
                    <img :src="getStarRating(item.host_points)" class="stars" :alt="`${item.host_points} stars`" />
                  </template>
                  <span class="truncate truncate--3">{{ item.host_feedback }}</span>
                </div>
              </b-td>
              <b-td>
                <div class="d-flex flex-column gap-10">
                  <template v-if="item.venue_points">
                    <img :src="getStarRating(item.venue_points)" class="stars" :alt="`${item.venue_points} stars`" />
                  </template>
                  <span class="truncate truncate--3">{{ item.venue_feedback }}</span>
                </div>
              </b-td>
              <b-td>
                <div class="d-flex flex-column gap-10">
                  <template v-if="item.event_points">
                    <img :src="getStarRating(item.event_points)" class="stars" :alt="`${item.event_points} stars`" />
                  </template>
                  <span class="truncate truncate--3">{{ item.event_feedback }}</span>
                </div>
              </b-td>
              <b-td>
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
              <b-td>
                <span class="truncate truncate--3">{{ item.other_feedback }}</span>
              </b-td>
              <b-td>
                <b-button variant="ss-primary-button" @click="openFeedbackModal(item)">View</b-button>
              </b-td>
            </b-tr>
          </b-tbody>
        </b-table-simple>
      </div>

      <!-- Mobile Card View -->
      <div class="d-lg-none mobile-card-view">
        <div class="mobile-feedback-grid">
          <div v-for="(item, i) in fs.feedbackList" :key="`feedback-mobile-${i}`" class="mobile-feedback-card">
            <!-- Header with Event Info -->
            <div class="mobile-card-header">
              <div class="event-info">
                <div class="event-id">{{ item.event.event_id }}</div>
                <div class="user-info">
                  <div class="user-name">{{ item.event.user.name }}</div>
                  <div class="user-email">{{ item.event.user.email }}</div>
                </div>
              </div>
              <div class="date-info">
                <small>{{ item.created_at_human }}</small>
              </div>
            </div>

            <!-- Feedback Sections -->
            <div class="mobile-feedback-sections">
              <!-- Host Feedback -->
              <div class="feedback-section" v-if="item.host_points || item.host_feedback">
                <div class="section-header">
                  <span class="section-title">Host</span>
                  <img
                    v-if="item.host_points"
                    :src="getStarRating(item.host_points)"
                    class="mobile-stars"
                    :alt="`${item.host_points} stars`"
                  />
                </div>
                <div class="feedback-text" v-if="item.host_feedback">{{ item.host_feedback }}</div>
              </div>

              <!-- Venue Feedback -->
              <div class="feedback-section" v-if="item.venue_points || item.venue_feedback">
                <div class="section-header">
                  <span class="section-title">Venue</span>
                  <img
                    v-if="item.venue_points"
                    :src="getStarRating(item.venue_points)"
                    class="mobile-stars"
                    :alt="`${item.venue_points} stars`"
                  />
                </div>
                <div class="feedback-text" v-if="item.venue_feedback">{{ item.venue_feedback }}</div>
              </div>

              <!-- Event Feedback -->
              <div class="feedback-section" v-if="item.event_points || item.event_feedback">
                <div class="section-header">
                  <span class="section-title">Event</span>
                  <img
                    v-if="item.event_points"
                    :src="getStarRating(item.event_points)"
                    class="mobile-stars"
                    :alt="`${item.event_points} stars`"
                  />
                </div>
                <div class="feedback-text" v-if="item.event_feedback">{{ item.event_feedback }}</div>
              </div>

              <!-- Website Feedback -->
              <div class="feedback-section" v-if="item.website_points || item.website_feedback">
                <div class="section-header">
                  <span class="section-title">Website</span>
                  <img
                    v-if="item.website_points"
                    :src="getStarRating(item.website_points)"
                    class="mobile-stars"
                    :alt="`${item.website_points} stars`"
                  />
                </div>
                <div class="feedback-text" v-if="item.website_feedback">{{ item.website_feedback }}</div>
              </div>

              <!-- Other Feedback -->
              <div class="feedback-section" v-if="item.other_feedback">
                <div class="section-header">
                  <span class="section-title">Others</span>
                </div>
                <div class="feedback-text">{{ item.other_feedback }}</div>
              </div>
            </div>

            <!-- Action Button -->
            <div class="mobile-card-action">
              <b-button variant="ss-primary-button" @click="openFeedbackModal(item)" class="w-100"
                >View Details</b-button
              >
            </div>
          </div>
        </div>
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
  .stars {
    width: 100px;
    height: auto;
    object-fit: contain;
  }

  .mobile-stars {
    width: 60px;
    height: auto;
    object-fit: contain;
  }

  // Debug and visibility fixes
  .mobile-card-view {
    display: block !important;
    min-height: 200px;
    background-color: #f8f9fa;
    border: 2px solid #007bff;
    border-radius: 8px;
    margin: 1rem 0;

    @media (min-width: 992px) {
      display: none !important;
    }
  }

  .desktop-table-view {
    @media (max-width: 991px) {
      display: none !important;
    }
  }

  .debug-info {
    background-color: #fff3cd !important;
    border: 1px solid #ffeaa7 !important;
    color: #856404 !important;
    font-family: monospace !important;
  }

  .empty-state {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    color: #6c757d;
    font-style: italic;
  }

  // Mobile Card Layout
  .mobile-feedback-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: 1fr;

    @include tablet {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  .mobile-feedback-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.2s ease;

    &:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
  }

  .mobile-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #f0f0f0;

    .event-info {
      flex: 1;

      .event-id {
        font-weight: bold;
        color: #333;
        margin-bottom: 0.25rem;
      }

      .user-info {
        .user-name {
          font-weight: 600;
          color: #555;
          margin-bottom: 0.125rem;
        }

        .user-email {
          font-size: 0.875rem;
          color: #777;
        }
      }
    }

    .date-info {
      flex-shrink: 0;
      text-align: right;
      color: #888;
    }
  }

  .mobile-feedback-sections {
    margin-bottom: 1rem;
  }

  .feedback-section {
    margin-bottom: 0.75rem;

    &:last-child {
      margin-bottom: 0;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 0.25rem;

      .section-title {
        font-weight: 600;
        color: #333;
        font-size: 0.875rem;
        text-transform: uppercase;
      }
    }

    .feedback-text {
      font-size: 0.875rem;
      color: #666;
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  }

  .mobile-card-action {
    border-top: 1px solid #f0f0f0;
    padding-top: 0.75rem;

    .btn {
      min-height: 40px;
      font-size: 0.875rem;
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

    @include mobile-lg {
      gap: 0.5rem;
      padding: 1rem 0;
    }

    .pagination-btn {
      min-width: 80px;
      height: 40px;

      @include mobile-lg {
        min-width: 60px;
        height: 36px;
        font-size: 0.875rem;
      }
    }
  }

  // Responsive improvements
  @include mobile-lg {
    .mobile-feedback-card {
      padding: 0.75rem;
    }

    .mobile-card-header {
      flex-direction: column;
      gap: 0.5rem;
      align-items: flex-start;

      .date-info {
        text-align: left;
      }
    }

    .mobile-stars {
      width: 50px;
    }

    .feedback-text {
      font-size: 0.8125rem;
    }
  }

  @include mobile-md {
    .mobile-feedback-card {
      padding: 0.5rem;
    }

    .section-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 0.25rem;
    }

    .mobile-stars {
      width: 45px;
    }
  }
}
</style>
