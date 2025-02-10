<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import useInvoiceStore from "~/stores/panel/useInvoiceStore";
import {useTableStore} from "~/stores/useTableStore";
import {ref} from "vue";

const {t} = useI18n();
const {setPageValues} = usePageStore();
setPageValues(
    t('page.panel.finances.invoices.title'),
    true
);

const tableHeaders = [
  {key: 'number', label: t('invoice.table.number'), sortable: true},
  {key: 'payment_date', label: t('invoice.table.payment_date'), sortable: true},
  {key: 'payment_left', label: t('invoice.table.payment_left'), sortable: true },
  {key: 'status', label: t('invoice.table.status'), sortable: true},
  {key: 'price_brut', label: t('invoice.table.price_brut'), sortable: true},
  {key: 'payed', label: t('invoice.table.payed'), sortable: true},
  {key: 'for_the_period', label: t('invoice.table.for_the_period'), sortable: true},
  {key: 'date_of_issue', label: t('invoice.table.date_of_issue'), sortable: true},
  {key: 'sale_date', label: t('invoice.table.sale_date'), sortable: true},
  {key: 'invoice_type', label: t('invoice.table.invoice_type'), sortable: true},
  {key: 'actions', label: t('invoice.table.actions'), sortable: false},
];

const { getInvoices, fetchInvoiceTypes } = useInvoiceStore();
const { tableItems, searchParams, invoiceTypes } = storeToRefs(useInvoiceStore());
const { setItems, setHeaders, startLoadingAsyncData } = useTableStore();
const invoiceTypesOptions = ref([]);
watch(() => invoiceTypes.value, (newValue) => {
  Object.keys(newValue).forEach((invoiceType: any, key) => {
    if (invoiceType !== undefined && key !== undefined) {
      invoiceTypesOptions.value.push({name: newValue[invoiceType], code: invoiceType})
    }
  })
})

await fetchInvoiceTypes();

const asyncData = async () => {
  await setHeaders(tableHeaders)
  startLoadingAsyncData();
  await getInvoices();
  await setItems(tableItems.value);
};

await asyncData();

const { page } = storeToRefs(useTableStore());
let unwatchInvoicesPage = watch(page, (newValue) => {
  searchParams.value.page = newValue;
  asyncData();
});

onMounted(async () => {
  page.value = 1;

  const router = useRouter();
  if (!!router.currentRoute.value.query.payed) {
    searchParams.value.payed = '0';
  }
})

onBeforeRouteLeave((to, from, next) => {
  unwatchInvoicesPage();
  next();
});

const showFilters = ref(true);
const statusPaymentOptions = [
  {name: 'Wszystkie', code: ''},
  {name: 'Opłacone', code: '1'},
  {name: 'Nieopłacone', code: '0'},
]
watch(searchParams, (newValue) => {
  if (newValue === '') {
    clearFilters();
    return;
  }

  asyncData();
}, { deep: true });

const clearFilters = async () => {
  searchParams.value = {};
  await getInvoices();
  await setItems(tableItems.value);
}

const fetchWithFilters = async () => {
  startLoadingAsyncData();
  await getInvoices();
  await setItems(tableItems.value);
}
useHead({
  title: t('page.panel.finances.invoices.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
  <div class="form_filters">
    <div class="filters_container">
      <div class="filters_row">
          <span class="filters_searchInputContainer">
            <input type="text" placeholder="Wpisz numer faktury" :value="searchParams.number" class="filters_searchInput" @change="searchParams.number = $event.target.value">
            <button><NuxtImg src="icons/orderDetails/search.png" width="21px" height="21px" class="filters_searchButton"/></button>
          </span>
        <button class="orderDetails_backButton" @click="showFilters = !showFilters">{{ showFilters ? 'Ukryj' : 'Pokaż'}} filtry<NuxtImg :src="!showFilters ? 'icons/orderDetails/arrowDown.png' : 'icons/orderDetails/arrowUp.png'" width="37px" height="37px" class="filters_backButtonImg"/></button>
      </div>

      <div class="filters_content" v-show="showFilters">
        <div class="row row--alignStart row--alignBaseline row--gap16">
          <InputFilterDatepicker :disable-year-select="false" :label="'Wystawiono od'" @change="searchParams.from = $event" :value="searchParams.from"/>
          <InputFilterDatepicker :disable-year-select="false" :label="'Wystawiono do'" @change="searchParams.to = $event" :value="searchParams.to"/>
          <InputFilterSelect :label="'Status'" :options="statusPaymentOptions" @change="searchParams.payed = $event" :base-value="searchParams.payed"/>
          <InputFilterSelect :label="'Typ faktury'" :options="invoiceTypesOptions" @change="searchParams.model = $event" :base-value="searchParams.model"/>
        </div>
        <div class="filters_contentButtonsContainer">
          <button class="filters_buttonPrimary" @click="fetchWithFilters">Szukaj</button>
          <button class="filters_buttonSecondary" v-show="Object.values(searchParams).length > 0" @click="clearFilters">Wyczyść filtry</button>
        </div>
      </div>
    </div>
  </div>
  <Table :use-checkbox="false"/>
</template>

<style scoped>

</style>