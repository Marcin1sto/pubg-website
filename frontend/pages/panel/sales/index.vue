<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import {useTableStore} from "~/stores/useTableStore";
import useSaleStore from "~/stores/panel/useSaleStore";

const {t} = useI18n();
const {setPageValues} = usePageStore();
const { page } = storeToRefs(useTableStore());
const {setItems, setHeaders, startLoadingAsyncData} = useTableStore();
const { getSales } = useSaleStore();
const { searchParams, tableItems } = storeToRefs(useSaleStore());

const tableHeaders = [
  {key: 'marketplace_sale_id', label: t('sales.table.marketplace_sale_id'), sortable: true},
  {key: 'taker', label: t('sales.table.taker'), sortable: true},
  {key: 'marketplace', label: t('sales.table.marketplace'), sortable: true},
  {key: 'created', label: t('sales.table.created'), sortable: true},
  {key: 'waybill_no', label: t('sales.table.waybill_no'), sortable: true},
  {key: 'contact', label: t('sales.table.contact'), sortable: true},
  {key: 'actions', label: t('sales.table.actions'), sortable: false},
]

onBeforeMount(async () => {
  setHeaders(tableHeaders);
});

const clearFilters = async () => {
  searchParams.value = {};
  await getSales(true);
  await setItems(tableItems.value);
}

const fetchWithFilters = async () => {
  startLoadingAsyncData();
  await getSales(true);
  await setItems(tableItems.value);
}

let unwatchOrdersPage = watch(page, (newValue) => {
  searchParams.value.page = newValue;
  asyncData();
});

onBeforeRouteLeave((to, from, next) => {
  unwatchOrdersPage();
  next();
});

const asyncData = async () => {
  startLoadingAsyncData();
  await getSales(true);
}
await asyncData();

const statusPaymentOptions = [
  {name: 'Wszystkie', code: ''},
  {name: 'Tak', code: '1'},
  {name: 'Nie', code: '0'},
]

const marketplaces = [
  {name: 'Wszystkie', code: ''},
  {name: 'Allegro', code: 'allegro'},
  {name: 'Ebay', code: 'ebay'},
  {name: 'Amazon', code: 'amazon'},
  {name: 'IdoSell', code: 'idosell'},
]

useHead({
  title: t('sales.title')
});

setPageValues(
    t('sales.title'),
    true
);

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})

const showFilters = ref(false);
</script>

<template>
  <div class="form_filters">
    <div class="filters_container">
      <div class="filters_row filters_row--mobile">
          <span class="filters_searchInputContainer filters_searchInputContainer--mobile">
            <input type="text" placeholder="Wpisz numer zamówienia" :value="searchParams.numer"
                   class="filters_searchInput" @change="searchParams['numer-nazwa'] = $event.target.value">
            <button><NuxtImg src="icons/orderDetails/search.png" width="21px" height="21px"
                             class="filters_searchButton"/></button>
          </span>
        <button class="orderDetails_backButton" @click="showFilters = !showFilters">
          {{ showFilters ? 'Ukryj' : 'Pokaż' }} filtry
          <NuxtImg :src="!showFilters ? 'icons/orderDetails/arrowDown.png' : 'icons/orderDetails/arrowUp.png'"
                   width="37px" height="37px" class="filters_backButtonImg"/>
        </button>
      </div>

      <div class="filters_content" v-show="showFilters">
        <div class="row row--alignStart row--alignBaseline row--gap16">
          <InputFilterDatepicker :disable-year-select="false" :label="'Dodano od'" @change="searchParams.dodano_od = $event"
                                 :value="searchParams.dodano_od"/>
          <InputFilterDatepicker :disable-year-select="false" :label="'Dodano do'" @change="searchParams.dodano_do = $event"
                                 :value="searchParams.dodano_do"/>
          <InputFilterSelect :label="'Zrealizowane'" :options="statusPaymentOptions"
                             @change="searchParams.zrealizowane = $event" :base-value="searchParams.zrealizowane"/>
          <InputFilterSelect :label="'Marketplace'" :options="marketplaces"
                             @change="searchParams.marketplace = $event" :base-value="searchParams.marketplace"/>

        </div>
        <div class="filters_contentButtonsContainer">
          <button class="filters_buttonPrimary" @click="fetchWithFilters">Szukaj</button>
          <button class="filters_buttonSecondary" v-show="Object.values(searchParams).length > 0" @click="clearFilters">
            Wyczyść filtry
          </button>
        </div>
      </div>
    </div>
  </div>
  <Table :use-checkbox="false" :table-headers="tableHeaders"/>
</template>

<style scoped>

</style>