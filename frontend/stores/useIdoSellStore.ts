import {defineStore} from 'pinia';

const {getApiRoute, formatApiGetRoute} = useApiRoutes();
const useIdoSellStore = defineStore('idosell', {
    persist: true,
    state: () => ({
        keyDomain: null,
        key: null,
        domain: null,
    }),
    actions: {
        async getProfile() {

            let route = formatApiGetRoute('idosell.view', {});

            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'GET',
            });

            if (error?.value) {
                data.value = JSON.parse(error.value.data)
            }

            if (data.value.success) {
                if(data.value.data.keyDomain) {
                    this.keyDomain = data.value.data.keyDomain;
                }
            }
        },
        async unlinkAccount() {
            let route = formatApiGetRoute('idosell.unlink', {});

            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'POST',
            });
            if (error?.value) {
                data.value = JSON.parse(error.value.data)
            }
            this.allegroProfile = {};
            if (data.value.success) {
                this.keyDomain = null;
                this.key = null;
                this.domain = null;
            } else {
                this.keyDomain = null;
                this.key = null;
                this.domain = null;
                alert(data.value.message);
            }
        },
        async saveKey() {

            let route = formatApiGetRoute('idosell.save', {});
            this.allegroError = null;

            const {data, pending, error}: any = await useTheFetch(route, {
                method: 'POST',
                body: {
                    key: this.key,
                    domain: this.domain
                }
            });
            if (data.value.success) {
                await this.getProfile();
            } else {
                alert(data.value.message);
            }
        }
    }
});

export default useIdoSellStore;