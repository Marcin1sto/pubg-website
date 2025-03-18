// https://nuxt.com/docs/api/configuration/nuxt-config

export default defineNuxtConfig({
  ssr: false,
  devtools: {enabled: true},
  compatibilityDate: '2025-02-13',

  runtimeConfig: {
    public: {
      apiBaseUrl: process.env.API_ENDPOINT || 'http://localhost:3000/'
    },
  },
  nitro: {
    devProxy: {
      "/api/": {
        target: "http://pubg.ddev.site",
        changeOrigin: true,
        prependPath: true,
      },
    },
  },
  app: {
    head: {
      charset: 'utf-8',
      viewport: 'width=device-width, initial-scale=1',
    },
  },

  css: [
    '@@/assets/css/tailwind.css',
    '@@/assets/css/style.css'
  ],

  tailwindcss: {
    configPath: "./tailwind.config.js",
    exposeConfig: true,
    viewer: true,
  },

  i18n: {
    locales: ['en', 'pl'],
    defaultLocale: 'pl',
    vueI18n: './i18n.config.ts' // Lub `i18n.config.ts`
  },

  modules: [
    '@pinia/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
    '@nuxtjs/tailwindcss',
    '@nuxtjs/i18n'
  ],

  proxy: {
    '/api': {
      target: 'https://backend.com',
      changeOrigin: true
    }
  },

  vite: {
    server: {
      watch: {
        usePolling: false
      },
      hmr: false
    }
  }
})
