import {defineStore} from 'pinia';

const {getApiRoute, formatApiGetRoute} = useApiRoutes();
const useAllegroStore = defineStore('allegro', {
    persist: true,
    state: () => ({
        items: [],
        allegro: {},
        searchParams: {},
        allegroProfile: {},
        allegroOauthRedirect: {},
        allegroReceivedToken: {},
        allegroError: {},
    }),
    actions: {
        async getProfile() {

            let route = formatApiGetRoute('allegro.view', {});

            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'GET',
            });

            if (error?.value) {
                data.value = JSON.parse(error.value.data)
            }

            if (data.value.success) {
                if(data.value.data.profile) {
                    this.allegroProfile = data.value.data;
                } else {
                    this.allegroOauthRedirect = data.value.data;
                    this.allegroProfile = {};
                }

            }
        },
        async unlinkAccount() {
            let route = formatApiGetRoute('allegro.unlink', {});

            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'POST',
            });
            if (error?.value) {
                data.value = JSON.parse(error.value.data)
            }
            this.allegroProfile = {};
            if (data.value.success) {
                this.allegroOauthRedirect = data.value.data;
            } else {
                alert(data.value.message);
            }

        },
        async receiveToken(code: string) {
            let route = formatApiGetRoute('allegro.getToken', {});
            this.allegroError = null;
            route = route.replace(':code', code);
            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'GET',
            });
            if (data.value.success) {
                const router = useRouter();
                const nuxt = useNuxtApp();

                await router.push(nuxt.$localePath('panel-automations-allegro'));
            } else {
                this.allegroError = data.value.message;
            }
        }
    }
});

export default useAllegroStore;