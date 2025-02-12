// https://nuxt.com/docs/api/configuration/nuxt-config

export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: {enabled: true},
  css: ['@@/assets/css/tailwind.css'],
  options: {
    ssr: true,
    target: 'static',
    postcss: {
      plugins: {
        tailwindcss: {},
        autoprefixer: {},
      },
    },
  },
  tailwindcss: {
    configPath: "./tailwind.config.js",
    exposeConfig:true,
    viewer: true,
  },
  modules: [
    // '@pinia/nuxt',
    // '@nuxtjs/i18n',
    // '@nuxt/image',
    // '@pinia-plugin-persistedstate/nuxt',
    '@nuxtjs/tailwindcss',
    // '@tailwindcss/postcss'
  ],
})
