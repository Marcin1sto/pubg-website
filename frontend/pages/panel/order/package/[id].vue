<template>
  <FormSearchPackage>
    <template #rightAction>
      <nuxt-link-locale :to="{name: 'panel-order-id', params: { id: Order.cart_id }}" class="orderDetails_backButton">
        <NuxtImg src="icons/orderDetails/arrowLeft.png" width="37px" height="37px" class="orderDetails_backButtonImg"/>
        Wróć do zamówienia
      </nuxt-link-locale>
    </template>
  </FormSearchPackage>

  <div class="orderDetails_container">
    <div class="orderDetails_card">
      <div class="orderDetails_content">
        <div class="row row--column">
          <span class="orderDetails_subtitle">Numer przesyłki</span>
          <h2 class="orderDetails_title">{{ ApiRequest.waybill_no ?? 'Brak numeru' }}</h2>
          <button v-if="ApiRequest.waybill_no" @click="copyToClipboard" class="orderDetails_smallLink">Skopiuj numer</button>
        </div>

        <div class="row">
          <span class="orderDetails_text orderDetails_text--bigMarginBottom">Zamówienie z dnia {{
              Order.created
            }}</span>
        </div>

        <div class="row">
          <div class="orderDetails_linksContainer">
            <InputDownloadDropdown :options="downloadOptions"/>
          </div>
        </div>

        <div class="row row--orderDetails">
          <span class="orderDetails_text orderDetails_text--mediumMarginBottom">{{ Courier.additional_desc }}</span>
        </div>

        <div class="row row--orderDetails">
          <div class="orderDetails_column">
            <h3 class="orderDetails_subtitle">Dane nadawcy</h3>
            <span class="orderDetails_text">{{ Order.name }}</span>
            <span class="orderDetails_text">{{ Order.vat_name }}</span>
            <span class="orderDetails_text">{{ Order.street }} {{
                Order.house_no
              }}{{ Order.locum_no ? '/ ' + Order.locum_no : '' }}</span>
            <span class="orderDetails_text">{{ Order.postal }} {{ Order.city }}</span>
            <span class="orderDetails_text">{{ Order.phone }}</span>
            <span class="orderDetails_text orderDetails_text--mediumMarginBottom">{{ Order.email }}</span>
            <span class="orderDetails_text">{{ Order.pickup_name }}</span>
            <span class="orderDetails_text" v-if="Order.pickup_street">{{ Order.pickup_street }} {{
                Order.pickup_house_no
              }}{{ Order.pickup_locum_no ? '/ ' + Order.pickup_locum_no : '' }}, {{
                Order.pickup_postal
              }} {{ Order.pickup_city }}</span>
          </div>

          <div class="orderDetails_column v-col-3">
            <h3 class="orderDetails_subtitle orderDetails_subtitle--bigMarginBottom">Dane odbiorcy</h3>
            <span class="orderDetails_text">{{ Order.taker_name }}</span>
            <span class="orderDetails_text">{{ Order.taker_vat_company }}</span>
            <span class="orderDetails_text">{{ Order.taker_street }} {{
                Order.taker_house_no
              }}{{ Order.taker_locum_no ? '/ ' + Order.taker_locum_no : '' }}</span>
            <span class="orderDetails_text">{{ Order.taker_postal }} {{ Order.taker_city }}</span>
            <span class="orderDetails_text">{{ Order.taker_phone }}</span>
            <span class="orderDetails_text">{{ Order.taker_email }}</span>
          </div>

          <div class="orderDetails_column">
            <h3 class="orderDetails_subtitle orderDetails_subtitle--bigMarginBottom">Szczegóły przesyłki</h3>
            <span class="orderDetails_text">
              <span class="orderDetails_textColumnHeader">Rodzaj przesyłki:</span>
              <span class="orderDetails_textColumnContent">{{ CourierSearch.type }}</span>
            </span>
            <span class="orderDetails_text">
              <span class="orderDetails_textColumnHeader">Wymiary:</span>
              <span class="orderDetails_textColumnContent">{{ Order.sizes }}</span>
            </span>
            <span class="orderDetails_text">
              <span class="orderDetails_textColumnHeader">Waga:</span><span
                class="orderDetails_textColumnContent">{{ CourierSearch.weight }} kg</span>
            </span>
            <span class="orderDetails_text">
              <span class="orderDetails_textColumnHeader">Zawartość:</span><span
                class="orderDetails_textColumnContent">{{ Order.package_content }}</span>
            </span>
            <span class="orderDetails_text orderDetails_text--bigMarginBottom">
              <span class="orderDetails_textColumnHeader">Anulowana: </span><span
                class="orderDetails_textColumnContent">{{ convertToBoolean(Order.cancelled) ? 'Tak' : 'Nie' }}</span>
            </span>
            <span class="orderDetails_text orderDetails_text--bigMarginBottom">
              <span class="orderDetails_textColumnHeader">Status: </span><span
                class="orderDetails_textColumnContent">{{LastTrackingStatus[Object.keys(LastTrackingStatus)[0]]?.courier_tracking_status?.status_desc}}</span>
            </span>
          </div>

          <div class="orderDetails_column" v-if="Object.values(Uptake).length > 0 && Object.values(Uptake).filter((value) => value !== null).length > 0">
            <h3 class="orderDetails_subtitle orderDetails_subtitle--bigMarginBottom">Pobranie</h3>
            <span class="orderDetails_text">
            <span class="orderDetails_textColumnHeader">Kwota pobrania:</span><span
                class="orderDetails_textColumnContent">{{ Uptake.value }} {{ Uptake.currency}}</span>
            </span>
            <span class="orderDetails_text">
              <span class="orderDetails_textColumnHeader">Zwrot na: </span>
              <span class="orderDetails_textColumnContent">{{ Uptake.uptake_type_desc }}</span>
            </span>
            <span class="orderDetails_text">
              <span class="orderDetails_textColumnHeader">Nr konta:</span><span
                class="orderDetails_textColumnContent">{{ Uptake.uptake_type === 'bank' ? Order.account : ''}}</span>
            </span>
            <span class="orderDetails_text orderDetails_text--bigMarginBottom">
              <span class="orderDetails_textColumnHeader">Aktualny status</span><span
                class="orderDetails_textColumnContent">{{ Uptake.status }}</span>
            </span>
          </div>

          <div class="orderDetails_column">
            <h3 class="orderDetails_subtitle">Usługi dodatkowe</h3>
            <span class="orderDetails_text">
              <span class="orderDetails_textColumnHeader">Ubezpieczenie:</span>
              <span class="orderDetails_textColumnContent">{{ CourierSearch?.cover ? CourierSearch.cover : '0.00' }} zł</span>
            </span>
          </div>

          <div class="orderDetails_column" v-if="Order.pickup_id || Order.pickup_external_id">
            <h3 class="orderDetails_subtitle orderDetails_subtitle--bigMarginBottom">Dane pickup</h3>
            <span class="orderDetails_text">
            <span class="orderDetails_textColumnHeader">Numer zlecenia:</span>
              <span class="orderDetails_textColumnContent">{{ Order.pickup_id ?? Order.pickup_external_id }}</span>
            </span>
            <span class="orderDetails_text">
              <span class="orderDetails_textColumnHeader">Data odbioru:</span>
              <span class="orderDetails_textColumnContent">{{ Order.pickup_date }}</span>
            </span>
            <span class="orderDetails_text">
              <span class="orderDetails_textColumnHeader">Godziny odbioru:</span>
              <span class="orderDetails_textColumnContent">{{ Order.pickup_ready_time }}:{{Order.pickup_ready_time_minute	}} - {{ Order.pickup_close_time }}:{{Order.pickup_close_time_minute }} </span>
            </span>
          </div>
        </div>
      </div>

      <div v-if="Parcels.length > 0" class="orderDetails_content">
        <h3>Lista paczek</h3>
      </div>
      <Table v-if="Parcels.length > 0" :use-pagination="false" :use-store="true" :use-checkbox="false" :table-items="tableItems" :table-headers="tableHeaders">
        <template #additional>
          <div class="table_buttonWrapper">
         <span class="orderDetails_text" style="gap: 16px">
            <button @click.prevent="downloadWaybills" v-if="ApiRequest.waybill_no" class="filters_buttonSecondary" >Pobierz etykiety</button>
