<template>
  <FormSearchPackage>
    <template #rightAction>
      <nuxt-link-locale to="panel-order" class="orderDetails_backButton">
        <NuxtImg src="icons/orderDetails/arrowLeft.png" width="37px" height="37px" class="orderDetails_backButtonImg"/>
        Wróć do historii zamówień
      </nuxt-link-locale>
    </template>
  </FormSearchPackage>

  <div class="orderDetails_container">
    <div class="orderDetails_card">
      <div class="orderDetails_content">
        <div class="row row--column">
          <span class="orderDetails_subtitle">Numer zamówienia</span>
          <h2 class="orderDetails_title">{{ CartOrder.id ? `#${CartOrder.id}` : 'Brak numeru' }}</h2>
          <button v-if="CartOrder.id" @click="copyToClipboard" class="orderDetails_smallLink">Skopiuj numer</button>
        </div>

        <div class="row">
          <span class="orderDetails_text orderDetails_text--bigMarginBottom">Zamówienie z dnia {{
              CartOrder.created
            }}</span>
        </div>
        <div class="row" style="margin-bottom: 20px;">
          <a v-if="CartOrder.payment_url" :href="CartOrder?.payment_url" class="filters_buttonSecondary">Ponów płatność</a>
        </div>

        <div class="row row--orderDetails">
          <div class="orderDetails_column">
            <h3 class="orderDetails_subtitle">Dane nadawcy</h3>
            <span class="orderDetails_text">{{ FirstOrder.name }}</span>
            <span class="orderDetails_text">{{ FirstOrder.vat_name }}</span>
            <span class="orderDetails_text">{{ FirstOrder.street }} {{
                FirstOrder.house_no
              }}{{ FirstOrder.locum_no ? '/ ' + FirstOrder.locum_no : '' }}</span>
            <span class="orderDetails_text">{{ FirstOrder.postal }} {{ FirstOrder.city }}</span>
            <span class="orderDetails_text">{{ FirstOrder.phone }}</span>
            <span class="orderDetails_text orderDetails_text--mediumMarginBottom">{{ FirstOrder.email }}</span>
            <span class="orderDetails_text" v-if="FirstOrder.pickup_name">{{ FirstOrder.pickup_name }}</span>
            <span class="orderDetails_text" v-if="FirstOrder.pickup_street">
              {{ FirstOrder.pickup_street }} {{
                FirstOrder.pickup_house_no
              }}{{ FirstOrder.pickup_locum_no ? '/ ' + FirstOrder.pickup_locum_no : '' }}, {{
                FirstOrder.pickup_postal
              }} {{ FirstOrder.pickup_city }}</span>
          </div>

          <div class="orderDetails_column v-col-3">
            <h3 class="orderDetails_subtitle orderDetails_subtitle--bigMarginBottom">Dane odbiorcy</h3>
            <span class="orderDetails_text">{{ FirstOrder.taker_name }}</span>
            <span class="orderDetails_text">{{ FirstOrder.taker_vat_company }}</span>
            <span class="orderDetails_text">{{ FirstOrder.taker_street }} {{
                FirstOrder.taker_house_no
              }}{{ FirstOrder.taker_locum_no ? '/ ' + FirstOrder.taker_locum_no : '' }}</span>
            <span class="orderDetails_text">{{ FirstOrder.taker_postal }} {{ FirstOrder.taker_city }}</span>
            <span class="orderDetails_text">{{ FirstOrder.taker_phone }}</span>
            <span class="orderDetails_text">{{ FirstOrder.taker_email }}</span>
          </div>
        </div>
      </div>

      <div class="orderDetails_content">
        <h3>Lista przesyłek do zamówienia</h3>
      </div>
      <Table v-if="Orders.length > 0" :use-pagination="false" :use-store="true" :use-checkbox="true"
             :table-items="tableItems" :table-headers="tableHeaders">
        <template #additional>
          <div class="table_buttonWrapper">
            <button @click.prevent="downloadWaybills" class="filters_buttonSecondary">Pobierz etykiety</button>
            <!--            <a href="#" class="filters_buttonSecondary" :class="countSelectedItems === 0 ? 'filters_buttonSecondary&#45;&#45;notActive' : ''">Anuluj wybrane</a>-->
          </div>
        </template>
      </Table>

      <div class="row orderDetails_footer">
        <nuxt-link-locale to="panel-order" class="orderDetails_buttonSecondary">Wróć do historii zamówień
        </nuxt-link-locale>
      </div>
    </div>
  </div>

  <ModalCreateComplaint :order="SelectedOrder" :modal-visible="complaintsModalVisible"
                        @update:order-complaint-send="complaintCreated = $event"
                        @hide="complaintsModalVisible = false" @update:modal-visible="complaintsModalVisible = $event"/>
