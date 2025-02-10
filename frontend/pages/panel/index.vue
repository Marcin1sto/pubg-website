<template>
  <OrderProgressSections/>

  <div>
    <div class="form_container">
      <div class="form_errorMessageAlert" id="errorMessageAlert" v-show="courierError?.message">
        <div class="form_errorMessageAlert--title">
          <NuxtImg src="icons/orderForm/checkError.png"/>
          <span>Uwaga!</span></div>
        <div class="form_errorMessageAlert--text">{{ courierError?.message }}</div>
        <ul v-for="(generated, key) in courierError?.data?.errors"
            v-if="typeof courierError?.data?.errors !== 'object'">
          <li class="form_errorMessageAlert--text" v-for="(message, key) in generated">Dla pola:
            {{ t('formFields.' + key) }} - {{ message[0] }}
          </li>
        </ul>
        <span v-else class="form_errorMessageAlert--text">{{ courierError?.data?.errors.auto_generated_0 }}</span>
      </div>

      <OrderSectionPackage/>

      <OrderSectionServices/>

      <OrderSectionCourier/>

      <div class="form_horizontalCardsWrapper">
        <OrderSectionSender/>

        <OrderSectionRecipient/>
      </div>

      <OrderSectionPUDOMap />

      <OrderSectionSummary/>
    </div>

    <OrderTransitionValuation/>
  </div>

  <ModalAddressBookSelector
      :is-show="showAddressBookModal"
      :address-book-type="showAddressBookModalType"
      :form-to-change="form"
      @close="closeShowAddressBookModal"
  />

  <ModalInfoHelpModal />
</template>

<script setup lang="ts">
import useUserStore from "~/stores/useUserStore";
import usePageStore from "~/stores/usePageStore";
import usePreOrderStore from "~/stores/panel/usePreOrderStore";
import {useVuelidate} from "@vuelidate/core";
import useQuickValuationStore from "~/stores/useQuickValuationStore";
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";

const {userExternalData, paymentOptions} = storeToRefs(useUserStore());
const {t} = useI18n();
const {
  initializeForm,
  isSelectedDeliveryType,
  updateMapUrl,
  selectCourierPrice,
  updateTakerPoint,
  initializeSectionsDone,
  fullFullFromQuickQuote,
  fullFillSenderData,
  parseFormForValuation,
  firstValuation,
} = useOrderFormV2Store();

const {
  form, valuationResults,
  courierError, isEdit, isEditingId,  isEditSales,
  showAddressBookModalType, showAddressBookModal, valuation, showRecipientMap,
  previewPoint, selectedPoint,
} = storeToRefs(useOrderFormV2Store());
const {CartOrder} = storeToRefs(usePreOrderStore());

onBeforeMount(() => {
  initializeForm();
})

const closeShowAddressBookModal = () => {
  showAddressBookModalType.value = '';
  showAddressBookModal.value = false;
}

const {params} = storeToRefs(useQuickValuationStore());

const isMounting = ref(true);
onMounted(async () => {
  courierError.value.message = ''
  fullFillSenderData(userExternalData.value.Broker);

  if (isEdit.value) {
    parseFormForValuation();
    selectedPoint.value = form.value.taker_point;
    previewPoint.value = form.value.selectedMapPoint;
    updateMapUrl();
  } else {
    firstValuation();
  }

  fullFullFromQuickQuote(params.value);
  initializeSectionsDone();
  isMounting.value = false;

  window.addEventListener('message', (event) => {
    if (event.data?.type === 'POINT_INFO_CHANGE') {
      previewPoint.value = event.data.value;
    }

    if (event.data?.type === 'SELECT_CHANGE') {
      selectedPoint.value = event.data.value.name;
      updateTakerPoint(selectedPoint.value);
      form.value.taker_point = selectedPoint.value;
      form.value.selectedMapPoint = previewPoint.value;
      showRecipientMap.value = false;
    }
  })
});

onBeforeUnmount(() => {
  isEditingId.value = null;
  isEdit.value = false;
  isEditSales.value = false;
});

const valuationShowMore = ref(false);

const apiTypeMap = {
  inpost: ['paczkomaty', 'paczkomaty_eco', 'paczkomaty_to_door'],
}

watch(() => previewPoint.value?.apiType, (newValue) => {
  valuation.value.valuationResultsToShow = valuation.value.valuationResultsToShow.sort((a) => {
    if (previewPoint.value?.apiType === 'inpost' && apiTypeMap.inpost.includes(a.Courier.courier_code)) {
      return -1;
    }

    if (a.Courier.courier_code === previewPoint.value?.apiType) {
      return -1;
    }

    return 1;
  })
});

watch(() => selectedPoint.value, () => {
  const getValuationByType = valuation.value.valuationResultsToShow.filter((item) => {
    if (previewPoint.value?.apiType === 'inpost') {
      if (typeof form?.value?.courier !== undefined && typeof item?.Courier?.courier_code !== undefined) {
        return form.value.courier?.Courier?.courier_code === item.Courier.courier_code;
      }
      return apiTypeMap.inpost.includes(item.Courier.courier_code);
    }

    return item.Courier.courier_code === previewPoint.value?.apiType;
  });

  if (getValuationByType.length === 1 && selectedPoint.value) {
    console.log(getValuationByType)
    selectCourierPrice(getValuationByType[0]);
  }
});


watch(valuationShowMore, () => {
  if (valuationShowMore.value == true) {
    valuation.value.valuationResultsToShow = valuationResults.value?.data.results
  } else {
    valuation.value.valuationResultsToShow = valuationResults.value?.data.results.slice(0, 5);
  }
}, {deep: true});

const {setPageValues} = usePageStore();
const {successMessage, successMessageShow, isRequiredMessage} = storeToRefs(usePageStore());

let state = reactive(form)

setPageValues(
    t('page.panelPage.title'),
    false
);
useHead({
  title: t('page.panelPage.title'),
  layout: 'panel',
});
definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<style scoped>

</style>