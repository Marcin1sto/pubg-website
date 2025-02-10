import {useTableStore} from "~/stores/useTableStore";

const {formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";

const useOrderStore = defineStore('order', {
  state: () => ({
    items: [],
    couriers: [],
    tableItems: [],
    searchParams: {},
    order: {},
    cancelOrderProcessing: false,
    cancelOrderModal: false,
    complaintOrderModal: false,
    selectedId: null,
  }),
  actions: {
    async getOrders(is_index = false) {
      const {stopLoadingAsyncData, setCountPages, setCurrentPage} = useTableStore();
      const {limit, page} = storeToRefs(useTableStore());
      this.searchParams.limit = limit.value;


      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('order.index', {
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
        setCurrentPage(data.value.data.currentPage);
        this.items = data.value.data.orders;
      }
      await this.getCouriers();
      this.formatForTable(is_index);
      stopLoadingAsyncData();
    },
    async getCouriers() {
      let route = formatApiGetRoute('order.staticCouriers', {});
      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'GET',
      });

      if (data.value.success) {
        this.couriers = data.value.data;
      }
    },
    async cancelOrder(id: number) {
      this.cancelOrderProcessing = true;
      let route = formatApiGetRoute('order.cancel', {});
      route = route.replace(':id', id.toString());

      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'POST',
      });

      if (error?.value) {
        data.value = JSON.parse(error.value.data)
      }

      if (data.value.success) {
        this.order = data.value.data;
        await this.getOrder(id);
      }
      this.cancelOrderProcessing = false;
      return data.value.success
    },
    async getOrder(id: number) {
      let route = formatApiGetRoute('order.view', {});
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
    formatForTable(is_index = false) {
      const {setItems, bodyTypes, actionsTypes} = useTableStore();

      if (is_index) {
        this.tableItems = this.items.map((item: any) => {
          const CartOrder = item.CartOrder;
          const LastTrackingStatus = item.LastTrackingStatus;
          const ApiRequest = item.ApiRequest;
          const Order = item.Order;
          const Complaints = item.Complaints;
          const Uptake = item.Uptake;
          const CourierLink = this.getLinkToCourierPackageStatusPage(ApiRequest)
          const CourierName = this.couriers[ApiRequest.type];
          const canBeCancelled = item.canBeCancelled;

          let obj = {
            canSelect: true,
            id: Order.id,
            taker: {type: bodyTypes.TEXT, content: Order.taker_name},
            created: {type: bodyTypes.DATE, content: CartOrder.created},
            uptake: {type: bodyTypes.TEXT, content: Uptake?.value ? Uptake.value + ' zł' : ''},
            cost: {type: bodyTypes.TEXT, content: Order.price + ' zł'},
            fee: {type: bodyTypes.TEXT, content: CartOrder.payed ? 'Tak' : 'Nie'},
            implementation: {type: bodyTypes.TEXT, content: ApiRequest.success ? 'OK' : ''},
            content: {type: bodyTypes.TEXT, content: Order.package_content},
            waybill_no: {type: bodyTypes.LINK, content: ApiRequest.waybill_no, link: CourierLink},
            courier: {type: bodyTypes.TEXT, content: CourierName},
            status: {type: bodyTypes.TEXT, content: LastTrackingStatus.status_desc ?? '', short: true},
            actions: {
              type: bodyTypes.ACTIONS, content: [
                {type: actionsTypes.LINK, link: 'panel-order-package-id', content: 'Szczegóły', id: Order.id},
                {
                  type: actionsTypes.FUNCTION,
                  function: this.showComplaintModal,
                  functionName: 'createComplaint',
                  content: 'Reklamuj',
                  id: Order.id,
                  styleClass: 'buttonSecondary',
                  useId: true,
                  disabled: ((!(Complaints.length > 0 || Order.cancelled != '0') && ApiRequest.waybill_no ? false : true))
                },
                {
                  type: actionsTypes.FUNCTION,
                  function: this.showCancelModal,
                  functionName: 'showCancelModal',
                  content: 'Anuluj',
                  id: Order.id,
                  styleClass: 'buttonDelete',
                  useId: true,
                  disabled: !canBeCancelled.status
                },
                {
                  type: actionsTypes.FUNCTION,
                  function: this.duplicatePackage,
                  content: 'Duplikuj przesyłkę',
                  styleClass: 'buttonSecondary',
                  useId: true,
                  id: Order.id,
                  disabled: (Order.cancelled == 1)
                }
              ]
            },
          }

          return obj;
        });

        setItems(this.tableItems);
        return;
      }


      this.tableItems = this.items.map((item: any) => {
        const CartOrder = item.CartOrder;
        const Order = item.Order;

        return {
          id_prefix: {type: bodyTypes.LINK, content: CartOrder.id, link: 'panel-order-id'},
          order_at: {type: bodyTypes.TEXT, content: CartOrder.created},
          package_count: {type: bodyTypes.TEXT, content: CartOrder.order_count},
          sum_price_brut: {type: bodyTypes.TEXT, content: Order.items_value + ' zł'},
          payment_form: {type: bodyTypes.TEXT, content: CartOrder.payment},
          status: {type: bodyTypes.TEXT, content: CartOrder.payed ? 'Opłacone' : 'Nieopłacone'},
          actions: {
            type: bodyTypes.ACTIONS, content: [
              {type: actionsTypes.LINK, link: 'panel-order-id', content: 'Szczegóły', id: CartOrder.id},
            ]
          },
        }
      });
    },
    showComplaintModal(id: number) {
      this.complaintOrderModal = true;
      this.order = this.items.find((item: any) => item.Order.id === id);
      this.selectedId = id;
    },
    showCancelModal(id: number) {
      this.cancelOrderModal = true;
      this.selectedId = id;
    },
    getLinkToCourierPackageStatusPage(ApiRequest: any) {
      const CourierType = {
        API_DPD: 'dpd',
        API_GLS: 'gls',
        API_UPS: 'ups',
        API_DHL: 'dhl',
        API_POCZTA: 'poczta',
        API_INPOST: 'inpost',
        API_ORLEN: 'orlen',
        API_FEDEX: 'fedex',
      }

      const courierPackageStatusPage = {
        [CourierType.API_DPD]: 'https://tracktrace.dpd.com.pl/parcelDetails?typ=1&p1=%number%',
        [CourierType.API_GLS]: 'https://gls-group.com/PL/pl/sledzenie-paczek?match=%number%',
        [CourierType.API_UPS]: 'http://wwwapps.ups.com/WebTracking/track?track=yes&trackNums=%number%',
        [CourierType.API_DHL]: 'https://www.dhl.com/pl-pl/home/tracking/tracking-ecommerce.html?submit=1&tracking-id=%number%',
        [CourierType.API_POCZTA]: 'https://emonitoring.poczta-polska.pl/?numer=%number%',
        [CourierType.API_INPOST]: 'https://inpost.pl/sledzenie-przesylek?number=%number%',
        [CourierType.API_ORLEN]: 'https://www.orlenpaczka.pl/sledz-paczke/?numer=%number%',
        [CourierType.API_FEDEX]: 'https://www.fedex.com/apps/fedextrack/?tracknumbers=%number%',
      }

      const courierMessage = courierPackageStatusPage[ApiRequest.type];

      if (ApiRequest?.type && ApiRequest?.waybill_no && courierMessage) {
        const link = courierMessage;
        return link.replace('%number%', ApiRequest.waybill_no);
      }

      return '#';
    },
    async duplicatePackage(orderId: number) {
      await this.getOrder(orderId)
      const {form, isEdit, firstValuationIsLoading} = storeToRefs(useOrderFormV2Store())
      const {initializeForm, initializeParamsForValuation, fetchValuationResults} = useOrderFormV2Store()
      let data = {...this.extractKeysWithValues(this.order.Order), ...this.extractKeysWithValues(this.order.CourierSearch)};
      data.origin = 'front'

      initializeForm();
      this.updateFormValues(form.value, data);

      // Dodanie podpaczek do forma
      this.order.parcels.forEach((parcel: any, index: number) => {
        if (parcel.SearchParcel.id != 0) {
          form.value.SearchParcel.push({
            weight: parcel.SearchParcel.weight,
            side_x: parcel.SearchParcel.side_x,
            side_y: parcel.SearchParcel.side_y,
            side_z: parcel.SearchParcel.side_z,
            sortable: parcel.SearchParcel.sortable,
          })
        }
      })
      firstValuationIsLoading.value = false;
      await fetchValuationResults();

      isEdit.value = true;
      const router = useRouter()
      const nuxt = useNuxtApp();
      router.push(nuxt.$localePath({name: 'panel'}));
    },
    updateFormValues(formValue: any, template: any) {
      const keyMapping = {
        city: 'vat_city',
        house_no: 'vat_house_no',
        locum_no: 'vat_locum_no',
        postal_sender	: 'vat_postal',
        street: 'vat_street',
      };

      template = Object.keys(template).reduce((acc, key) => {
        const newKey = keyMapping[key] || key; // Podmienia klucz, jeśli jest w mapowaniu, w przeciwnym razie zostawia oryginalny
        acc[newKey] = template[key];
        return acc;
      }, {});

      for (let key in formValue) {
        if (formValue[key] !== null && typeof formValue[key] === 'object') {
          this.updateFormValues(formValue[key], template);
        } else if (template[key] !== undefined) {
          formValue[key] = template[key];
        }
      }
    },
    extractKeysWithValues(obj, prefix = "") {
      const result = {};

      for (const key in obj) {
        if (typeof obj[key] === "object" && obj[key] !== null && !Array.isArray(obj[key])) {
          // Rekurencyjnie przetwarzaj zagnieżdżone obiekty
          Object.assign(result, this.extractKeysWithValues(obj[key]));
        } else {
          // Dodaj końcowy klucz i wartość
          result[key] = obj[key];
        }
      }

      return result;
    }
  },
});

export default useOrderStore;