</template>

<script setup lang="ts">
import useCartOrderStore from "~/stores/panel/useCartOrderStore";
import usePageStore from "~/stores/usePageStore";
import {useTableStore} from "~/stores/useTableStore";
import useDownload from "~/composables/useDownload";
import useComplaintsStore from "~/stores/panel/useComplaintsStore";

const {t} = useI18n();
const {getCartOrder} = useCartOrderStore();
const {createComplaint} = useComplaintsStore();
const {order} = storeToRefs(useCartOrderStore());
const router = useRouter();
let {download} = useDownload();
const {formatApiGetRoute} = useApiRoutes();
const {bodyTypes, actionsTypes, setHeaders, setItems} = useTableStore();
const {countSelectedItems, items} = storeToRefs(useTableStore());
const {page} = storeToRefs(useTableStore());

await getCartOrder(router.currentRoute.value.params.id);

onMounted(() => {
  page.value = 1;
});

const CartOrder = ref(order.value.CartOrder.CartOrder ?? {});
const FirstOrder = ref(order.value.CartOrder.Order[0] ?? {});
const Orders = ref(order.value.Orders ?? []);
const SelectedOrder = ref({});
const complaintCreated = ref(false);

watch(complaintCreated, async (value) => {
  if (value) {
    let createComplaintAction = tableItems[orderIndex.value].actions.content.find((item) => item.functionName === 'createComplaint');
    createComplaintAction.disabled = true;
    orderIndex.value = null;
    complaintCreated.value = false;
  }
});

const downloadWaybills = async () => {
  let route = formatApiGetRoute('cartOrder.waybills', {});
  await download(route, 'test.pdf', 'POST', true, {
    cart_ids: [CartOrder.value.id]
  });
}

const complaintsModalVisible = ref(false);
const orderIndex = ref(null);
const showComplaintsModal = (index) => {
  orderIndex.value = index;
  SelectedOrder.value = Orders.value[index];
  complaintsModalVisible.value = true;
}

const tableHeaders = [
  {key: 'order_at', label: t('order.table.order_at'), sortable: true},
  {key: 'order_no', label: t('order.table.order_no'), sortable: true},
  {key: 'address', label: t('order.table.address'), sortable: true},
  {key: 'price_brut', label: t('order.table.price_brut'), sortable: true},
  {key: 'actions', label: t('order.table.actions'), sortable: false},
];
setHeaders(tableHeaders);


const tableItems = Orders.value.map((order) => {
  const Order = order.Order
  const ApiRequest = order.ApiRequest
  const Complaints = order.Complaints

  return {
    id: Order.id,
    canSelect: true,
    id_prefix: {type: bodyTypes.LINK, content: Order.id, link: 'panel-order-package-id'},
    order_at: {type: bodyTypes.TEXT, content: Order.created},
    order_no: {type: bodyTypes.TEXT, content: ApiRequest.waybill_no ?? '-'},
    address: {
      type: bodyTypes.TEXT,
      content: `${Order.taker_name}, ${Order.taker_street} ${Order.taker_house_no}, ${Order.taker_postal} ${Order.taker_city}`
    },
    price_brut: {type: bodyTypes.TEXT, content: Order.price + ' zł'},
    actions: {
      type: bodyTypes.ACTIONS, content: [
        {type: actionsTypes.LINK, link: 'panel-order-package-id', content: 'Szczegóły', id: Order.id},
        {
          type: actionsTypes.FUNCTION,
          functionName: 'createComplaint',
          function: showComplaintsModal,
          content: 'Reklamacja',
          styleClass: 'buttonSecondary',
          disabled: ((!(Complaints.length > 0 || Order.cancelled != '0') && ApiRequest.waybill_no ? false : true))
        },
      ],
    }
  }
});
setItems(tableItems);

watch(order, async (value) => {
  if (value.CartOrder.CartOrder) {
    CartOrder.value = value.CartOrder.CartOrder;
    FirstOrder.value = value.CartOrder.Order[0];
    Orders.value = value.Orders;
  }
});

const copyToClipboard = async () => {
  try {
    await navigator.clipboard.writeText(CartOrder.value.id);
  } catch (error) {
    console.error('Nie udało się skopiować tekstu:', error);
    alert('Nie udało się skopiować tekstu.');
  }
}

useHead({
  title: t('page.panel.order.order-details.title')
});

const {setPageValues} = usePageStore();

setPageValues(
    t('page.panel.order.order-details.title'),
    true,
);

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>