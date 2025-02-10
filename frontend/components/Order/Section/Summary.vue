<script setup lang="ts">
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";
import {useElementVisibility} from "@vueuse/core";
import usePreOrderStore from "~/stores/panel/usePreOrderStore";
import usePageStore from "~/stores/usePageStore";

const {
  form,
  sectionsDone,
  valuationIsLoading,
  isEdit,
  visibleSection,
  isEditingId,
  createOrderLoading,
  allFieldsValidStatus,
  continue_url,
  createOrderData
} = storeToRefs(useOrderFormV2Store());
const {
  isSelectedDeliveryType,
  updateStatusForSection,
  saveToCart,
  initializeSectionsDone,
  initializeFormForOrder,
  createOrder,
} = useOrderFormV2Store();
const {successMessage, successMessageShow, isRequiredMessage} = storeToRefs(usePageStore());
const {updatePreOrder, getPreOrder, deletePreOrder} = usePreOrderStore();
const summaryVisible = ref(null)
const summaryIsVisible = useElementVisibility(summaryVisible)

watch(summaryIsVisible, () => {
  if (summaryIsVisible.value) {
    visibleSection.value = visibleSection.value + ',summary';
  } else {
    visibleSection.value = visibleSection.value.replace(',summary', '');
  }
})
const formValidationErrorsModal = ref(false);
const showCardOrderModal = ref(false);
const showCardOrderPaymentModal = ref(false);

const tryBuy = () => {
  if (valuationIsLoading.value) return;

  if (allFieldsValidStatus.value) {
    showCardOrderPaymentModal.value = true;
  } else {
    formValidationErrorsModal.value = true;
    // validateSections();
  }
}

const addToCartOrder = async () => {
  if (valuationIsLoading.value) return;
  // v$.value.$touch();

  if (allFieldsValidStatus.value) {
    await saveToCart();
    showCardOrderModal.value = true;
    // v$.value.$reset();
    initializeSectionsDone();
  } else {
    formValidationErrorsModal.value = true;
  }
}

const addNextOrder = () => {
  showCardOrderModal.value = false;

  const packageSection = document.getElementById('przesylka');
  if (packageSection) {
    packageSection.scrollIntoView({behavior: 'smooth', block: "end"});
  }
}

const saveCartElement = async () => {
  if (valuationIsLoading.value) return;
  // v$.value.$touch();

  if (allFieldsValidStatus.value) {
    await initializeFormForOrder();
    await updatePreOrder({
      pre_order_id: isEditingId.value,
      order_json: {CartOrder: createOrderData.value, fullData: form.value},
      search_id: form.value.search_id,
      courier_id: form.value.courier.Courier.id
    });

    const router = useRouter();
    const nuxt = useNuxtApp();
    router.push(nuxt.$localePath({name: 'panel-order-shopping-cart'}));
  } else {
    formValidationErrorsModal.value = true;
  }
}

const createOrderForm = async () => {
  if (createOrderLoading.value || valuationIsLoading.value) return;

  const router = useRouter();
  const nuxt = useNuxtApp();

  if (form.value?.CartOrder?.payment === 'paynow') {
    continue_url.value = window.location.origin + nuxt.$localePath({name: 'panel-order-id', params: {id: ':id'}});
  }

  const result = await createOrder();

  successMessageShow.value = false;
  successMessage.value = {
    message: '',
    title: ''
  };
  isRequiredMessage.value = false;
  showCardOrderPaymentModal.value = false;
  createOrderLoading.value = false;

  if (result.success) {
    successMessageShow.value = true;
    successMessage.value = {
      message: 'Zamówienie zostało złożone pomyślnie',
      title: 'Zamówienie złożone'
    };
    isRequiredMessage.value = true;

    if (result.data.paymentUrl) {
      window.location.href = result.data.paymentUrl;
      return;
    }

    if (isEdit.value && String(isEditingId.value).length > 0) {
      await deletePreOrder(isEditingId.value);
    }

    setTimeout(() => {
      successMessageShow.value = false;
      successMessage.value.title = '';
      successMessage.value.message = '';
    }, 50000);

    if (result.data.content.cartOrderId) {
      router.push(nuxt.$localePath({name: 'panel-order-id', params: {id: result.data.content.cartOrderId}}));
      return;
    } else if (!result.data.content.cartOrderId) {
      router.push(nuxt.$localePath({name: 'panel-order-shopping-cart'}));
      return;
    }
  } else {
    if (result.message) {
      const errorSection = document.getElementById('errorMessageAlert');
      if (errorSection) {
        errorSection.scrollIntoView({behavior: 'smooth', block: "end"});
      }
    }
  }
}

