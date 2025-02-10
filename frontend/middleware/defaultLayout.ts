export default defineNuxtRouteMiddleware(async (to, from) => {
    const { authenticated } = storeToRefs(useAuthStore());

    if (authenticated.value) {
        return navigateTo('/panel');
    }
})