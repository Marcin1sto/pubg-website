import {storeToRefs} from "pinia";

export default defineNuxtRouteMiddleware(async (to, from) => {
    const { getExternalUserData } = useUserStore();
    const { authenticated, isSemiUser } = storeToRefs(useAuthStore()); // make authenticated state reactive
    const token = useCookie('token'); // get token from cookies
    const nuxt = useNuxtApp()
    await getExternalUserData();
    if (token.value) {
        // check if value exists
        authenticated.value = true; // update the state to authenticated
    }

    if (isSemiUser.value && to?.path !== nuxt.$localePath('panel-user-profile')) {
        return navigateTo(nuxt.$localePath('panel-user-profile'));
    }

    // if token exists and url is /login redirect to homepage
    if (token.value && (to?.name === 'login' || to?.name === 'register')) {
        return navigateTo(nuxt.$localePath('panel'));
    }

    // if token doesn't exist redirect to log in
    if (!token.value && to?.name !== 'login') {
        abortNavigation();

        return navigateTo(nuxt.$localePath('login'));
    }
})