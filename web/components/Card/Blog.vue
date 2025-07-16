<script setup lang="ts">
interface BlogCardProps {
  title: string;
  excerpt: string;
  image: string;
  date: string;
  author: {
    name: string;
    avatar: string;
  };
  slug: string;
  category?: string;
}

const props = defineProps<BlogCardProps>();
const emit = defineEmits(['click']);

const handleClick = () => {
  emit('click', props.slug);
};
</script>

<template>
  <div class="ss-blog-card-wrapper" @click="handleClick">
    <div class="blog-img-container">
      <img :src="props.image" :alt="props.title" />
    </div>
    <div class="blog-content">
      <div class="blog-category" v-if="props.category">
        <span class="category-tag">{{ props.category }}</span>
      </div>
      <div class="blog-title-wrapper">
        <h3 class="blog-title">{{ props.title }}</h3>
        <div class="arrow-icon">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M3.33337 8H12.6667M12.6667 8L8.00004 3.33333M12.6667 8L8.00004 12.6667"
              stroke="currentColor"
              stroke-width="1.33"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
      </div>
      <p class="blog-excerpt">{{ props.excerpt }}</p>
      <div class="blog-author">
        <div class="author-avatar">
          <img :src="props.author.avatar" :alt="props.author.name" />
        </div>
        <div class="author-info">
          <span class="author-name">{{ props.author.name }}</span>
          <span class="blog-date">{{ props.date }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.ss-blog-card-wrapper {
  width: 100%;
  cursor: pointer;
  background-color: $white2;
  /* border-radius: 12px; */
  overflow: hidden;
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1), 0px 1px 2px rgba(0, 0, 0, 0.06);
  transition: transform 0.2s ease, box-shadow 0.2s ease;

  &:hover {
    transform: translateY(-1px);
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.07), 0px 2px 4px rgba(0, 0, 0, 0.06);
  }

  .blog-img-container {
    width: 100%;
    height: 240px;
    overflow: hidden;

    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    @include mobile-lg {
      height: 180px;
    }
  }

  .blog-content {
    padding: 24px;

    @include mobile-lg {
      padding: 16px;
    }
  }

  .blog-category {
    margin-bottom: 8px;

    .category-tag {
      @include font-custom(12px, 18px, 600, #6941c6);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
  }

  .blog-title-wrapper {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 8px;

    .blog-title {
      @include font-custom(18px, 28px, 600, #101828);
      margin: 0;
      flex: 1;

      @include mobile-lg {
        font-size: 16px !important;
        line-height: 24px !important;
      }
    }

    .arrow-icon {
      flex-shrink: 0;
      color: #667085;
      margin-top: 2px;
    }
  }

  .blog-excerpt {
    @include font-custom(16px, 24px, 400, #667085);
    margin: 0 0 24px 0;

    @include mobile-lg {
      font-size: 14px !important;
      line-height: 20px !important;
      margin-bottom: 16px;
    }
  }

  .blog-author {
    display: flex;
    align-items: center;
    gap: 12px;

    .author-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      overflow: hidden;

      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      @include mobile-lg {
        width: 32px;
        height: 32px;
      }
    }

    .author-info {
      .author-name {
        @include font-custom(14px, 20px, 500, #101828);
        display: block;
        margin-bottom: 2px;

        @include mobile-lg {
          font-size: 12px !important;
          line-height: 18px !important;
        }
      }

      .blog-date {
        @include font-custom(14px, 20px, 400, #667085);

        @include mobile-lg {
          font-size: 12px !important;
          line-height: 18px !important;
        }
      }
    }
  }
}
</style>
