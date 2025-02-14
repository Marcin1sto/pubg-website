// https://nuxt.com/docs/api/configuration/nuxt-config

export default defineNuxtConfig({
    ssr: false,
    devtools: {enabled: true},

    app: {
        head: {
            charset: 'utf-8',
            viewport: 'width=device-width, initial-scale=1',
        },
    },

    css: ['@@/assets/css/tailwind.css'],

    // options: {
    //   postcss: {
    //     plugins: {
    //       tailwindcss: {},
    //       autoprefixer: {},
    //     },
    //   },
    // },

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
    vite: {
        server: {
            watch: {
                usePolling: false
            },
            hmr: false
        }
    },
    $development: {
        vite: {
            server: {
                watch: {
                    usePolling: true,
                },
                hmr: {
                    protocol: "ws",
                    host: "0.0.0.0",
                    port: 24678,
                },
            },
        },
    },
    compatibilityDate: '2025-02-13',
})
