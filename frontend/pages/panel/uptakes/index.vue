<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import useUptakesStore from "~/stores/panel/useUptakesStore";
import {useTableStore} from "~/stores/useTableStore";
import {ref} from "vue";
import {useDownload} from "#imports";

const { t } = useI18n();
const { setPageValues } = usePageStore();
setPageValues(
    t('page.panel.finances.uptakes.title'),
    true
);

const tableHeaders = [
  {key: 'created', label: t('uptake.table.created'), sortable: true},
  {key: 'value', label: t('uptake.table.value'), sortable: true},
  {key: 'seizure', label: t('uptake.table.seizure'), sortable: true},
  {key: 'seizure_comment', label: t('uptake.table.seizure_comment'), sortable: true},
  {key: 'cart_id', label: t('uptake.table.cart_id'), sortable: true},
  {key: 'waybill_no', label: t('uptake.table.waybill_no'), sortable: true},
  {key: 'courier_name', label: t('uptake.table.courier_name'), sortable: true},
  {key: 'package_content', label: t('uptake.table.package_content'), sortable: true},
  {key: 'status', label: t('uptake.table.status'), sortable: true},
  {key: 'days_to_return_left', label: t('uptake.table.days_to_return_left'), sortable: true},
  {key: 'actions', label: t('uptake.table.actions'), sortable: true},
];

const { getUptakes, fetchUptakeStatuses } = useUptakesStore();
const { tableItems, searchParams, uptakeStatuses } = storeToRefs(useUptakesStore());
const { setItems, setHeaders, startLoadingAsyncData } = useTableStore();
const { countSelectedItems, selectedItems } = storeToRefs(useTableStore());
const { formatApiGetRoute } = useApiRoutes();
const { download } = useDownload();
const  route = useRoute();

const uptakeStatusesOptions = ref([]);
watch(() => uptakeStatuses.value, (newValue) => {
  Object.keys(newValue).forEach((uptakeStatus: any, key) => {
    if (uptakeStatus !== undefined && key !== undefined) {
      uptakeStatusesOptions.value.push({name: newValue[uptakeStatus], code: uptakeStatus})
    }
  })
});

const downloadXlsx = async () => {
  let route = formatApiGetRoute('uptake.download', searchParams.value);
  await download(route, '', 'GET', true);
}

const asyncData = async () => {
  if (Object.values(route.query).length) {
    searchParams.value = route.query;
  }

  await setHeaders(tableHeaders)
  startLoadingAsyncData();
  await getUptakes();
  await setItems(tableItems.value);
};

await fetchUptakeStatuses();
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
  await getUptakes();
  await setItems(tableItems.value);
}

const { page } = storeToRefs(useTableStore());
let unwatchUptakesPage = watch(page, (newValue) => {
  // searchParams.value.page = newValue;
  asyncData();
});

onMounted(() => {
  page.value = 1;
});

onBeforeRouteLeave((to, from, next) => {
  unwatchUptakesPage();
  next();
});


const fetchWithFilters = async () => {
  startLoadingAsyncData();
  await getUptakes();
  await setItems(tableItems.value);
}

useHead({
  title: t('page.panel.finances.uptakes.title')
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
            <input type="text" placeholder="Szczegóły przesyłki" :value="searchParams.search_string" class="filters_searchInput" @change="searchParams.search_string = $event.target.value">
            <button><NuxtImg src="icons/orderDetails/search.png" width="21px" height="21px" class="filters_searchButton"/></button>
          </span>
        <button class="orderDetails_backButton" @click="showFilters = !showFilters">{{ showFilters ? 'Ukryj' : 'Pokaż'}} filtry<NuxtImg :src="!showFilters ? 'icons/orderDetails/arrowDown.png' : 'icons/orderDetails/arrowUp.png'" width="37px" height="37px" class="filters_backButtonImg"/></button>
      </div>

      <div class="filters_content" v-show="showFilters">
        <div class="row row--alignStart row--alignBaseline row--gap16">
          <InputFilterDatepicker :disable-year-select="false" :label="'Wystawiono od'" @change="searchParams.from = $event" :value="searchParams.from"/>
          <InputFilterDatepicker :disable-year-select="false" :label="'Wystawiono do'" @change="searchParams.to = $event" :value="searchParams.to"/>
          <InputFilterSelect :label="'Status pobrania'" :options="uptakeStatusesOptions" @change="searchParams.status_id = $event" :base-value="searchParams.status_id"/>
        </div>
        <div class="filters_contentButtonsContainer">
          <button class="filters_buttonPrimary" @click="fetchWithFilters">Szukaj</button>
          <button class="filters_buttonSecondary" v-show="Object.values(searchParams).length > 0" @click="clearFilters">Wyczyść filtry</button>
        </div>
      </div>
    </div>
  </div>
  <Table :use-checkbox="true">
    <template #additional>
      <div class="table_buttonWrapper">
        <button class="filters_buttonSecondary"
                @click.prevent="downloadXlsx">
          Pobierz raport
        </button>
      </div>
    </template>
  </Table>
</template>
