<template>
  <div class="form_container">
    <div class="orderForm_card orderForm_card--cart">
      <div class="form_errorMessageAlert" id="errorMessageAlert" v-show="courierError?.message">
        <div class="form_errorMessageAlert--title"><NuxtImg src="icons/orderForm/checkError.png"/><span>Uwaga!</span></div>
        <div class="form_errorMessageAlert--text">{{ courierError?.message }}</div>
        <ul v-for="(generated, key) in courierError?.data?.errors">
          <li v-show="typeof generated !== 'string'" class="form_errorMessageAlert--text" v-for="(message, key) in generated">
            Dla pola: {{ t('formFields.' +key)}} - {{message[0]}}</li>
          <li v-show="typeof generated === 'string'" class="form_errorMessageAlert--text">{{generated}}</li>
        </ul>
      </div>

      <Table :use-pagination="false" :use-store="true" :use-checkbox="true" :table-headers="tableHeaders" :table-items="items"/>

      <div class="orderForm_card orderForm_card--fixedOffer orderForm_card--cartSummary">
        <div class="row row--cartSummary">
          <div class="orderForm_priceContainer orderForm_priceContainer--cartSummary">
            <span class="orderForm_priceHeader">Razem do zapłaty: <span class="orderForm_priceHeader--cartPrice">{{ selectedItemsValue ? selectedItemsValue.toFixed(2) : '0,00' }} zł</span></span>
            <span class="orderForm_priceTxt">(Kwota z VAT)</span>
          </div>

          <div class="orderForm_summaryButtonsContainer orderForm_summaryButtonsContainer--cartSummary">
            <button class="orderForm_buttonPrimary orderForm_buttonPrimary--narrow" @click.prevent="showPaymentModal">Zapłać teraz</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <Teleport to="body">
    <Modal :show="showDeleteModal" @close="showDeleteModal = false">
      <template #header>
        <h1 class="modal_title">Czy napewno chcesz usunąć zamówienie?</h1>
      </template>
      <template #body>
        <div class="orderForm_summaryModalButtonsContainer">
          <button class="orderForm_buttonGhost" @click.prevent="showDeleteModal = false">Nie</button>
          <button class="orderForm_buttonPrimary" @click.prevent="submitDelete">Tak</button>
        </div>
      </template>
    </Modal>
  </Teleport>

  <ModalPaymentOptions
      @change="selectedPayment = $event"
      :action="createOrderForm"
      :show-modal="showCardOrderPaymentModal"
      :selected-payment="selectedPayment"
      @hide="showCardOrderPaymentModal = false"
      :loading="createOrderLoading"
  />

  <Teleport to="body">
    <Modal :show="showNoSelectedItemsModal" @close="showNoSelectedItemsModal = false">
      <template #header>
        <h1 class="modal_title modal_title--big">Nie wybrano zamówień</h1>
      </template>
      <template #body>
        <p class="modal_txt">
          Wybierz zamówienia które chcesz opłacić.
        </p>
      </template>
    </Modal>
  </Teleport>
</template>

<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import {useTableStore} from "~/stores/useTableStore";
import usePreOrderStore from "~/stores/panel/usePreOrderStore";
import {email, required, requiredIf} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";

const {t} = useI18n();
const {setPageValues} = usePageStore();

const router = useRouter();
const route = useRoute();
const nuxt = useNuxtApp();

setPageValues(
    t('page.panel.order.shopping-cart.title'),
    true
);

const tableHeaders = [
  {key: 'package_count', label: t('shoppingCart.table.package_count'), sortable: true},
  {key: 'errors', label: t('shoppingCart.table.errors'), sortable: false},
  {key: 'price_brut', label: t('shoppingCart.table.price'), sortable: true},
  {key: 'courier', label: t('shoppingCart.table.courier'), sortable: true},
  {key: 'sender', label: t('shoppingCart.table.sender'), sortable: true},
  {key: 'taker', label: t('shoppingCart.table.taker'), sortable: true},
  {key: 'actions', label: t('shoppingCart.table.actions'), sortable: false},
];

const { setItems, setHeaders, startLoadingAsyncData, stopLoadingAsyncData, bodyTypes, actionsTypes} = useTableStore();
const { selectedItems, items } = storeToRefs(useTableStore());
const { updateFormValues, initializeForm } = useOrderFormV2Store();
const { getPreOrder, deletePreOrder} = usePreOrderStore();
const { preOrder } = storeToRefs(usePreOrderStore());
const { page } = storeToRefs(useTableStore());
const dataItems = ref([]);
const showDeleteModal = ref(false);
const showCardOrderPaymentModal = ref(false);
const showNoSelectedItemsModal = ref(false);
const elementId = ref(null)
const selectedPayment = ref(null);
const selectedItemsValue = ref(null);

