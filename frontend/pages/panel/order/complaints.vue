<template>
  <div class="form_filters">
    <div class="filters_container">
      <div class="filters_row">
          <span class="filters_searchInputContainer">
            <input type="text" placeholder="Wpisz numer listu przewozowego" :value="searchParams.waybill_no" class="filters_searchInput" @change="searchParams.waybill_no = $event.target.value">
            <button><NuxtImg src="icons/orderDetails/search.png" width="21px" height="21px" class="filters_searchButton"/></button>
          </span>
        <button class="orderDetails_backButton" @click="showFilters = !showFilters">{{ showFilters ? 'Ukryj' : 'Pokaż'}} filtry<NuxtImg :src="!showFilters ? 'icons/orderDetails/arrowDown.png' : 'icons/orderDetails/arrowUp.png'" width="37px" height="37px" class="filters_backButtonImg"/></button>
      </div>

      <div class="filters_content" v-show="showFilters">
        <div class="row row--alignStart row--alignBaseline row--gap16">
          <InputFilterDatepicker :disable-year-select="false" :label="'Dodano od'" @change="searchParams.date_from = $event" :value="searchParams.date_from"/>
          <InputFilterDatepicker :disable-year-select="false" :label="'Dodano do'" @change="searchParams.date_to = $event" :value="searchParams.date_to"/>
          <InputFilterSelect :label="'Status reklamacji'" :options="complaintStatusesOptions" @change="searchParams.complaint_status = $event" :base-value="searchParams.complaint_status"/>
          <InputFilterSelect :label="'Powód reklamacji'" :options="complaintTypesOptions" @change="searchParams.complaint_type = $event" :base-value="searchParams.complaint_type"/>
        </div>

        <div class="filters_contentButtonsContainer">
          <button class="filters_buttonPrimary" @click="fetchWithFilters">Szukaj</button>
          <button class="filters_buttonSecondary" v-show="Object.values(searchParams).length > 0" @click="clearFilters">Wyczyść filtry</button>
        </div>
      </div>
    </div>
  </div>
  <Table :use-checkbox="false" v-if="isTableValue"/>
  <div class="row row--centered" v-else>
    <p class="complaints_info">Aby złożyć pierwszą reklamację przejdź do zakładki <NuxtLink to="https://blpaczka.com/panel/order/package">Historia Paczek</NuxtLink></p>
  </div>
</template>

<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import useComplaintsStore from "~/stores/panel/useComplaintsStore";
import {useTableStore} from "~/stores/useTableStore";
import {ref} from "vue";

const { t } = useI18n();
const { setPageValues } = usePageStore();

const tableHeaders = [
  { key: 'waybill_no', label: t('complaints.table.waybill_no'), sortable: true},
  { key: 'created_at', label: t('complaints.table.created_at'), sortable: true},
  { key: 'reason', label: t('complaints.table.reason'), sortable: true},
  { key: 'status', label: t('complaints.table.status'), sortable: true},
];

const { getComplaints, fetchComplaintTypes, fetchComplaintStatuses } = useComplaintsStore();
const { tableItems, searchParams, complaintTypes, complaintStatuses } = storeToRefs(useComplaintsStore());
const { setItems, setHeaders, startLoadingAsyncData } = useTableStore();
const isTableValue = ref(false);

await fetchComplaintTypes();
await fetchComplaintStatuses();

const asyncData = async () => {
  startLoadingAsyncData();
  await getComplaints();
  await setHeaders(tableHeaders)
  await setItems(tableItems.value);
};
const complaintTypesOptions = ref([]);
const complaintStatusesOptions = ref([]);
const { page } = storeToRefs(useTableStore());

watch(() => tableItems.value, (newValue) => {
  if (newValue.length > 0) {
    isTableValue.value = true;
  }
});

onMounted(async () => {
  await asyncData();
  page.value = 1;

  Object.keys(complaintTypes.value).forEach((type: any, key) => {
    if (type !== undefined && key !== undefined) {
      complaintTypesOptions.value.push({name: complaintTypes.value[type], code: type})
    }
  })

  Object.keys(complaintStatuses.value).forEach((status: any, key) => {
    if (status !== undefined && key !== undefined) {
      complaintStatusesOptions.value.push({name: complaintStatuses.value[status], code: status})
    }
  })
});

let unwatchComplaintsPage = watch(page, (newValue) => {
  searchParams.value.page = newValue;
  asyncData();
});

onBeforeRouteLeave((to, from, next) => {
  unwatchComplaintsPage();
  next();
});

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
  await getComplaints();
  await setItems(tableItems.value);
}

const fetchWithFilters = async () => {
  startLoadingAsyncData();
  await getComplaints();
  await setItems(tableItems.value);
}

setPageValues(
    t('page.panel.order.complaints.title'),
    true,
);

useHead({
  title: t('page.panel.order.complaints.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<style scoped>
.complaints_info {
  font-family: Open Sans;
  font-size: 20px;
  font-weight: 700;
  line-height: 22px;
  margin: 64px 0 16px;
  color: #262B44;

  a {
    font-family: Open Sans;
    font-size: 20px;
    font-weight: 700;
    line-height: 22px;
    color: #262B44;
  }
}
</style>