<!--            <button @click.prevent="showCancelModal = true" v-if="!convertToBoolean(Order.cancelled) && CartOrder.payed" class="filters_buttonDelete" >Anuluj paczkę</button>-->
          </span>
          </div>
        </template>
      </Table>

      <div class="row row--orderForm orderDetails_footer">
        <nuxt-link-locale :to="{ name: 'panel-order-id', params: { id: Order.cart_id }}" class="orderDetails_buttonSecondary">Wróć do zamówienia
        </nuxt-link-locale>
        <button @click.prevent="showCancelModal = true" v-if="canBeCancelled.status" class="orderDetails_buttonError" >Anuluj paczkę</button>
      </div>
    </div>
  </div>

  <Teleport to="body">
    <Modal :show="showCancelModal" @close="showCancelModal = false">
      <template #header>
        <h1 class="modal_title">Czy napewno chcesz anulować zamówienie?</h1>
      </template>
      <template #body>
        <div class="orderForm_summaryModalButtonsContainer">
          <button class="orderForm_buttonGhost" @click.prevent="showCancelModal = false">Nie</button>
          <button class="orderForm_buttonPrimary" @click.prevent="tryCancelOrder">Tak</button>
        </div>
      </template>
    </Modal>
  </Teleport>
</template>

<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import useOrderStore from "~/stores/panel/useOrderStore";
import useDownload from "~/composables/useDownload";
import {useTableStore} from "~/stores/useTableStore";