onMounted(async () => {
  page.value = 1;

  if (route.query.success) {
    successMessageShow.value = true;
    successMessage.value = {
      message: 'Zamówienie zostało złożone pomyślnie',
      title: 'Zamówienie złożone'
    };
    setTimeout(() => {
      successMessageShow.value = false;
      successMessage.value = {
        message: '',
        title: ''
      };
    }, 10000)
  }
});

watch(selectedItems, (value) => {
  if (selectedItems.value.length === 0) {
    selectedItemsValue.value = null;
    return;
  }
  let sumPrice = 0;
  selectedItems.value.forEach((item) => {
    sumPrice = ((sumPrice / 100) + (item.price / 100)) * 100;
    return;
  });
  selectedItemsValue.value = sumPrice;
});

const { createOrder } = useOrderFormV2Store();
const { successMessage, successMessageShow } = storeToRefs(usePageStore());

const createOrderForm = async () => {
  let itemsIndex = [];
  itemsIndex = selectedItems.value.map((item) => item.index);
  let itemsSelected = dataItems.value.filter((item, index) => itemsIndex.includes(index));
  let itemsToRequest = [];
  itemsSelected.forEach((item) => {
    itemsToRequest.push(item?.PreOrder?.id)
  });

  const request = ref({
    payment: selectedPayment.value,
    origin: "front",
    pre_order_ids: itemsToRequest,
    continueUrl: window.location.origin + nuxt.$localePath('panel-shopping-cart')
  })

  if (selectedPayment.value === 'paynow') {
    request.value.continue_url = window.location.origin + nuxt.$localePath({name: 'panel-order-shopping-cart', query : { success: true }});
  }

  const result = await createOrder(request);

  if (result.success) {
    if (result.data.paymentUrl) {
      window.location.href = result.data.paymentUrl;
      return;
    }

    successMessageShow.value = true;
    successMessage.value = {
      message: 'Zamówienie zostało złożone pomyślnie',
      title: 'Zamówienie złożone'
    };
    items.value = items.value.filter((item, index) => !itemsIndex.includes(index));
    dataItems.value = dataItems.value.filter((item, index) => !itemsIndex.includes(index));
    preOrder.value = preOrder.value.filter((item, index) => !itemsIndex.includes(index));
    showCardOrderPaymentModal.value = false;

    const successSection = document.getElementById('successPanelMessage');
    successSection.style.display = 'block';
    if (successSection) {
      successSection.scrollIntoView({behavior: 'smooth', block: "end"});
    }
  } else {
    if (result.message) {
      const errorSection = document.getElementById('errorMessageAlert');
      if (errorSection) {
        errorSection.scrollIntoView({ behavior: 'smooth', block: "end" });
      }
    } else if (result.validationErrors) {
      console.error('Programisto dokończ mnie!')
    }

    showCardOrderPaymentModal.value = false;
  }

  createOrderLoading.value = false;
}

const showPaymentModal = () => {
  if (selectedItems.value.length === 0) {
    showNoSelectedItemsModal.value = true;
    return;
  }
  showCardOrderPaymentModal.value = true;
}

const deleteElement = (key) => {
  showDeleteModal.value = true;
  elementId.value = dataItems.value[key].PreOrder.id;
}

const submitDelete = () => {
  dataItems.value = dataItems.value.filter((item, index) => item.PreOrder.id !== elementId.value);
  items.value = items.value.filter((item, index) => item.id !== elementId.value);
  preOrder.value = preOrder.value.filter((item, index) => item.PreOrder.id !== elementId.value);
  deletePreOrder(elementId.value)
  showDeleteModal.value = false;

  successMessageShow.value = true;
  successMessage.value = {
    message: 'Zamówienie zostało pomyślnie usunięte z koszyka',
    title: 'Zamówienie usunięte'
  };

  setTimeout(() => {
    successMessageShow.value = false;
    successMessage.value = {
      message: '',
      title: ''
    };
  }, 10000)
}

const { form, isEdit, courierError, isEditingId, createOrderLoading } = storeToRefs(useOrderFormV2Store());

const getPreOrderObject = async (id) => {
  return preOrder.value.find((item) => item.PreOrder.id === id).PreOrder;
}

const extractKeyValuePairs = (obj) => {
  const result = {};

  for (const key in obj) {
    if (typeof obj[key] === "object" && obj[key] !== null && !Array.isArray(obj[key])) {
      // Rekurencyjnie przetwarzaj zagnieżdżone obiekty
      Object.assign(result, extractKeyValuePairs(obj[key]));
    } else {
      // Dodaj końcowy klucz i wartość
      result[key] = obj[key];
    }
  }

  return result;
}