</script>

<template>
  <div class="orderForm_card" id="podsumowanie" ref="summaryVisible"
       v-on:mouseenter.stop="updateStatusForSection('summary', null)">
    <div class="row">
      <h2 class="calc_title">Podsumowanie</h2>
    </div>

    <div class="orderForm_summaryCard">
      <div class="orderForm_summaryHeader">
        <h3 class="orderForm_summaryTitle">
          <IconStatus :color="sectionsDone.packages.color" class="orderForm_summaryCheck"/>
          <!--              <NuxtImg :src="sectionsDone.packages ? 'icons/orderForm/checkGreen.png' : 'icons/orderForm/checkGrey.png'" width="23px" height="23px" class="orderForm_summaryCheck"/>-->
          Przesyłka
        </h3>
      </div>
      <div class="orderForm_summaryContent">
            <span class="orderForm_summaryTxt">Rodzaj przesyłki:
              {{ form.package.type == 'package' ? 'Paczka' : '' }}
              {{ form.package.type == 'envelope' ? 'Koperta' : '' }}
              {{ form.package.type == 'pallet' ? 'Paleta' : '' }}
            </span>
        <span
            class="orderForm_summaryTxt">Wymiary: {{ form.package.side_x ?? '0' }}x{{ form.package.side_y ?? '0' }}x{{
            form.package.side_z ?? '0'
          }}cm</span>
        <span v-for="(item, index) in form.SearchParcel"
              class="orderForm_summaryTxt">Wymiary: {{ item.side_x ?? '0' }}x{{ item.side_y ?? '0' }}x{{
            item.side_z ?? '0'
          }}cm</span>
      </div>
    </div>

    <div class="orderForm_summaryCard">
      <div class="orderForm_summaryHeader">
        <h3 class="orderForm_summaryTitle">
          <IconStatus :color="sectionsDone.services.color" class="orderForm_summaryCheck"/>
          Usługi
        </h3>
      </div>
      <div class="orderForm_summaryContent">
            <span
                class="orderForm_summaryTxt">Ubezpieczenie: {{
                form.services.cover ? form.services.cover + ' zł' : '0,00 zł'
              }}</span>
        <span
            class="orderForm_summaryTxt">Pobranie: {{
            form.services.uptake ? form.services.uptake + ' zł' : '0,00 zł'
          }}</span>
        <span class="orderForm_summaryTxt"
              v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')">Paczka w weekend: {{ form.services.inpost_weekend ? 'Tak' : 'Nie' }}</span>
        <span class="orderForm_summaryTxt" v-show="isSelectedDeliveryType('pallet')">Adres prywatny: {{
            form.services.delivery_private ? 'Tak' : 'Nie'
          }}</span>
        <span class="orderForm_summaryTxt" v-show="isSelectedDeliveryType('pallet')">Zwrot palet: {{
            form.services.return_pallet ? 'Tak' : 'Nie'
          }}</span>
        <span class="orderForm_summaryTxt" v-show="isSelectedDeliveryType('not_standard')">Wniesienie: {{
            form.services.bringing ? 'Tak' : 'Nie'
          }}</span>
        <span class="orderForm_summaryTxt" v-show="isSelectedDeliveryType('not_standard')">Wniesienie i rozpakowanie: {{
            form.services.bringing_and_unpack ? 'Tak' : 'Nie'
          }}</span>
        <span class="orderForm_summaryTxt" v-show="isSelectedDeliveryType('package')">Ostrożnie: {{
            form.services.fragile ? 'Tak' : 'Nie'
          }}</span>
      </div>
    </div>

    <div class="orderForm_summaryCard">
      <div class="orderForm_summaryHeader">
        <h3 class="orderForm_summaryTitle">
          <IconStatus :color="sectionsDone.courier.color" class="orderForm_summaryCheck"/>
          Kurier
        </h3>
      </div>
      <div class="orderForm_summaryContent">
            <span class="orderForm_summaryTxt" v-if="form?.courier?.Courier?.name">Nazwa: {{
                form.courier.Courier.name
              }}</span>
        <span class="orderForm_summaryTxt" v-if="form?.courier?.Price?.netto">Kwota netto: {{
            form.courier.Price.netto
          }} zł</span>
        <span class="orderForm_summaryTxt" v-if="form?.courier?.Price?.value">Kwota brutto: {{
            form.courier.Price.value
          }} zł</span>
        <span class="orderForm_summaryTxt"
              v-if="form?.courier?.Price?.cover">Kwota ubezpieczenia: {{ form.courier.Price.cover }} zł</span>
        <span class="orderForm_summaryTxt" v-if="form?.courier?.Price?.cod">Kwota COD: {{
            form.courier.Price.cod
          }} zł</span>
        <span class="orderForm_summaryTxt" v-if="!form?.courier?.Courier?.name && !form?.courier?.Price?.value">Brak wybranego kuriera</span>
        <span class="orderForm_summaryTxt orderForm_summaryTxt--bold orderForm_summaryTxt--large"
              style="margin-top: 10px;"
              v-if="form?.courier?.Courier?.desc" v-html="form.courier.Courier.desc">
            </span>
      </div>
    </div>

    <div class="orderForm_summaryCard">
      <div class="orderForm_summaryHeader">
        <h3 class="orderForm_summaryTitle">
          <IconStatus :color="sectionsDone.sender.color" class="orderForm_summaryCheck"/>
          Nadanie
        </h3>
      </div>
      <div class="orderForm_summaryContent">
        <span class="orderForm_summaryTxt" v-show="form.sender.name">Imię i nazwisko: {{ form.sender.name }}</span>
        <span class="orderForm_summaryTxt" v-show="form.sender.vat_company">Nazwa firmy: {{
            form.sender.vat_company
          }}</span>
        <span class="orderForm_summaryTxt" v-show="form.sender.vat_postal">Kod pocztowy: {{
            form.sender.vat_postal
          }}</span>
        <span class="orderForm_summaryTxt" v-show="form.sender.vat_city">Miasto: {{ form.sender.vat_city }}</span>
        <span class="orderForm_summaryTxt" v-show="form.sender.vat_street">Ulica: {{
            form.sender.vat_street
          }}</span>
        <span class="orderForm_summaryTxt"
              v-show="form.sender.vat_house_no">Numer budynku: {{ form.sender.vat_house_no }}</span>
        <span class="orderForm_summaryTxt"
              v-show="form.sender.vat_locum_no">Numer mieszkania: {{ form.sender.vat_locum_no }}</span>
      </div>
    </div>

    <div class="orderForm_summaryCard">
      <div class="orderForm_summaryHeader">
        <h3 class="orderForm_summaryTitle">
          <IconStatus :color="sectionsDone.recipient.color" class="orderForm_summaryCheck"/>
          Doręczenie
        </h3>
      </div>
      <div class="orderForm_summaryContent">
            <span class="orderForm_summaryTxt"
                  v-show="form.recipient.taker_name">Imię i nazwisko: {{ form.recipient.taker_name }}</span>
        <span class="orderForm_summaryTxt"
              v-show="form.recipient.taker_vat_company">Nazwa firmy: {{ form.recipient.taker_vat_company }}</span>
        <span class="orderForm_summaryTxt" v-show="form.recipient.country">Kraj: {{ form.recipient.country }}</span>
        <span class="orderForm_summaryTxt"
              v-show="form.recipient.taker_postal">Kod pocztowy: {{ form.recipient.taker_postal }}</span>
        <span class="orderForm_summaryTxt" v-show="form.recipient.taker_city">Miasto: {{
            form.recipient.taker_city
          }}</span>
        <span class="orderForm_summaryTxt"
              v-show="form.recipient.taker_street">Ulica: {{ form.recipient.taker_street }}</span>
        <span class="orderForm_summaryTxt"
              v-show="form.recipient.taker_house_no">Numer budynku: {{ form.recipient.taker_house_no }}</span>
        <span class="orderForm_summaryTxt"
              v-show="form.recipient.taker_locum_no">Numer mieszkania: {{ form.recipient.taker_locum_no }}</span>
      </div>
    </div>

    <!--        <div class="orderForm_promoCodeWrapper">-->
    <!--          <div class="form_inputContainer200">-->
    <!--            <label for="" class="form_subtitle">Kod rabatowy</label>-->
    <!--            <input type="text" id="" name="" class="form_inputTxt form_inputTxt&#45;&#45;withoutUnit" @change="form.promoCode = $event.target.value" :value="form.promoCode"/>-->
    <!--          </div>-->

    <!--          <button class="form_buttonSecondary form_buttonSecondary&#45;&#45;marginBottom16" @click.stop="">Użyj kodu</button>-->
    <!--        </div>-->

    <div class="row">
      <div class="orderForm_priceContainer">
        <span class="orderForm_priceHeader" style="margin-bottom: 10px; font-weight: 400">Kwota netto: <span
            class="orderForm_price">{{ form.courier?.Price?.netto ?? '0,00' }} zł</span></span>
        <span class="orderForm_priceHeader">Razem do zapłaty: <span
            class="orderForm_price">{{ form.courier?.Price?.value ?? '0,00' }} zł</span></span>
