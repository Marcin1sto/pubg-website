<template>
  <div class="form_filters">
    <div class="filters_container">
      <div class="filters_row filters_row--mobile">
          <span class="filters_searchInputContainer filters_searchInputContainer--mobile">
            <input type="text" placeholder="Wpisz numer zamówienia" :value="searchParams.numer"
                   class="filters_searchInput" @change="searchParams.numer = $event.target.value">
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
          <div class="form_inputContainer300">
            <label class="form_label">Numer listu przewozowego</label>
            <div class="form_inputWithUnit form_inputWithUnit--noMargin form_inputWithUnit--wrap">
              <input type="text" id="package_content" name="nr_listu_przewozowego" class="form_inputTxt form_inputTxt--withoutUnit"
                     v-model="searchParams.nr_listu_przewozowego"
                     @change="searchParams.nr_listu_przewozowego = $event.target.value"
                     placeholder="Wpisz numer listu przewozowego"
              >
            </div>
          </div>
          <InputFilterDatepicker :disable-year-select="false" :label="'Dodano od'" @change="searchParams.dodano_od = $event"
                                 :value="searchParams.dodano_od"/>
          <InputFilterDatepicker :disable-year-select="false" :label="'Dodano do'" @change="searchParams.dodano_do = $event"
                                 :value="searchParams.dodano_do"/>
          <InputFilterSelect :label="'Status płatności'" :options="statusPaymentOptions"
                             @change="searchParams.status = $event" :base-value="searchParams.status"/>
          <InputFilterSelect :label="'Typ płatności'" :options="paymentsOptions"
                             @change="searchParams.platnosc = $event" :base-value="searchParams.platnosc"/>

          <div class="form_inputContainer300">
            <label class="form_label">Odbiorca</label>
            <div class="form_inputWithUnit form_inputWithUnit--noMargin form_inputWithUnit--wrap">
              <input type="text" id="package_content" name="nazwa_odbiorcy" class="form_inputTxt form_inputTxt--withoutUnit"
                     placeholder="Wpisz nazwę odbiorcy ( Imię i Nazwisko )"
                 v-model="searchParams.nazwa_odbiorcy"
                @change="searchParams.nazwa_odbiorcy = $event.target.value"
              >
            </div>
          </div>
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
    <template #statistics>
      <p>Suma kosztów: {{ sumOrders }} zł</p>
    </template>
    <template #additional>
      <div class="table_buttonWrapper">
        <button class="filters_buttonSecondary"
          :class="countSelectedItems === 0 ? 'filters_buttonSecondary--notActive' : ''"
          @click.prevent="downloadList"
        >
          Pobierz zestawienie
        </button>
        <button class="filters_buttonSecondary"
          :class="countSelectedItems === 0 ? 'filters_buttonSecondary--notActive' : ''"
          @click.prevent="printList"
        >
          Drukuj zestawienie
        </button>
        <button class="filters_buttonSecondary"
                :class="countSelectedItems === 0 ? 'filters_buttonSecondary--notActive' : ''"
                @click.prevent="downloadWaybills"
        >
          Pobierz etykiety
        </button>
        <button class="filters_buttonSecondary"
          :class="countSelectedItems === 0 ? 'filters_buttonSecondary--notActive' : ''"
          @click.prevent="printWaybills"
        >
          Drukuj etykiety
        </button>
        <button class="filters_buttonSecondary"
                :class="countSelectedItems === 0 ? 'filters_buttonSecondary--notActive' : ''"
                @click.prevent="downloadXlsx"
        >
          Pobierz raport
        </button>
      </div>
    </template>
  </Table>
</template>

<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import useCartOrderStore from "~/stores/panel/useCartOrderStore";
import {useTableStore} from "~/stores/useTableStore";
import VueDatePicker from "@vuepic/vue-datepicker";
import '@vuepic/vue-datepicker/dist/main.css'
import {ref} from "vue";
import {opt} from "ts-interface-checker";
import useDownload from "~/composables/useDownload";
import printJS from "print-js-updated";

const {t} = useI18n();
const {setPageValues} = usePageStore();

const statusPaymentOptions = [
  {name: 'Wszystkie', code: ''},
  {name: 'Opłacone', code: '1'},
  {name: 'Nieopłacone', code: '0'},
]

onMounted(() => {
  page.value = 1;
})

setPageValues(
    t('page.panel.order.title'),
    true
);

