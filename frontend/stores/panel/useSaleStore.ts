import {useTableStore} from "~/stores/useTableStore";
import {defineStore} from "pinia";
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";

const {formatApiGetRoute} = useApiRoutes();

const useSaleStore = defineStore('sale', {
  state: () => ({
    items: [],
    tableItems: [],
    searchParams: {},
    sale: {},
    cancelSaleProcessing: false,
  }),
  actions: {
    async getSale(id: number) {
      const {setCountPages} = useTableStore();
      let route = formatApiGetRoute('sales.view', {});
      route = route.replace(':id', id.toString());

      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'GET',
      });

      if (error?.value) {
        data.value = JSON.parse(error.value.data)
      }

      if (data.value.success) {
        this.sale = data.value.data;
      }
    },
    async getSales(is_index = false) {
      const {stopLoadingAsyncData, setCountPages, setCurrentPage} = useTableStore();
      const {limit, page} = storeToRefs(useTableStore());
      this.searchParams.limit = limit.value;

      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('sales.index', {
        ...this.searchParams,
        limit: limit.value,
        page: page.value,
      }), {
        method: 'GET',
      });

      if (error?.value) {
        data.value = JSON.parse(error.value.data);
      } else {
        if (typeof data.value === 'string') {
          data.value = JSON.parse(data.value);
        }
      }

      if (data.value.success) {
        setCountPages(data.value.data.countPages);
        setCurrentPage(data.value.data.currentPage);
        this.items = data.value.data.sales;
      }
      this.formatForTable(is_index);
      stopLoadingAsyncData();
    },
    selectSale(index: number) {
      const {form, isEditSales} = storeToRefs(useOrderFormV2Store());
      const { initializeForm } = useOrderFormV2Store();
      let sale = this.items[index].Sale;

      initializeForm();
      isEditSales.value = true

      form.value.recipient = {
        taker_city: sale.taker_city,
        taker_email: sale.taker_email,
        taker_house_no: sale.taker_house_no,
        taker_locum_no: sale.taker_locum_no,
        taker_name: sale.taker_name,
        taker_phone: sale.taker_phone,
        taker_postal: sale.taker_postal,
        taker_street: sale.taker_street,
        taker_vat_company: sale.taker_vat_company,
        marketplace_sale_id: sale.marketplace_sale_id,
      }

      form.value.services.uptake = sale.cod;
      form.value.services.cover = sale.cod;

      form.value.recipient.country = sale.country_code ?? 'PL';
      form.value.taker_point = sale.taker_point;

      const router = useRouter();
      const nuxt = useNuxtApp();

      router.push(nuxt.$localePath('panel'));

    },
    formatForTable() {
      const {setItems, bodyTypes, actionsTypes} = useTableStore();

      this.tableItems = this.items.map((item: any) => {

        const Sale = item.Sale;
        const Order = item.Order;

        const waybillNo = Sale.waybill_no ? Sale.waybill_no + "<br/>" + Order.courier_name : '<span style="color:grey">Nie nadano paczki</span>';
        let taker = (Sale.taker_vat_company ?? '') + ' ' + Sale.taker_name + "<br/><b>Adres</b><br/>" + Sale.taker_street + " " + Sale.taker_house_no + "<br/>" + Sale.taker_postal + " " + Sale.taker_city;

        if(Sale.country_code) {
            taker += "<br/> Kraj: <b>" + Sale.country_code + "</b>";
        }

        if (Sale.taker_point) {
          taker += "<br/><b>Punkt odbioru</b><br/>" + Sale.taker_point_name;
        }
        let actions = {};
        if (Sale.order_id > 0) {
          actions = {
            type: actionsTypes.LINK,
            content: 'Przesyłka',
            link: 'panel-order-package-id',
            id: Sale.order_id,
          }
        } else {
          actions = {
            type: actionsTypes.FUNCTION,
            styleClass: 'buttonSecondary',
            function: this.selectSale,
            content: 'Nadaj',
            id: Sale.id
          }
        }

        return {
          marketplace_sale_id: {type: bodyTypes.TEXT, content: Sale.id},
          waybill_no: {type: bodyTypes.HTML, content: waybillNo},
          created: {type: bodyTypes.TEXT, content: Sale.created},
          taker: {type: bodyTypes.HTML, content: taker},
          marketplace: {
            type: bodyTypes.IMG,
            content: "/icons/" + Sale.marketplace +".png"
          },
          contact: {type: bodyTypes.HTML, content: "Telefon: " + Sale.taker_phone + "<br/>" + (Sale.taker_email ?? '')},
          actions: {type: bodyTypes.ACTIONS, content: [actions]}
        }
      });

      setItems(this.tableItems);
      return;

    },
  },
});

export default useSaleStore;