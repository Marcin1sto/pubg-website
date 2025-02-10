import {defineStore} from "pinia";
const {formatApiGetRoute} = useApiRoutes();

export const useBannersStore = defineStore('banners', {
  state: () => ({
    banners: {},
    bannersLoading: false,
  }),
  actions: {
    async getBanners(where: string, is_private: boolean = false) {
      this.bannersLoading = true;
      let request = { container: where, individual: is_private};

      // @ts-ignore
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('banners', request));

      if (error.value) {
        return;
      }

      if (data?.value?.success) {
        if (!this.banners.hasOwnProperty(where)) {
          this.banners[where] = []
        }
        this.banners[where] = data.value.data;
      }

      this.bannersLoading = false;
    }
  }
});