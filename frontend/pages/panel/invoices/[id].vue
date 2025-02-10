<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import useInvoiceStore from "~/stores/panel/useInvoiceStore";
import {useTableStore} from "~/stores/useTableStore";
import useCartOrderStore from "~/stores/panel/useCartOrderStore";
import useOrderStore from "~/stores/panel/useOrderStore";
import {SymbolKind} from "vscode-languageserver-types";
import Array = SymbolKind.Array;


const {t} = useI18n();
const {setPageValues} = usePageStore();
const { getInvoice } = useInvoiceStore();
const { invoice } = storeToRefs(useInvoiceStore());
const router = useRouter();
await getInvoice(router.currentRoute.value.params.id);

setPageValues(
    t('page.panel.finances.invoices.title'),
);

const Invoice = ref(invoice.value.Invoice ?? {});

const copyToClipboard = async () => {
  try {
    await navigator.clipboard.writeText(Invoice.value.number);
  } catch (error) {
    console.error('Nie udało się skopiować tekstu:', error);
    alert('Nie udało się skopiować tekstu. Sprawdź konsolę dla szczegółów.');
  }
}

const tableHeaders = [
  {key: 'price', label: t('order.table.price'), sortable: false},
  {key: 'courier_name', label: t('order.table.courier_name'), sortable: false},
  {key: 'name', label: t('order.table.name'), sortable: false},
  {key: 'id_prefix', label: t('order.table.id_prefix'), sortable: false},
  {key: 'created', label: t('order.table.created'), sortable: false},
  {key: 'waybill_no', label: t('order.table.waybill_no'), sortable: false},
]


const { bodyTypes, setUseCheckbox } = useTableStore();
setUseCheckbox(false);
const { getLinkToCourierPackageStatusPage } = useOrderStore();
const tableItems = invoice.value.orders.map((order) => {
  const CourierLink = getLinkToCourierPackageStatusPage(order.ApiRequest)

  return {
    price: { type: bodyTypes.TEXT, content: order.Order.price + ' zł' },
    courier_name: { type: bodyTypes.TEXT, content: order.Order.courier_name },
    name: { type: bodyTypes.TEXT, content: order.Order.name },
    id_prefix: { type: bodyTypes.LINK, content: order.Order.id, link: 'panel-order-package-id' },
    created: { type: bodyTypes.TEXT, content: order.Order.created },
    waybill_no: { type: bodyTypes.HTML, content: CourierLink !== '#' ? `<a href="${CourierLink}"
                        target="_blank"
                        style="color: rgb(66, 133, 244);text-decoration: none; ">
                            ${order.ApiRequest.waybill_no}
                     </a>` : order.ApiRequest.waybill_no ?? 'Brak numeru'}
  }
})

const downloadOptions = Object.values(invoice.value.Urls).map((url) => {
  return {
    url: url.url,
    fileName: url.fileName,
    name: url.fileName
  }
})

useHead({
  title: t('page.panel.finances.invoices.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
  <div class="orderDetails_container">
    <div class="orderDetails_card">
      <div class="orderDetails_content">
        <div class="row row--column">
          <span class="orderDetails_subtitle">Numer faktury</span>
          <h2 class="orderDetails_title">{{ Invoice.number }}</h2>
          <button @click="copyToClipboard" class="orderDetails_smallLink">Skopiuj numer</button>
        </div>

        <div class="row">
          <span class="orderDetails_text orderDetails_text--bigMarginBottom">Faktura z dnia {{
              Invoice.created
            }}</span>
        </div>

        <div class="row">
          <div class="orderDetails_linksContainer">
            <InputDownloadDropdown :options="downloadOptions" />
          </div>
        </div>

        <div class="row row--orderDetails">
          <div class="orderDetails_column">
            <h3 class="orderDetails_subtitle">Szczegóły</h3>
            <span class="orderDetails_text">Wystawiono: {{ Invoice.invoice_date }}</span>
            <span class="orderDetails_text">Termin zapłaty: {{ Invoice.payment_date }}</span>
            <span class="orderDetails_text">Data sprzedaży: {{ Invoice.sale_date }}</span>
            <span class="orderDetails_text">Zapłacono: {{ (Invoice.paid_price / 100).toFixed(2) ?? '0,00' }} zł</span>
            <span class="orderDetails_text">Pozostało do zapłaty: {{ (Invoice.left_price / 100).toFixed(2)?? '0,00' }} zł</span>
            <span class="orderDetails_text">Razem (brutto): {{ (Invoice.gross_price / 100).toFixed(2) ?? '0,00' }} zł</span>
            <span class="orderDetails_text">Status: {{ Invoice.payed == true ? 'Opłacona' : 'Nieopłacona' }}</span>
          </div>
        </div>
      </div>

      <div v-if="invoice.orders.length > 0" class="orderDetails_content">
        <h3>Lista przesyłek do wystawionej faktury</h3>
      </div>
      <Table v-if="invoice.orders.length > 0" :use-store="false" :use-checkbox="false" :table-items="tableItems" :table-headers="tableHeaders" />

      <div class="row orderDetails_footer">
        <nuxt-link-locale to="panel-invoices" class="orderDetails_buttonSecondary">Wróć do listy faktur
        </nuxt-link-locale>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>