import {useTableStore} from "~/stores/useTableStore";

const {getApiRoute, formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";

const useInvoiceStore = defineStore('invoices', {
  state: () => ({
    items: [],
    tableItems: [],
    searchParams: {},
    invoice: {},
    invoiceTypes: [],
  }),
  actions: {
    async getInvoices() {
      const { stopLoadingAsyncData, setCountPages, setCurrentPage } = useTableStore();
      const { limit, page } = storeToRefs(useTableStore());

      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('invoice.index', {
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
        this.items = data.value.data.invoices;
      }

      this.formatForTable();
      stopLoadingAsyncData();

      return data.value;
    },
    async getInvoice(unique_id: number) {
      let route = formatApiGetRoute('invoice.view', {});
      route = route.replace(':unique_id', unique_id.toString());

      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'GET',
      });

      if (error?.value) {
        if (typeof error.value === 'string') {
          data.value = JSON.parse(error.value.data)
        }

        return;
      }

      if (data.value.success) {
        this.invoice = data.value.data;
      }

      return data.value;
    },
    async fetchInvoiceTypes() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('invoice.types', {}), {
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
        this.invoiceTypes = data.value.data;
      }
    },
    formatForTable() {
      const { setItems, bodyTypes, actionsTypes } = useTableStore();

      this.tableItems = this.items.map((item: any) => {
        const Invoice = item.Invoice;
        const InvoiceFromOrders = item.InvoiceFromOrders;
        let payment_left = '';

        if (!Invoice.payed) {
          if (Invoice.days_left > 0) {
            payment_left = `<span>${Invoice.days_left} dni</span>`;
          } else if (Invoice.days_left === 0) {
            payment_left = `<span style="color: red">Dzisiaj mija termin zapłaty</span>`;
          } else {
            payment_left = `<span style="color: red">Termin przekroczony: ${Invoice.days_left * (-1)} dni</span>`;
          }
        }

        let statusPayedText = this.getStatusInvoice(Invoice.payed);
        if (!Invoice.payed) {
          statusPayedText = '<span style="color: red">' + this.getStatusInvoice(Invoice.payed) + '</span>'
        }

        return {
          number: { type: bodyTypes.TEXT, content: Invoice.number },
          payment_date: { type: bodyTypes.DATE, content: Invoice.payment_date},
          status: { type: bodyTypes.HTML, content: statusPayedText},
          price_brut: { type: bodyTypes.TEXT, content: ((Invoice.gross_price / 100).toFixed(2) ?? '0.00') + ' zł'},
          payed: { type: bodyTypes.TEXT, content: ((Invoice.paid_price / 100).toFixed(2) ?? '0.00') + ' zł'},
          date_of_issue: { type: bodyTypes.DATE, content: Invoice.invoice_date},
          sale_date: { type: bodyTypes.DATE, content: Invoice.sale_date},
          invoice_type: { type: bodyTypes.TEXT, content: this.getTypeInvoice(Invoice.model)},
          payment_left: { type: bodyTypes.HTML, content: payment_left},
          for_the_period: { type: bodyTypes.TEXT, content: InvoiceFromOrders?.InvoiceGenerationRequest ?
              InvoiceFromOrders.InvoiceGenerationRequest.from + ' - ' + InvoiceFromOrders.InvoiceGenerationRequest.to : '-'},
          actions: { type: bodyTypes.ACTIONS, content: [
              { type: actionsTypes.LINK, link: 'panel-invoices-id', content: 'Szczegóły', id: Invoice.unique_id  },
            ]
          },
        }
      });
    },
    getStatusInvoice(status: string) {
      switch (status) {
        case true:
          return 'Opłacona';
        case false:
          return 'Nieopłacona';
        default:
          return 'Nieznany';
      }
    },
    getTypeInvoice(type: string) {
      switch (type) {
        case 'Bank':
          return 'Skarbonka';
        case 'Order':
          return 'Przesyłki';
        case 'Surcharge':
          return 'Dopłata za usługi kurierskie';
        case 'CartOrder':
          return 'Zamówienie';
        default:
          return 'Nieznany';
      }
    }
  },
});

export default useInvoiceStore;