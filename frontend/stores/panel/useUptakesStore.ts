import {useTableStore} from "~/stores/useTableStore";

const {getApiRoute, formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";

const useUptakesStore = defineStore('uptakes', {
  state: () => ({
    items: [],
    statuses: [],
    searchParams: {},
    tableItems: [],
    uptakeStatuses: [],
  }),
  actions: {
    async getUptakes() {
      const { stopLoadingAsyncData, setCountPages, setCurrentPage } = useTableStore();
      const { limit, page } = storeToRefs(useTableStore());

      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('uptake.index', {
        ...this.searchParams,
        limit: limit.value,
        page: page.value,
      }), {
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
        setCurrentPage(data.value.data.currentPage);
        this.items = data.value.data.uptakes;
      }
      stopLoadingAsyncData();
      this.formatForTable();

      return data.value;
    },
    async fetchUptakeStatuses() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('uptake.statuses', this.searchParams), {
        method: 'GET',
      });

      if (error?.value) {
        data.value = JSON.parse(error.value.data)
      } else {
        if (typeof data.value === 'string') {
          data.value = JSON.parse(data.value)
        }
      }

      if (data.value.success) {
        this.uptakeStatuses = data.value.data;
      }
    },
    formatForTable() {
      const { bodyTypes, actionsTypes } = useTableStore();

      this.tableItems = this.items.map((item: any) => {
        const Uptake = item.Uptake;
        const Order = item.Order;
        const UptakeStatus = item.UptakeStatus;
        let currency = '';

        switch (Uptake.currency) {
          case 'PLN':
            currency = 'zł';
            break;
          case 'EUR':
            currency = '€';
            break;
          case 'USD':
            currency = '$';
            break;
          case 'CZK':
            currency = 'CZK';
            break;
          case 'RON':
            currency = 'RON';
            break;
          case 'BGN':
            currency = 'BGN';
            break;
          case 'HUF':
            currency = 'HUF';
            break;
          default:
            currency = 'zł';
        }

        return {
          canSelect: true,
          id: { type: bodyTypes.TEXT, content: Uptake.id},
          value: { type: bodyTypes.TEXT, content: Uptake.value + ' ' + currency},
          seizure: { type: bodyTypes.TEXT, content: Uptake.seizure > 0 ? Uptake.seizure + ' ' + currency : '0,00 ' + ' ' + currency},
          seizure_comment: { type: bodyTypes.TEXT, content: Uptake.seizure_comment },
          cart_id: { type: bodyTypes.TEXT, content: Order?.cart_id },
          waybill_no: { type: bodyTypes.TEXT, content: Order?.ApiRequest?.waybill_no},
          courier_name: { type: bodyTypes.TEXT, content: Order?.Courier?.name},
          package_content: { type: bodyTypes.TEXT, content: Order?.package_content},
          uptake_type: { type: bodyTypes.TEXT, content: this.getUptakeTypeName(Uptake.uptake_type)},
          return_from: { type: bodyTypes.TEXT, content: Uptake.return_from_desc},
          days_to_return_left: { type: bodyTypes.TEXT, content: Uptake.days_to_return_left ? Uptake.days_to_return_left + (Uptake.days_to_return_left > 1 ? ' dni' : ' dzień') : '-'},
          created: { type: bodyTypes.DATE, content: Uptake.created},
          status: { type: bodyTypes.TEXT, content: UptakeStatus.name},
          actions: { type: bodyTypes.ACTIONS, content: [
              { type: actionsTypes.LINK, link: 'panel-order-package-id', content: 'Szczegóły', id: Order?.id  },
            ]
          },
        }
      });
    },
    getUptakeTypeName(type: string) {
      switch (type) {
        case 'bank':
          return 'Konto bankowe';
        case 'post':
          return 'Pobranie pocztowe';
        default:
          return 'Nieznany';
      }
    }
  },
});

export default useUptakesStore;