const {t} = useI18n();
const { getOrder, cancelOrder } = useOrderStore();
const { order, cancelOrderProcessing } = storeToRefs(useOrderStore());
const router = useRouter();
let { download } = useDownload();
const { setPageValues } = usePageStore();
const { successMessage, successMessageShow, errorMessage, errorMessageShow } = storeToRefs(usePageStore());
const { bodyTypes, actionsTypes, setHeaders, setItems } = useTableStore();
const { formatApiGetRoute } = useApiRoutes();
const showCancelModal = ref(false);
const Order = ref({});
const CartOrder = ref({});
const ApiRequest = ref({});
const CourierSearch = ref({});
const Uptake = ref({});
const Urls = ref({});
const Parcels = ref([]);
const canBeCancelled = ref([]);
const LastTrackingStatus = ref([]);
const Courier = ref([]);

await getOrder(router.currentRoute.value.params.id);
Order.value = order.value.Order ?? {};
CartOrder.value = order.value.CartOrder ?? {};
ApiRequest.value = order.value.ApiRequest ?? {};
CourierSearch.value = order.value.CourierSearch ?? {};
Uptake.value = order.value.Uptake ?? {};
Urls.value = order.value.Urls ?? {};
Parcels.value = order.value.parcels ?? [];
canBeCancelled.value = order.value.canBeCancelled ?? {};
LastTrackingStatus.value = order.value.LastTrackingStatus ?? {};
Courier.value = order.value.Courier ?? {};

const tableHeaders = [
  { key: 'lpItem', label: t('order.table.lpItem'), sortable: true},
  { key: 'weight', label: t('order.table.weight'), sortable: true},
  { key: 'side_x', label: t('order.table.side_x'), sortable: true },
  { key: 'side_y', label: t('order.table.side_y'), sortable: true },
  { key: 'side_z', label: t('order.table.side_z'), sortable: true },
];
setHeaders(tableHeaders);

let lpItem = 1;
const tableItems = Parcels.value.map((parcel) => {
  const Parcel = parcel.SearchParcel;

  return {
    canSelect: false,
    lpItem: {type: bodyTypes.TEXT, content: lpItem++},
    weight: {type: bodyTypes.TEXT, content: Parcel.weight + ' cm'},
    side_x: {type: bodyTypes.TEXT, content: Parcel.side_x + ' cm'},
    side_y: {type: bodyTypes.TEXT, content: Parcel.side_y + ' cm'},
    side_z: {type: bodyTypes.TEXT, content: Parcel.side_z + ' cm'},
  }
});
setItems(tableItems);

const copyToClipboard = async () => {
  try {
    await navigator.clipboard.writeText(ApiRequest.value.waybill_no);
  } catch (error) {
    console.error('Nie udało się skopiować tekstu:', error);
    alert('Nie udało się skopiować tekstu. Sprawdź konsolę dla szczegółów.');
  }
}

const downloadWaybills = async () => {
  let route = formatApiGetRoute('cartOrder.waybills', {});
  await download(route, 'test.pdf', 'POST', true, {
    order_ids: [Order.value.id]
  });
}

const tryCancelOrder = async () => {
  if (cancelOrderProcessing.value) {
    return;
  }

  let result = await cancelOrder(Order.value.id);

  if (result) {
    showCancelModal.value = false;
    await getOrder(router.currentRoute.value.params.id);
    successMessageShow.value = true;
    errorMessageShow.value = false;
    successMessage.value = {
      title: 'Anulowano',
      message: 'Zamówienie zostało anulowane'
    }

    Order.value.cancelled = true;
  } else {
    successMessageShow.value = false;
    errorMessageShow.value = true;
    errorMessage.value = {
      title: 'Uwaga',
      message: 'Nie udało się anulować zamówienia'
    }
  }
}

useHead({
  title: t('page.panel.order.title')
});

const downloadOptions = Object.values(order.value.Urls).map((url) => {
  return {
    url: url.url,
    fileName: url.fileName,
    name: url.fileName
  }
})

const convertToBoolean = (value) => {
  return value !== '0';
}

setPageValues(
    t('page.panel.order.package-details.title'),
);

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>