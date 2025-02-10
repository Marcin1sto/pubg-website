import {useTableStore} from "~/stores/useTableStore";

const {getApiRoute, formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";

const useBankStore = defineStore('banks', {
  state: () => ({
    items: [],
    tableItems: [],
    searchParams: {},
  }),
  actions: {
    async sendRechargeInfo(rechargeValue: object) {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('bank.rechargeInfo', {}), {
        body: rechargeValue,
        method: 'POST',
      });

      if (error?.value) {
        return true;
      }

      if (data.value.success) {
        return false;
      }
    },
    async getBanks() {
      const { stopLoadingAsyncData, setCountPages } = useTableStore();
      const { limit} = storeToRefs(useTableStore());
      this.searchParams.limit = limit;
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('bank.index', this.searchParams), {
        method: 'GET',
      });

      if (error?.value) {
        if (typeof error.value === 'string') {
          data.value = JSON.parse(error.value.data)
        }

        return;
      }

      if (data.value.success) {
        setCountPages(data.value.data.countPages);
        this.items = data.value.data.banks;
      }

      this.formatForTable();
      stopLoadingAsyncData();
    },
    async rechargeBank(rechargeValue: any) {
      let dataResponse;
      const nuxt = useNuxtApp();

      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('bank.recharge', {}), {
        method: 'POST',
        body: {
          continueUrl: window.location.origin + nuxt.$localePath('panel-bank'),
          Bank: {
            value: rechargeValue,
          }
        },
        onResponseError(context: FetchContext & { response: FetchResponse<R> }): Promise<void> | void {
          dataResponse = context.response._data
        }
      });

      if (error?.value) {
        data.value = dataResponse;
        return data.value;
      }

      if (data.value.success) {
       return data.value;
      }
    },
    formatForTable() {
      const { bodyTypes } = useTableStore();

      this.tableItems = this.items.map((item: any) => {
        const BankItem = item.Bank;

        return {
          price: { type: bodyTypes.TEXT, content: BankItem.value + ' zł'},
          created: { type: bodyTypes.DATE, content: BankItem.created},
          description: { type: bodyTypes.TEXT, content: BankItem.desc},
        }
      });
    },
  },
});

export default useBankStore;