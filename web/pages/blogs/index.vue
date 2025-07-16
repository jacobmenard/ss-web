<script setup lang="ts">
import { ref, computed } from 'vue';

// All available blog data
const allBlogs = ref([
  {
    id: 1,
    title: 'UX review presentations',
    excerpt: 'How do you create compelling presentations that wow your colleagues and impress your managers?',
    image:
      'https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '20 Jan 2024',
    author: {
      name: 'Olivia Rhye',
      avatar:
        'https://images.unsplash.com/photo-1500917293891-ef795e70e1f6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHdvbWFufGVufDB8fDB8fHww',
    },
    category: 'Design',
    slug: 'ux-review-presentations',
  },
  {
    id: 2,
    title: 'Migrating to Linear 101',
    excerpt: "Linear helps streamline software projects, sprints, tasks, and bug tracking. Here's how to get started.",
    image:
      'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '19 Jan 2024',
    author: {
      name: 'Phoenix Baker',
      avatar:
        'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Software Engineering',
    slug: 'migrating-to-linear-101',
  },
  {
    id: 3,
    title: 'Building your API Stack',
    excerpt: 'The rise of RESTful APIs has been met by a rise of tools for creating, testing, and managing them.',
    image:
      'https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '18 Jan 2024',
    author: {
      name: 'Lana Steiner',
      avatar:
        'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Software Engineering',
    slug: 'building-your-api-stack',
  },
  {
    id: 4,
    title: 'Bill Walsh leadership lessons',
    excerpt: 'Like to know the secrets of transforming a 2-14 team into a 3x Super Bowl winning Dynasty?',
    image:
      'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '17 Jan 2024',
    author: {
      name: 'Alec Whitten',
      avatar:
        'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Leadership',
    slug: 'bill-walsh-leadership-lessons',
  },
  {
    id: 5,
    title: 'PM mental models',
    excerpt: 'Mental models are simple expressions of complex processes or relationships.',
    image:
      'https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '16 Jan 2024',
    author: {
      name: 'Demi Wilkinson',
      avatar:
        'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Product',
    slug: 'pm-mental-models',
  },
  {
    id: 6,
    title: 'What is Wireframing?',
    excerpt: 'Introduction to Wireframing and its Principles. Learn from the best in the industry.',
    image:
      'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '15 Jan 2024',
    author: {
      name: 'Candice Wu',
      avatar:
        'https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Design',
    slug: 'what-is-wireframing',
  },
  {
    id: 7,
    title: 'How collaboration makes us better designers',
    excerpt: 'Collaboration can make our teams stronger, and our individual designs better.',
    image:
      'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '14 Jan 2024',
    author: {
      name: 'Natali Craig',
      avatar:
        'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Design',
    slug: 'how-collaboration-makes-us-better-designers',
  },
  {
    id: 8,
    title: 'Our top 10 Javascript frameworks to use',
    excerpt: 'JavaScript frameworks make development easy with extensive features and functionalities.',
    image:
      'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '13 Jan 2024',
    author: {
      name: 'Drew Cano',
      avatar:
        'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Software Engineering',
    slug: 'our-top-10-javascript-frameworks-to-use',
  },
  {
    id: 9,
    title: 'Podcast: Creating a better CX Community',
    excerpt: "Starting a community doesn't need to be complicated, but how do you get started?",
    image:
      'https://images.unsplash.com/photo-1478737270239-2f02b77fc618?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '12 Jan 2024',
    author: {
      name: 'Orlando Diggs',
      avatar:
        'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Podcasts',
    slug: 'podcast-creating-a-better-cx-community',
  },
  {
    id: 10,
    title: 'Advanced React Patterns',
    excerpt:
      'Deep dive into advanced React patterns including render props, higher-order components, and custom hooks.',
    image:
      'https://images.unsplash.com/photo-1633356122544-f134324a6cee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '11 Jan 2024',
    author: {
      name: 'Kate Morrison',
      avatar:
        'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Development',
    slug: 'advanced-react-patterns',
  },
  {
    id: 11,
    title: 'Machine Learning Fundamentals',
    excerpt:
      'Introduction to machine learning concepts, algorithms, and practical applications in modern software development.',
    image:
      'https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '10 Jan 2024',
    author: {
      name: 'Marcus Chen',
      avatar:
        'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'AI & ML',
    slug: 'machine-learning-fundamentals',
  },
  {
    id: 12,
    title: 'Cloud Architecture Best Practices',
    excerpt: 'Learn about scalable cloud architecture patterns and best practices for building robust applications.',
    image:
      'https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '9 Jan 2024',
    author: {
      name: 'Sarah Kim',
      avatar:
        'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Cloud Computing',
    slug: 'cloud-architecture-best-practices',
  },
  {
    id: 13,
    title: 'GraphQL vs REST APIs',
    excerpt: 'Comprehensive comparison between GraphQL and REST APIs, including when to use each approach.',
    image:
      'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '8 Jan 2024',
    author: {
      name: 'Alex Rivera',
      avatar:
        'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Backend',
    slug: 'graphql-vs-rest-apis',
  },
  {
    id: 14,
    title: 'Cybersecurity in Modern Apps',
    excerpt: 'Essential cybersecurity practices for protecting modern web applications and user data.',
    image:
      'https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '7 Jan 2024',
    author: {
      name: 'Emma Watson',
      avatar:
        'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'Security',
    slug: 'cybersecurity-in-modern-apps',
  },
  {
    id: 15,
    title: 'Mobile-First Design Strategy',
    excerpt: 'How to implement an effective mobile-first design strategy for better user experience.',
    image:
      'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
    date: '6 Jan 2024',
    author: {
      name: 'David Park',
      avatar:
        'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
    },
    category: 'UX Design',
    slug: 'mobile-first-design-strategy',
  },
]);

// Pagination state
const itemsPerPage = 6;
const currentPage = ref(1);
const isLoading = ref(false);

// Computed property for displayed blogs
const displayedBlogs = computed(() => {
  return allBlogs.value.slice(0, currentPage.value * itemsPerPage);
});

// Check if there are more blogs to load
const hasMoreBlogs = computed(() => {
  return displayedBlogs.value.length < allBlogs.value.length;
});

// Load more functionality
const loadMore = async () => {
  if (isLoading.value || !hasMoreBlogs.value) return;

  isLoading.value = true;

  // Simulate loading delay
  await new Promise(resolve => setTimeout(resolve, 500));

  currentPage.value++;
  isLoading.value = false;
};

const handleBlogClick = (slug: string) => {
  // Navigate to blog detail page
  navigateTo(`/blogs/${slug}`);
};
</script>

<template>
  <div class="blogs-page">
    <div class="container">
      <!-- Header Section -->
      <div class="blog-header text-center">
        <h1 class="main-title">STORIES THAT SPARK</h1>
      </div>

      <!-- Blog Grid -->
      <div class="blog-grid">
        <card-blog
          v-for="blog in displayedBlogs"
          :key="blog.id"
          :title="blog.title"
          :excerpt="blog.excerpt"
          :image="blog.image"
          :date="blog.date"
          :author="blog.author"
          :category="blog.category"
          :slug="blog.slug"
          @click="handleBlogClick"
        />
      </div>

      <!-- Load More Section -->
      <div class="load-more-section text-center" v-if="hasMoreBlogs">
        <button class="load-more-btn" @click="loadMore" :disabled="isLoading">
          <svg v-if="!isLoading" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path
              fill="currentColor"
              d="M12 19.75a.74.74 0 0 1-.53-.22l-6-6a.75.75 0 0 1 1.06-1.06L12 17.94l5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6a.74.74 0 0 1-.53.22"
            />
            <path fill="currentColor" d="M12 19.75a.76.76 0 0 1-.75-.75V5a.75.75 0 0 1 1.5 0v14a.76.76 0 0 1-.75.75" />
          </svg>
          <div v-if="isLoading" class="loading-spinner"></div>
          {{ isLoading ? 'Loading...' : 'Load more' }}
        </button>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.blogs-page {
  /* background-color: #F9FAFB; */
  min-height: 100vh;
  padding: 6rem 0;

  @include mobile-lg {
    padding: 3rem 0;
  }
}

.container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 2rem;

  @include mobile-lg {
    padding: 0 1rem;
  }
}

.blog-header {
  margin-bottom: 5rem;

  @include mobile-lg {
    margin-bottom: 3rem;
  }

  .main-title {
    @include bugaki-font(48px, 56px, 400, $red);
    margin: 0;

    @include tablet {
      font-size: 40px !important;
      line-height: 48px !important;
    }

    @include mobile-lg {
      font-size: 32px !important;
      line-height: 40px !important;
    }
  }
}

.blog-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
  margin-bottom: 5rem;

  @include laptop {
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
  }

  @include tablet {
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
  }

  @include mobile-lg {
    grid-template-columns: 1fr;
    gap: 1.5rem;
    margin-bottom: 3rem;
  }
}

.load-more-section {
  .load-more-btn {
    @include font-custom(16px, 24px, 500, #6941c6);
    background-color: #f9f5ff;
    border: 1px solid #e9d5ff;
    padding: 12px 20px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    position: relative;
    min-width: 120px;
    justify-content: center;

    &:hover {
      background-color: #f3e8ff;
      border-color: #d8b4fe;
      transform: translateY(-1px);
    }

    &:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
    }

    svg {
      transition: transform 0.2s ease;
    }

    .loading-spinner {
      width: 16px;
      height: 16px;
      border: 2px solid #e9d5ff;
      border-top: 2px solid #6941c6;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @include mobile-lg {
      font-size: 14px !important;
      padding: 10px 16px;
      min-width: 100px;
    }
  }
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