const tableHeaders = [
  {key: 'id_prefix', label: t('order.table.id_prefix'), sortable: true},
  {key: 'order_at', label: t('order.table.order_at'), sortable: true},
  {key: 'package_count', label: t('order.table.package_count'), sortable: true},
  {key: 'sum_price_brut', label: t('order.table.sum_price_brut'), sortable: true},
  {key: 'payment_form', label: t('order.table.payment_form'), sortable: true},
  {key: 'status', label: t('order.table.status'), sortable: true},
  {key: 'actions', label: t('order.table.actions'), sortable: false},
];
const {getCartOrders, fetchPaymentTypes} = useCartOrderStore();
const {tableItems, searchParams, payments, sumOrders} = storeToRefs(useCartOrderStore());
const {setItems, setHeaders, startLoadingAsyncData} = useTableStore();
const {countSelectedItems, selectedItems, items, childHeaders} = storeToRefs(useTableStore());
let {download, print} = useDownload();

const paymentsOptions = ref([]);

watch(() => payments.value, (newValue) => {
  Object.keys(newValue).forEach((payment: any, key) => {
    if (payment !== undefined && key !== undefined) {
      paymentsOptions.value.push({name: newValue[payment], code: payment})
    }
  })
})

const showFilters = ref(true);
watch(searchParams, (newValue) => {
  if (newValue === '') {
    clearFilters();
    return;
  }

  asyncData();
}, {deep: true});

const {formatApiGetRoute} = useApiRoutes();

const printList = async () => {
  if (countSelectedItems.value === 0) return;

  let idsArray = [];
  selectedItems.value.forEach((item: any) => {
    let items = item.id.trim().split(',');
    items = items.filter((item: any) => item !== '');
    items.forEach((item: any) => {
      idsArray.push(item);
    });
  });


  let route = formatApiGetRoute('cartOrder.printList', {});
  await print(route, '', 'POST', true, {
    cart_ids: idsArray,
    format: "LBL"
  });
}

const downloadList = async () => {
  if (countSelectedItems.value === 0) return;

  let idsArray = [];
  selectedItems.value.forEach((item: any) => {
    let items = item.id.trim().split(',');
    items = items.filter((item: any) => item !== '');
    items.forEach((item: any) => {
      idsArray.push(item);
    });
  });

  let route = formatApiGetRoute('cartOrder.printList', {});
  await download(route, '', 'POST', true, {
    cart_ids: idsArray,
    format: "LBL"
  });
}

const downloadXlsx = async () => {
  if (countSelectedItems.value === 0) return;

  const ids = selectedItems.value.map((item: any) => item.id);
  let idsParams = ids.join(',');
  let route = formatApiGetRoute('cartOrder.report', {ids: idsParams});
  await download(route, 'raport_zbiorczy_' + getDateForFile() + '.xlsx', 'GET', true);
}

const downloadWaybills = async () => {
  if (countSelectedItems.value === 0) return;

  let idsArray = [];
  selectedItems.value.forEach((item: any) => {
    let items = item.order_ids.trim().split(',');
    items = items.filter((item: any) => item !== '');
    items.forEach((item: any) => {
      idsArray.push(item);
    });
  });

  let route = formatApiGetRoute('cartOrder.waybills', {});
  await download(route, '', 'POST', true, {
    order_ids: idsArray
  });
}
const printWaybills = async () => {
  if (countSelectedItems.value === 0) return;

  let idsArray = [];
  selectedItems.value.forEach((item: any) => {
    let items = item.order_ids.trim().split(',');
    items = items.filter((item: any) => item !== '');
    items.forEach((item: any) => {
      idsArray.push(item);
    });
  });

  let route = formatApiGetRoute('cartOrder.waybills', {});
  await print(route, 'test.pdf', 'POST', true, {
    order_ids: idsArray,
    format: "LBL"
  });
}

const getDateForFile = () => {
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0');
  const day = String(now.getDate()).padStart(2, '0');
  const hours = now.getHours();
  const minutes = String(now.getMinutes()).padStart(2, '0');

  return `${year}_${month}_${day}_${hours}:${minutes}`;
}


const {page} = storeToRefs(useTableStore());
let unwatchOrdersPage = watch(page, (newValue) => {
  searchParams.value.page = newValue;
  asyncData();
});

onBeforeRouteLeave((to, from, next) => {
  unwatchOrdersPage();
  next();
});

const clearFilters = async () => {
  searchParams.value = {};
  await getCartOrders();
  await setItems(tableItems.value);
}

const fetchWithFilters = async () => {
  startLoadingAsyncData();
  await getCartOrders();
  await setItems(tableItems.value);
}

await fetchPaymentTypes();

const asyncData = async () => {
  startLoadingAsyncData();
  await getCartOrders();
  await setItems(tableItems.value);
};

onBeforeMount(async () => {
  setHeaders(tableHeaders);
});

onMounted(async () => {
  await asyncData();

  childHeaders.value = {
    empty: { content: '' },
    id_prefix: { content: t('order.table.id_prefix')},
    order_at: { content: t('order.table.order_at')},
    order_no: {  content: t('order.table.order_no') },
    address: { content: t('order.table.address') },
    price_brut: { content: t('order.table.price_brut') },
  }
});

useHead({
  title: t('page.panel.order.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>