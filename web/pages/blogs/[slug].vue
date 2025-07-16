<script setup lang="ts">
const route = useRoute();
const slug = route.params.slug as string;

// Use shared blog data composable
const { getBlogBySlug } = useBlogData();
const blog = getBlogBySlug(slug);

// If blog doesn't exist, show 404
if (!blog) {
  throw createError({
    statusCode: 404,
    statusMessage: 'Blog post not found',
  });
}

// Set page meta
useSeoMeta({
  title: blog.title,
  description: blog.excerpt,
});

const goBack = () => {
  navigateTo('/blogs');
};
</script>

<template>
  <div class="blog-post-page">
    <div class="container">
      <!-- Back button -->
      <div class="back-button-section">
        <button @click="goBack" class="back-button">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M15.8334 10H4.16675M4.16675 10L10.0001 15.8333M4.16675 10L10.0001 4.16667"
              stroke="currentColor"
              stroke-width="1.67"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          Back to Blogs
        </button>
      </div>

      <!-- Blog header -->
      <div class="blog-header">
        <div class="blog-category">
          <span class="category-tag">{{ blog.category }}</span>
        </div>
        <h1 class="blog-title">{{ blog.title }}</h1>
        <div class="blog-meta">
          <div class="author-info">
            <img :src="blog.author.avatar" :alt="blog.author.name" class="author-avatar" />
            <div>
              <span class="author-name">{{ blog.author.name }}</span>
              <span class="blog-date">{{ blog.date }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Blog image -->
      <div class="blog-image-container">
        <img :src="blog.image" :alt="blog.title" class="blog-image" />
      </div>

      <!-- Blog content -->
      <div class="blog-content">
        <div class="prose">
          <p>{{ blog.content }}</p>

          <!-- Additional content sections can be added here -->
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat.
          </p>

          <h2>Key Points</h2>
          <ul>
            <li>Understanding the importance of clear communication</li>
            <li>Structuring your presentation for maximum impact</li>
            <li>Using visual elements effectively</li>
            <li>Handling questions and feedback</li>
          </ul>

          <p>
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
            laborum.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.blog-post-page {
  min-height: 100vh;
  padding: 4rem 0;

  @include mobile-lg {
    padding: 2rem 0;
  }
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 0 2rem;

  @include mobile-lg {
    padding: 0 1rem;
  }
}

.back-button-section {
  margin-bottom: 3rem;

  .back-button {
    @include font-custom(16px, 24px, 500, #667085);
    background: none;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: color 0.2s ease;

    &:hover {
      color: #374151;
    }

    @include mobile-lg {
      font-size: 14px !important;
    }
  }
}

.blog-header {
  text-align: center;
  margin-bottom: 3rem;

  .blog-category {
    margin-bottom: 1rem;

    .category-tag {
      @include font-custom(14px, 20px, 600, #6941c6);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
  }

  .blog-title {
    @include bugaki-font(48px, 56px, 400, $red);
    margin: 0 0 2rem 0;

    @include tablet {
      font-size: 40px !important;
      line-height: 48px !important;
    }

    @include mobile-lg {
      font-size: 32px !important;
      line-height: 40px !important;
    }
  }

  .blog-meta {
    .author-info {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;

      .author-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;

        @include mobile-lg {
          width: 40px;
          height: 40px;
        }
      }

      .author-name {
        @include font-custom(16px, 24px, 600, #101828);
        display: block;

        @include mobile-lg {
          font-size: 14px !important;
        }
      }

      .blog-date {
        @include font-custom(14px, 20px, 400, #667085);
        display: block;

        @include mobile-lg {
          font-size: 12px !important;
        }
      }
    }
  }
}

.blog-image-container {
  margin-bottom: 3rem;
  border-radius: 12px;
  overflow: hidden;

  .blog-image {
    width: 100%;
    height: 1000px;
    object-fit: cover;

    @include mobile-lg {
      height: 250px;
    }
  }
}

.blog-content {
  .prose {
    @include font-custom(18px, 32px, 400, #374151);

    @include mobile-lg {
      font-size: 16px !important;
      line-height: 28px !important;
    }

    h2 {
      @include font-custom(24px, 32px, 700, #101828);
      margin: 2rem 0 1rem 0;

      @include mobile-lg {
        font-size: 20px !important;
        line-height: 28px !important;
      }
    }

    ul {
      margin: 1rem 0;
      padding-left: 1.5rem;

      li {
        margin-bottom: 0.5rem;
      }
    }

    p {
      margin-bottom: 1.5rem;

      &:last-child {
        margin-bottom: 0;
      }
    }
  }
}
</style>
