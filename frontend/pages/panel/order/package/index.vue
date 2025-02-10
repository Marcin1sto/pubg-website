<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import {useTableStore} from "~/stores/useTableStore";
import useOrderStore from "~/stores/panel/useOrderStore";
import useDownload from "~/composables/useDownload";

const {t} = useI18n();
const {setPageValues} = usePageStore();
const { page, countSelectedItems, selectedItems } = storeToRefs(useTableStore());
const {setItems, setHeaders, startLoadingAsyncData} = useTableStore();
const { getOrders, getCouriers, cancelOrder } = useOrderStore();
const { searchParams, tableItems, couriers, cancelOrderModal, cancelOrderProcessing, selectedId, complaintOrderModal, order } = storeToRefs(useOrderStore());
const {formatApiGetRoute} = useApiRoutes();
let {download, print} = useDownload();

const tableHeaders = [
  {key: 'taker', label: t('packages.table.taker'), sortable: true},
  {key: 'courier', label: t('packages.table.courier'), sortable: true},
  {key: 'created', label: t('packages.table.created'), sortable: true},
  {key: 'uptake', label: t('packages.table.uptake'), sortable: true},
  {key: 'waybill_no', label: t('packages.table.waybill_no'), sortable: true},
  {key: 'status', label: t('packages.table.status'), sortable: true},
  {key: 'actions', label: t('packages.table.actions'), sortable: false},
]

onBeforeMount(async () => {
  setHeaders(tableHeaders);
});

const clearFilters = async () => {
  searchParams.value = {};
  await getOrders(true);
  await setItems(tableItems.value);
}

const fetchWithFilters = async () => {
  startLoadingAsyncData();
  await getOrders(true);
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
  await getOrders(true);
}

const couriersOptions = ref([]);

onMounted(async () => {
  await asyncData();
  page.value = 1;

  couriersOptions.value = Object.entries(couriers.value).map(([key, value]) => ({
    code: key,
    name: value
  }));

  couriersOptions.value.sort((a, b) => a.name.localeCompare(b.name));
})


const statusPaymentOptions = [
  {name: 'Wszystkie', code: ''},
  {name: 'Tak', code: '1'},
  {name: 'Nie', code: '0'},
]

const downloadWaybills = async () => {
  if (countSelectedItems.value === 0) return;

  let idsArray = [];
  selectedItems.value.forEach((item: any) => {
    idsArray.push(item.id);
  });

  let route = formatApiGetRoute('cartOrder.waybills', {});
  await download(route, '', 'POST', true, {
    order_ids: idsArray,
    format: "LBL"
  });
}

useHead({
  title: t('page.panel.package.title')
});

setPageValues(
    t('page.panel.package.title'),
    true
);

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})

const showFilters = ref(true);
const { successMessage, successMessageShow, errorMessage, errorMessageShow } = storeToRefs(usePageStore());
const tryCancelOrder = async () => {
  if (cancelOrderProcessing.value) {
    return;
  }

  let result = await cancelOrder(selectedId.value);

  if (result) {
    cancelOrderModal.value = false;
    successMessageShow.value = true;
    errorMessageShow.value = false;
    successMessage.value = {
      title: 'Anulowano',
      message: 'Zamówienie zostało anulowane'
    }
    let actions = tableItems.value.find((item: any) => item.id === selectedId.value).actions.content;
    actions.find((action: any) => action?.functionName == 'showCancelModal').disabled = true;
    actions.find((action: any) => action?.functionName == 'createComplaint').disabled = true;

    setTimeout(() => {
      successMessageShow.value = false;
      successMessage.value = { title: '', message: '' };
    }, 10000);

  } else {
    successMessageShow.value = false;
    errorMessageShow.value = true;
    errorMessage.value = {
      title: 'Uwaga',
      message: 'Nie udało się anulować zamówienia'
    }
  }
}
</script>

<template>
  <div class="form_filters">
    <div class="filters_container">
      <div class="filters_row">
          <span class="filters_searchInputContainer">
            <input type="text" placeholder="Wpisz numer paczki" :value="searchParams['numer-nazwa']"
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
          <InputFilterSelect :label="'Opłacone'" :options="statusPaymentOptions"
                             @change="searchParams.oplacone = $event" :base-value="searchParams.oplacone"/>
          <InputFilterSelect :label="'Zagranica'" :options="statusPaymentOptions"
                             @change="searchParams.zagranica = $event" :base-value="searchParams.zagranica"/>
          <InputFilterSelect :label="'Pobranie'" :options="statusPaymentOptions"
                             @change="searchParams.pobranie = $event" :base-value="searchParams.pobranie"/>
          <InputFilterSelect :label="'Kurier'" :options="couriersOptions"
                             @change="searchParams.kurier = $event" :base-value="searchParams.kurier"/>

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
  <Table :use-checkbox="true" :table-headers="tableHeaders">
    <template #additional>
      <div class="table_buttonWrapper">
        <button class="filters_buttonSecondary"
                :class="countSelectedItems === 0 ? 'filters_buttonSecondary--notActive' : ''"
                @click.prevent="downloadWaybills"
        >
          Pobierz etykiety
        </button>
      </div>
    </template>
  </Table>

  <Teleport to="body">
    <Modal :show="cancelOrderModal" @close="cancelOrderModal = false">
      <template #header>
        <h1 class="modal_title">Czy napewno chcesz anulować paczkę?</h1>
      </template>
      <template #body>
        <div class="orderForm_summaryModalButtonsContainer">
          <button class="orderForm_buttonGhost" @click.prevent="cancelOrderModal = false">Nie</button>
          <button class="orderForm_buttonPrimary" @click.prevent="tryCancelOrder">Tak</button>
        </div>
      </template>
    </Modal>
  </Teleport>

  <ModalCreateComplaint @hide="complaintOrderModal = false" @update:modal-visible="complaintOrderModal = $event" :show="complaintOrderModal" :modal-visible="complaintOrderModal" :order="order"/>
</template>

<style scoped>

</style>