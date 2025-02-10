<template>
  <ModalAddressBookSelector
      :modal-action="fullFillFromAddressBook"
      :is-show="showAddressBookModal" :address-book-type="showAddressBookModalType"
      @close="showAddressBookModal = false"/>

  <div class="form_card">
    <div style="display: flex; justify-content: space-between; width: 100%">
      <div class="row row--alignStart row--baseline">
        <h2 class="form_title">Nadanie</h2>
        <span class="form_infoTxt form_infoTxt--marginLeft">
            <button v-show="showSenderDetails" style="text-decoration: underline;" @click.prevent="openShowAddressBookModal('sender')">Pobierz z książki adresowej</button>
          </span>
      </div>
      <div>
        <div class="orderForm_stickyBarSwitchContainer">
          <label for="visibilitySwitch2" class="orderForm_stickyBarTxt">Wybierz</label>
          <label class="switch">
            <input id="visibilitySwitch2" type="checkbox" :checked="showSenderDetails"
                   @change.prevent="showSenderDetails = $event.target.checked">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
    </div>

    <div class="row row--orderForm" v-show="showSenderDetails">
      <div class="row row--alignStart row--baseline">
        <h3 class="form_subtitle">Dane nadawcy
          <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                   @click="showInfoModalType = 'sender_details'; showInfoModal = true"/>
        </h3>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Imię i nazwisko</label>
          <input type="text" id="" name="" :value="form.name"
                 @change="form.name = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.name.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Nazwa firmy</label>
          <input type="text" id="" name="" :value="form.vat_company"
                 @change="form.vat_company = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.vat_company.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Ulica</label>
          <input type="text" id="" name="" :value="form.street"
                 @change="form.street = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.street.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer142">
          <label for="" class="form_label">Numer budynku</label>
          <input type="text" id="" name="" :value="form.house_no"
                 @change="form.house_no = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.house_no.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer142">
          <label for="" class="form_label">Numer mieszkania</label>
          <input type="text" id="" name="" :value="form.locum_no"
                 @change="form.locum_no = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.locum_no.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <InputCountrySelector :disabled="true"/>

        <div class="form_inputContainer200">
          <label for="" class="form_label">Kod pocztowy</label>
          <input type="text" id="" name="" :value="form.postal_sender"
                 @change="form.postal_sender = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.postal_sender.postalRegex.$invalid" class="signin_errorMsg signin_errorMsg--show">Poprawny format dla kodu pocztowego to XX-XXX</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Miasto</label>
          <input type="text" id="" name="" :value="form.city"
                 @change="form.city = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.city.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Adres e-mail</label>
          <input type="text" id="" name="" :value="form.email"
                 @change="form.email = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.email.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Numer telefonu</label>
          <input type="text" id="" name="" :value="form.phone"
                 @change="form.phone = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit" v-no-letters/>
          <span v-if="v$.phone.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>
    </div>

    <div class="row" v-show="showSenderDetails">
      <div class="orderForm_col1">
        <div class="row">
          <h3 class="form_subtitle">Sposób nadania</h3>
        </div>

        <div class="row row--gap16 row--orderForm">
          <input type="radio" id="radio50" name="typeOfSending" class="form_radioInput"
                 @change="form.no_pickup = false" :checked="form.no_pickup === false"/>
          <label for="radio50" class="form_radioLabelTile">odbiór przez kuriera</label>

          <input type="radio" id="radio51" name="typeOfSending" class="form_radioInput"
                 @change="form.no_pickup = true"
                 v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                 :checked="form.no_pickup === true"/>
          <label for="radio51" class="form_radioLabelTile"
                 v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
          >dostarczę przesyłkę do punktu</label>
          <span
              v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
              v-if="v$.no_pickup.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import usePackageTemplateStore from "~/stores/panel/usePackageTemplateStore";
import {email, maxLength, maxValue, required} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import useAddressBookStore from "~/stores/panel/useAddressBookStore";

const { form, showSenderDetails, showInfoModal, showInfoModalType } = storeToRefs(usePackageTemplateStore());
const { isSelectedDeliveryType, fullFillSendersData } = usePackageTemplateStore();
const postalRegex = (value) => {
  if (value.length === 0) {
    return true;
  }

  const regex = /^[0-9]{2}-[0-9]{3}$/
  return regex.test(value);
}
const rules = computed(() => {
  return {
    no_pickup: {},
    postal_sender: {maxLength: maxLength(20), postalRegex},
    postal_delivery: {maxLength: maxLength(20)},
    delivery_type: {maxLength: maxLength(255)},
    city: {maxLength: maxLength(100)},
    email: {email, maxLength: maxLength(100)},
    house_no: {maxLength: maxLength(100)},
    locum_no: {maxLength: maxLength(100)},
    name: {maxLength: maxLength(100)},
    phone: {maxLength: maxLength(100)},
    vat_company: {maxLength: maxLength(250)},
    street: {maxLength: maxLength(100)},
  };
});
const v$ = useVuelidate(rules, form.value);
const showAddressBookModal = ref(false);
const showAddressBookModalType = ref('sender');
const openShowAddressBookModal = (type) => {
  showAddressBookModalType.value = type;
  showAddressBookModal.value = true;
}
const fullFillFromAddressBook = (id) => {
  const {items, types} = storeToRefs(useAddressBookStore());
  let element = items.value.find((item, itemIndex) => item.Contact.id == id)?.Contact;
  if (showAddressBookModalType.value == 'sender') {
    form.value.name = element.name;
    form.value.vat_company = element.vat_company;
    form.value.phone = element.phone;
    form.value.postal_sender = element.postal;
    form.value.city = element.city;
    form.value.street = element.street;
    form.value.house_no = element.house_no;
    form.value.locum_no = element.locum_no;
    form.value.email = element.email;
  }

  showAddressBookModal.value = false;
}

onMounted(async () => {
  await fullFillSendersData();

  v$.value.$touch()
})
</script>

<style scoped>

</style>