export default function ({ app1, route1, redirect }) {

    const app = useNuxtApp()
    const route = useRoute()
    const router = useRouter()

    if (app.$i18n.locale.value === 'pl' && route.path === '/login') {
        return router.push({path: app.$localePath('login'), query: router.currentRoute.value.query})
    }

    router.push('/')
}
