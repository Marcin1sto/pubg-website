import {defineStore} from "pinia";
const {getApiRoute} = useApiRoutes();

const useQuickValuationStore = defineStore('quickValuation', {
  state: () => ({
    persistance: true,
    params: {
      deliveryType: '',
      height: '',
      width: '',
      length: '',
      weight: '',
      senderCountry: 'PL',
      senderZipCode: '',
      recipientCountry: 'PL',
      recipientZipCode: '',
      price_for_bl_user: true,
      delivery_type: '',
    },
    paramsForRequest: {},
    results: [],
    results2: {},
    resultLoading: false,
  }),
  actions: {
    setParams(params) {
      this.params = params;
    },
    selectDeliveryType(type: string) {
      this.params.deliveryType = type;
    },
    setParamsForRequest(params) {
      this.paramsForRequest = {
        CourierSearch: {
          type: params.deliveryType,
          side_y: params.length,
          side_x: params.width,
          side_z: params.height,
          weight: params.weight,
          postal_sender_country: params.senderCountry ?? 'PL',
          country_code: params?.recipientCountry?.shortName,
          postal_sender: params.senderZipCode,
          postal_delivery_country: params.recipientCountry,
          postal_delivery: params.recipientZipCode,
          delivery_type: params.delivery_type
        },
        price_for_bl_user: params.price_for_bl_user
      }
    },
    setResults(results) {
      results = Object.keys(results).map((key) => results[key]);
      this.results['parcelLocker'] = results.filter((result) => result.taker_point_required === true);
      this.results['delivery'] =  results.filter((result) => result.taker_point_required === false);
    },
    async fetchResults() {
      if (this.resultLoading) return;

      this.resultLoading = true;

      const {data, pending, error}: any = await useTheFetch(getApiRoute('brokers.quickSearch'), {
        method: 'POST',
        body: this.paramsForRequest,
      });

      if (error?.value) {
        data.value = JSON.parse(error.value.data)
      }

      if (data.value.success) {
        this.results2 = data.value?.data?.couriers ?? [];
      } else {
        this.results2 = [];
      }

      this.resultLoading = false;
    }
  }
});

export default useQuickValuationStore;