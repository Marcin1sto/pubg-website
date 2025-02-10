import {useTableStore} from "~/stores/useTableStore";

const { formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";

const useCartOrderStore = defineStore('cart-order', {
  state: () => ({
    items: [],
    tableItems: [],
    searchParams: {},
    payments: [],
    sumOrders: '0,00',
    order: {},
  }),
  actions: {
    async getCartOrders() {
      const { stopLoadingAsyncData, setCountPages } = useTableStore();
      const { limit, page, childHeaders } = storeToRefs(useTableStore());

      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('cartOrder.index', {
        ...this.searchParams,
        limit: limit.value,
        page: page.value,
      }), {
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
        setCountPages(data.value.data.countPages);
        this.items = data.value.data.orders;
        this.sumOrders = data.value.data.sumOrders;
      }

      stopLoadingAsyncData();
      this.formatForTable();
    },
    async fetchPaymentTypes() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('cartOrder.paymentTypes', {}), {
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
        this.payments = data.value.data;
      }
    },
    async getCartOrder(id: number) {
      const { setCountPages } = useTableStore();
      let route = formatApiGetRoute('cartOrder.view', {});
      route = route.replace(':id', id.toString());

      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'GET',
      });

      if (error?.value) {
        data.value = JSON.parse(error.value.data)
      }

      if (data.value.success) {
        this.order = data.value.data;
      }
    },
    formatForTable() {
      const { bodyTypes, actionsTypes } = useTableStore();
      this.tableItems = this.items.map((item: any) => {
        const CartOrder = item.CartOrder;
        const Orders = item.Order;
        let orderIds = '';
        Orders.forEach((order: any, key) => {
          orderIds += order.id + ', ';
        });

        let ItemObject = {
          canSelect: true,
          id: CartOrder.id,
          order_ids: orderIds,
          id_prefix: { type: bodyTypes.LINK, content: CartOrder.id, link: 'panel-order-id' },
          order_at: { type: bodyTypes.TEXT, content: CartOrder.created},
          package_count: { type: bodyTypes.TEXT, content: CartOrder.order_count},
          sum_price_brut: { type: bodyTypes.TEXT, content: CartOrder.items_value + ' zł'},
          payment_form: { type: bodyTypes.TEXT, content: this.getCartOrderType(CartOrder.payment) },
          status: { type: bodyTypes.TEXT, content: CartOrder.payed ? 'Opłacone' : 'Nieopłacone'},
          childRows: Orders.map((Order: any) => {
            let ApiRequest = Order.ApiRequest;
            return {
              id_prefix: { type: bodyTypes.LINK, content: Order.id, link: 'panel-order-package-id' },
              order_at: { type: bodyTypes.TEXT, content: Order.created },
              order_no: { type: bodyTypes.TEXT, content: ApiRequest.waybill_no ?? '-' },
              address: { type: bodyTypes.TEXT, content: `${Order.taker_name}, ${Order.taker_street} ${Order.taker_house_no}, ${Order.taker_postal} ${Order.taker_city}` },
              price_brut: { type: bodyTypes.TEXT, content: Order.price + ' zł'},
            }
          }),
          actions: { type: bodyTypes.ACTIONS, content: [
              { type: actionsTypes.LINK, link: 'panel-order-id', content: 'Szczegóły', id: CartOrder.id  },
            ]
          },
        }

        if (CartOrder.payment_url) {
          ItemObject.actions.content.push({
            type: actionsTypes.CUSTOM_LINK,
            link: CartOrder.payment_url,
            content: 'Ponów płatność',
          })
        }

        ItemObject.actions.content.push({ type: actionsTypes.SHOW_MORE })

        return ItemObject
      });
    },
    getCartOrderType(type: string) {
      const {types} = usePayments();
      const payment = types.find((item: any) => item.key === type);

      if (payment) {
        return payment.name;
      } else {
        return 'Nieznany';
      }
    }
  },
});

export default useCartOrderStore;