<!--        <span class="orderForm_priceHeader orderForm_priceHeader&#45;&#45;small">Razem do zapłaty: <span-->
<!--            class="orderForm_price">{{ form.courier?.Price?.value ?? '0,00' }} zł</span></span>-->
        <span class="orderForm_priceTxt">(Kwota z VAT)</span>
      </div>

      <div class="orderForm_summaryButtonsContainer orderForm_summaryButtonsContainer--orderForm">
        <button :disabled="valuationIsLoading" class="orderForm_buttonGhost orderForm_buttonGhost--narrow"
                v-if="!isEdit" @click.prevent="addToCartOrder();">
          {{ !valuationIsLoading ? 'Dodaj do koszyka' : 'Poczekaj na wycenę' }}
        </button>
        <button :disabled="valuationIsLoading" class="orderForm_buttonGhost orderForm_buttonGhost--narrow" v-if="isEdit"
                @click.prevent="saveCartElement();">Zapisz
        </button>
        <button :disabled="valuationIsLoading" class="orderForm_buttonPrimary orderForm_buttonPrimary--narrow"
                @click.prevent="tryBuy()">{{ !valuationIsLoading ? 'Zapłać teraz' : 'Poczekaj na wycenę' }}
        </button>
      </div>
    </div>
  </div>

  <Teleport to="body">
    <Modal :show="formValidationErrorsModal" @close="formValidationErrorsModal = false">
      <template #header>
        <h1 class="modal_title modal_title--big">Formularz wymaga uwagi</h1>
      </template>
      <template #body>
        <p class="modal_txt">
          W formularzu masz nieuzupełnione dane, które są potrzebne do złożenia zamówienia lub dodania do koszyka.
          Sprawdź, które pola wymagają Twojej uwagi.
        </p>
      </template>
    </Modal>
  </Teleport>

  <Teleport to="body">
    <Modal :show="showCardOrderModal" @close="showCardOrderModal = false">
      <template #header>
        <h1 class="modal_title">Dodaj do koszyka</h1>
      </template>
      <template #body>
        <p class="modal_txt">
          Twoje zamówienie zostało dodane do koszyka, czy chcesz zamówić kolejną przesyłkę?
        </p>

        <div class="orderForm_summaryModalButtonsContainer">
          <nuxt-link-locale to="panel-order-shopping-cart" class="orderForm_buttonGhost" @click.prevent="">Przejdź do
            koszyka
          </nuxt-link-locale>
          <button class="orderForm_buttonPrimary" @click.prevent="addNextOrder()">Nadaj kolejną przesyłkę</button>
        </div>
      </template>
    </Modal>
  </Teleport>

  <ModalPaymentOptions
      @change="form.CartOrder.payment = $event"
      :action="createOrderForm"
      :show-modal="showCardOrderPaymentModal"
      :selected-payment="form.CartOrder.payment"
      back-text="Wróć do zamówienia"
      @hide="showCardOrderPaymentModal = false"
      :loading="createOrderLoading"
  />
</template>

<style scoped>

</style>