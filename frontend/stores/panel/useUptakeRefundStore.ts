import {useTableStore} from "~/stores/useTableStore";

const {getApiRoute, formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";

const useUptakeRefundStore = defineStore('uptake-refund', {
  state: () => ({
    items: [],
    statuses: [],
    tableItems: [],
    searchParams: {},
  }),
  actions: {
    async getRefunds() {
      const { stopLoadingAsyncData, setCountPages, setCurrentPage } = useTableStore();
      const { limit, page } = storeToRefs(useTableStore());

      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('uptakeRefund.index', {
        ...this.searchParams,
        limit: limit.value,
        page: page.value
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
        this.items = data.value.data.refunds ?? [];
      }

      stopLoadingAsyncData();
      this.formatForTable();
    },
    formatForTable() {
      const { bodyTypes, actionsTypes } = useTableStore();
      const config = useRuntimeConfig();

      this.tableItems = this.items.map((item: any) => {
        const RefundUser = item.RefundUser;

        return {
          id: { type: bodyTypes.TEXT, content: RefundUser.id},
          value: { type: bodyTypes.TEXT, content: RefundUser.amount + ' zł'},
          created: { type: bodyTypes.DATE, content: RefundUser.created},
          uptakes_count: { type: bodyTypes.TEXT, content: RefundUser.uptakes_count},
          courier_name: { type: bodyTypes.TEXT, content: RefundUser.courier_name},
          actions: { type: bodyTypes.ACTIONS, content: [
              { type: actionsTypes.LINK, link: 'panel-uptakes', content: 'Pobrania', id: RefundUser.id, searchParams: {refund_id: RefundUser.refund_id}  },
              { type: actionsTypes.DOWNLOAD,
                link: config.public.apiBaseUrl + formatApiGetRoute('uptakeRefund.download', {refund_id: RefundUser.refund_id}),
                content: 'Pobierz raport',
                id: RefundUser.id,
                fileName: 'raport_pobrania_' + RefundUser.id + '.xlsx'
              },
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

export default useUptakeRefundStore;