<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import useUptakesStore from "~/stores/panel/useUptakesStore";
import {useTableStore} from "~/stores/useTableStore";
import useUptakeRefundStore from "~/stores/panel/useUptakeRefundStore";
import {ref} from "vue";

const { t } = useI18n();
const { setPageValues } = usePageStore();
setPageValues(
    t('page.panel.finances.uptakesRefund.title'),
    true
);

const tableHeaders = [
  {key: 'created', label: t('uptake.table.created'), sortable: true},
  {key: 'value', label: t('uptake.table.value'), sortable: true},
  {key: 'uptakes_count', label: t('uptake.table.count_uptakes'), sortable: true},
  {key: 'courier_name', label: t('uptake.table.courier'), sortable: true},
  {key: 'actions', label: t('uptake.table.actions'), sortable: true},
];

const { getRefunds } = useUptakeRefundStore();
const { tableItems, searchParams } = storeToRefs(useUptakeRefundStore());
const { setItems, setHeaders, startLoadingAsyncData } = useTableStore();

const asyncData = async () => {
  await setHeaders(tableHeaders)
  startLoadingAsyncData();
  await getRefunds();
  await setItems(tableItems.value);
};

await asyncData();
const showFilters = ref(true);

watch(searchParams, (newValue) => {
  if (newValue === '') {
    clearFilters();
    return;
  }

  asyncData();
}, { deep: true });

const clearFilters = async () => {
  searchParams.value = {};
  await getRefunds();
  await setItems(tableItems.value);
}

const { page } = storeToRefs(useTableStore());
let unwatchRefundsPage = watch(page, (newValue) => {
  searchParams.value.page = newValue;
  asyncData();
});

onMounted(() => {
  page.value = 1;
});

onBeforeRouteLeave((to, from, next) => {
  unwatchRefundsPage();
  next();
});

const fetchWithFilters = async () => {
  startLoadingAsyncData();
  await getRefunds();
  await setItems(tableItems.value);
}

useHead({
  title: t('page.panel.finances.uptakesRefund.title')
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
        <button class="orderDetails_backButton" @click="showFilters = !showFilters">
          {{ showFilters ? 'Ukryj' : 'Pokaż' }} filtry
          <NuxtImg :src="!showFilters ? 'icons/orderDetails/arrowDown.png' : 'icons/orderDetails/arrowUp.png'"
                   width="37px" height="37px" class="filters_backButtonImg"/>
        </button>
      </div>

      <div class="filters_content" v-show="showFilters">
        <div class="row row--alignStart row--alignBaseline row--gap16">
          <InputFilterDatepicker :disable-year-select="false" :label="'Wystawiono od'" @change="searchParams.dodano_od = $event" :value="searchParams.dodano_od"/>
          <InputFilterDatepicker :disable-year-select="false" :label="'Wystawiono do'" @change="searchParams.dodano_do = $event" :value="searchParams.dodano_do"/>
        </div>
        <div class="filters_contentButtonsContainer">
          <button class="filters_buttonPrimary" @click="fetchWithFilters">Szukaj</button>
          <button class="filters_buttonSecondary" v-show="Object.values(searchParams).length > 0" @click="clearFilters">Wyczyść filtry</button>
        </div>
      </div>
    </div>
  </div>
  <Table :use-checkbox="false" />
</template>

<style scoped>

</style>