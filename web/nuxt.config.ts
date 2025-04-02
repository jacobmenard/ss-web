// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,
  app: {
    pageTransition: { name: 'fade', mode: 'out-in' },
    layoutTransition: { name: 'layout', mode: 'out-in' },
    head: {
      charset: 'utf-8',
      viewport: 'width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0',
      script: [{
          src: '//dist.eventscalendar.co/embed.js',
          type: 'text/javascript'
        }
    ]
    },
    title: 'Sips and Sparks'
  },
  experimental: {
    payloadExtraction: false
  },
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  modules: [
    '@bootstrap-vue-next/nuxt',
    '@pinia/nuxt',
    'nuxt-csurf',
    'nuxt-auth-sanctum',
    'nuxt-snackbar'
  ],
  snackbar: {
    bottom: true,
    right: true,
    duration: 5000
  },
  pinia: {
    storesDirs: ['./stores/**'],
  },
  css: [
    '@/assets/scss/global.scss',
    '@/assets/scss/global/buttons.scss',
    '@/assets/scss/global/inputs.scss',
    '@/assets/scss/global/modal.scss',
    'bootstrap/dist/css/bootstrap.min.css',
  ],
  vite: {
    css: {
      preprocessorOptions: {
        scss: {
          
          api: 'modern',
          silenceDeprecations: ['mixed-decls'],
          additionalData: `@use "~/assets/scss/_media-queries.scss" as *; 
                            @use "~/assets/scss/_colors.scss" as *;
                            @use "~/assets/scss/_fonts.scss" as *;`,
        },
      },
    },
  },
  imports: {
    dirs: [
      // Scan top-level modules
      'composables',
      // ... or scan modules nested one level deep with a specific name and file extension
      'composables/*/index.{ts,js,mjs,mts}',
      // ... or scan all modules within given directory
      'composables/**'
    ]
  },
    
  sanctum: {
    baseUrl: process.env.ENDPOINT_BASE_URL, // Laravel API
    redirect: {
        onLogin: '/match-form', // Custom route after successful login
        onAuthOnly: '/login',
        onGuestOnly: '/match-form',
    },
    endpoints: {
      csrf: '/sanctum/csrf-cookie',
      login: '/login',
      logout: '/logout',
      user: '/api/user',
    },
    csrf: {
        cookie: 'XSRF-TOKEN',
        header: 'X-XSRF-TOKEN',
    },
  },
  runtimeConfig: {
    public: {
      apiUrl: process.env.ENDPOINT_BASE_URL,
    }
  }
})