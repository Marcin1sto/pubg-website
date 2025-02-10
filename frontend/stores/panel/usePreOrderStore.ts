import {defineStore} from "pinia";
const { getApiRoute, formatApiGetRoute } = useApiRoutes();

const usePreOrderStore = defineStore('userSession', {
  state: () => ({
    preOrder: [],
    session: [],
    element: {} | [],
  }),
  actions: {
    async savePreOder(request: []) {
      const {data, pending, error}: any = await useTheFetch(getApiRoute('preOrder.create'), {
        method: 'POST',
        body: { ...request }
      });

      if (error?.value) {
        data.value = error.value.data
      }

      if (data.value.success) {
        this.sortablesData = data.value.data;
      }
    },
    async getPreOrder() {
      const {data, pending, error}: any = await useTheFetch(getApiRoute('preOrder.index'), {
        method: 'GET',
      });

      if (error?.value) {
        data.value = error.value.data
      }

      if (data.value.success) {
        this.preOrder = data.value.data;
        return data.value.data;
      }
    },
    async deletePreOrder(id) {
      if (id == null || String(id).length === 0) {
        return false;
      }

      let route = getApiRoute('preOrder.delete');
      route = route.replace(':id', id.toString());
      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'DELETE',
      });

      if (error?.value) {
        return false;

      }

      if (data.value.success) {
        return true;
      }
    },
    async updatePreOrder(request) {
      let route = getApiRoute('preOrder.update');
      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'POST',
        body: {
          ...request
        }
      });

      if (error?.value) {
        return false;
      }

      if (data.value.success) {
        return true;
      }
    },
  },
  getters: {

  }
});

export default usePreOrderStore;