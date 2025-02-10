import {defineStore} from 'pinia';
import {base64urlEncode} from "iron-webcrypto";

const {getApiRoute, formatApiGetRoute} = useApiRoutes();
const useEbayStore = defineStore('ebay', {
    persist: true,
    state: () => ({
        items: [],
        ebay: {},
        searchParams: {},
        ebayProfile: {},
        ebayOauthRedirect: {},
        ebayReceivedToken: {},
        ebayError: {},
    }),
    actions: {
        async getProfile() {

            let route = formatApiGetRoute('ebay.view', {});

            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'GET',
            });

            if (error?.value) {
                data.value = JSON.parse(error.value.data)
            }

            if (data.value.success) {
                if(data.value.data.profile) {
                    this.ebayProfile = data.value.data;
                } else {
                    this.ebayOauthRedirect = data.value.data;
                    this.ebayProfile = {};
                }

            }
        },
        async unlinkAccount() {
            let route = formatApiGetRoute('ebay.unlink', {});

            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'POST',
            });
            if (error?.value) {
                data.value = JSON.parse(error.value.data)
            }
            this.ebayProfile = {};
            if (data.value.success) {
                this.ebayOauthRedirect = data.value.data;
            } else {
                alert(data.value.message);
            }

        },
        async receiveToken(code: string) {

            code = btoa(code);
            let route = formatApiGetRoute('ebay.getToken', {});
            this.ebayError = null;
            route = route.replace(':code', code);

            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'GET',
            });
            if (data.value.success) {
                const router = useRouter();
                const nuxt = useNuxtApp();

                await router.push(nuxt.$localePath('panel-automations-ebay'));
            } else {
                this.ebayError = data.value.message;
            }
        }
    }
});

export default useEbayStore;