const editElement = async (elementId) => {
  isEditingId.value = elementId;
  const PreOrder = await getPreOrderObject(elementId);

  if (!PreOrder?.order_json?.fullData) {
    deletePreOrder(elementId)
  }

  if (Array.isArray(PreOrder.order_json.fullData.pickup) && PreOrder.order_json.fullData.pickup.length == 0) {
    PreOrder.order_json.fullData.pickup = {}
  }

  let allKeyValuePairs = extractKeyValuePairs(PreOrder.order_json?.fullData);
  // Na ten moment pojedynczy przypadek kontrolować!!!
  allKeyValuePairs.type = PreOrder.order_json?.fullData.package.type;

  initializeForm()
  updateFormValues(form.value, allKeyValuePairs);
  isEdit.value = true;

  router.push(nuxt.$localePath({name: 'panel'}));
}

const validateItem = (item: any) => {
  let state = reactive(item)
  const rules = computed(() => {
    return {
      search_id: {required},
      sender: {
        name: {required},
        vat_street: {required},
        vat_house_no: {required},
        vat_locum_no: {},
        vat_postal: {required},
        vat_city: {required},
        email: {required, email},
        phone: {required},
        vat_company: {},
        no_pickup: {required},
      },
      recipient: {
        taker_name: {required},
        taker_street: {required},
        taker_house_no: {required},
        taker_postal: {required},
        taker_city: {required},
        taker_email: {required, email},
        taker_phone: {required},
        delivery_type: {required},
      },
      packages: {
        CourierSearch: {
          type: {required},
          weight: {required},
          side_x: {required},
          side_y: {required},
          side_z: {required},
          sortable: {requiredIf: requiredIf(() => item.packages.CourierSearch.type === 'package' || item.packages.CourierSearch.type === 'envelope')},
          package_content: {required},
        }
      },
      courier: {
        Courier: {
          courier_code: {required},
          id: {required}
        }
      },
      services: {
        cover: {},
        uptake: {},
        inpost_weekend: {},
        delivery_private: {},
      }
    }
  })

  const v$ = useVuelidate(rules, state);
  v$.value.$touch();
  let status = true;

  if (v$.value.courier.$error) {
    status = false;
  }

  if (v$.value.recipient.$error) {
    status = false;
  }

  if (v$.value.packages.$error) {
    status = false;
  }

  if (v$.value?.services.$error) {
    status = false;
  }

  if (v$.value.sender.$error) {
    status = false;
  }

  return status;
}
setHeaders(tableHeaders);

const asyncData = async () => {
  startLoadingAsyncData();
  const data = await getPreOrder();
  // await setHeaders(tableHeaders)
  dataItems.value = data;

  if (!Array.isArray(data)) {
    stopLoadingAsyncData();
    return;
  }
  items.value = [];

  data.filter((check) => check?.PreOrder?.order_json?.fullData).forEach((item, index) => {
    item = item.PreOrder
    item.CartOrder = item.order_json.CartOrder
    item.FullData = item.order_json.fullData

    let errors = [];
    try {
      const parsed = JSON.parse(item?.errors);
      if (parsed) {
        errors = parsed;
      }
    } catch (e) {
     //
    }

    items.value.push({
      id: item?.id,
      index: index,
      price: item?.order_json?.fullData?.courier?.Price?.value ?? 0,
      errors: { type: bodyTypes.ERRORS_MODAL, content: errors},
      canSelect: true,
      package_count: { type: bodyTypes.TEXT, content: Array.isArray(item.FullData?.packages?.SearchParcel) ? item.FullData?.packages?.SearchParcel.length + 1 : 1 },
      courier: { type: bodyTypes.TEXT, content: item?.order_json?.fullData?.courier?.Courier?.name ?? 'Nie wybrano kuriera' },
      sender: { type: bodyTypes.TEXT, content: item?.order_json?.fullData?.sender?.name ?? 'Brak nadawcy' },
      taker: { type: bodyTypes.TEXT, content: item?.order_json?.fullData?.recipient?.taker_name ?? 'Brak odbiorcy' },
      price_brut: { type: bodyTypes.TEXT, content: item?.order_json?.fullData?.courier?.Price?.value ? item?.order_json?.fullData?.courier?.Price?.value + ' zł' : 'Nie wybrano kuriera' },
      actions: { type: bodyTypes.ACTIONS, content: [
          { type: actionsTypes.FUNCTION, function: editElement, content: 'Edytuj', styleClass: 'buttonSecondary', useId: true, id: item?.id  },
          { type: actionsTypes.FUNCTION, function: deleteElement,  content: 'Usuń', styleClass: 'buttonDelete' },
        ]
      },
    });
  });

  stopLoadingAsyncData();
};

onMounted(async () => {
  await asyncData();
});

useHead({
  title: t('page.panel.order.shopping-cart.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<style scoped>

</style>