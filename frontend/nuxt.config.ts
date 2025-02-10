// https://nuxt.com/docs/api/configuration/nuxt-config

let pagesTranslations = require('./i18n/pages.json')
import vuetify, { transformAssetUrls } from 'vite-plugin-vuetify'
export default defineNuxtConfig({
    ssr: false,
    devtools: {
        enabled: true
    },
    runtimeConfig: {
        public: {
            apiBaseUrl: process.env.API_BASE_URL || 'http://localhost:55000/',
            googleRecaptchaSiteKey: process.env.RECAPTCHA_SITE_KEY_V3,
            APP_ENV: process.env.APP_ENV,
            REGISTER_USE_SMS_VERIFICATION: process.env.REGISTER_USE_SMS_VERIFICATION,
        },
    },
    app: {
        head: {
            charset: 'utf-8',
            viewport: 'width=device-width, initial-scale=1',
        },
    },
    css: [
        '~/assets/styles/main.scss',
        'vuetify/lib/styles/main.sass',
    ],
    middleware: ['redirect'],
    router: {
        "middleware": ['redirect'],
    },
    i18n: {
        defaultLocale: 'pl',
        customRoutes: 'config',
        strategy: 'prefix_except_default',
        locales: [
            {
                code: 'pl',
                iso: 'pl-PL',
                name: 'Polski',
            }, {
                code: 'en',
                iso: 'en-GB',
                name: 'English',
            },
        ],
        pages: pagesTranslations
    },
    modules: [
        '@pinia/nuxt',
        '@nuxtjs/i18n',
        '@nuxt/image',
        '@vee-validate/nuxt',
        '@pinia-plugin-persistedstate/nuxt',
        "vue3-carousel-nuxt"
    ],
    vite: {
        vue: {
            template: {
                transformAssetUrls,
            },
        },
    }
})