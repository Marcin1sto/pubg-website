<script setup lang="ts">
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";
import {email, required, requiredIf} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import useHelpModalStore from "~/stores/panel/useHelpModalStore";

const { form, showAddressBookModal, showAddressBookModalType, sectionsDone } = storeToRefs(useOrderFormV2Store());
const { updateCourierSearchField, updateMapUrl, updateStatusForSection, getSectionStatusByStatus } = useOrderFormV2Store();
const { selectedHelpModalKey, showHelpModal } = storeToRefs(useHelpModalStore());
const countriesRequiredState = ['US', 'CA']

const postalRegex = (value) => {
  if (form.value.package.country_code !== 'PL') {
    return true;
  }

  if (value.length === 0) {
    return true;
  }

  const regex = /^[0-9]{2}-[0-9]{3}$/
  return regex.test(value);
}

const rules = computed(() => {
  return {
    recipient: {
      taker_name: {required},
      taker_street: {required},
      taker_house_no: {required},
      taker_postal: {required, postalRegex: postalRegex},
      taker_city: {required},
      taker_email: {required, email},
      taker_phone: {required},
      // delivery_type: {required},
      state: {requiredIf: requiredIf(() => countriesRequiredState.includes(form.value.package.country_code) )},
      marketplace_sale_id: {}
    },
  }
})
const v$ = useVuelidate(rules, form.value);

watch(() => v$.value.$invalid, (value) => {
  if (value) {
    sectionsDone.value.recipient = getSectionStatusByStatus('error');
  }
})

</script>

<template>
  <div class="form_card" id="doreczenie"
       v-on:mouseenter.stop="updateStatusForSection('recipient', v$.$invalid)"
       v-on:mouseleave="updateStatusForSection('recipient', v$.$invalid)">
    <div class="row">
      <h2 class="form_title">Doręczenie</h2>
    </div>

    <div class="row row--orderForm">
      <div class="row row--alignStart row--baseline">
        <h3 class="form_subtitle">Dane odbiorcy
          <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                   @click="selectedHelpModalKey = 'recipient_details'; showHelpModal = true"/>

        </h3>
        <span class="form_infoTxt form_infoTxt--marginLeft">
              <button style="text-decoration: underline;"
                      @click.prevent="showAddressBookModal = true; showAddressBookModalType = 'recipient'">Pobierz z książki adresowej</button>
            </span>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Imię i nazwisko<i>*</i></label>
          <input type="text" id="" name="" :value="form.recipient.taker_name"
                 @change="form.recipient.taker_name = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.recipient.taker_name.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Nazwa firmy</label>
          <input type="text" id="" name="" :value="form.recipient.taker_vat_company"
                 @change="form.recipient.taker_vat_company = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Ulica<i>*</i></label>
          <input type="text" id="" name="" :value="form.recipient.taker_street"
                 @change="form.recipient.taker_street = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.recipient.taker_street.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer142 form_inputContainer142--wideMobile">
          <label for="" class="form_label">Numer budynku<i>*</i></label>
          <input type="text" id="" name="" :value="form.recipient.taker_house_no"
                 @change="form.recipient.taker_house_no = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit" />
          <span v-if="v$.recipient.taker_house_no.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer142 form_inputContainer142--wideMobile">
          <label for="" class="form_label">Numer mieszkania</label>
          <input type="text" id="" name="" :value="form.recipient.taker_locum_no"
                 @change="form.recipient.taker_locum_no = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit" />
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <InputCountrySelector
            :by-short-name="form.package.country_code"
            @country-change="(event) => {updateCourierSearchField(event.shortName, 'country_code'); form.recipient.country = event.shortName}"/>

        <div class="form_inputContainer200 form_inputContainer200--postal">
          <label for="" class="form_label">Kod pocztowy<i>*</i></label>
          <input type="text" id="" name="" :value="form.recipient.taker_postal"
                 @change="form.recipient.taker_postal = $event.target.value; updateCourierSearchField($event.target.value, 'postal_delivery'); updateMapUrl"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.recipient.taker_postal.required.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
          <span v-if="v$.recipient.taker_postal.postalRegex.$invalid" class="signin_errorMsg signin_errorMsg--show">Poprawny format dla kodu pocztowego to XX-XXX</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Miasto<i>*</i></label>
          <input type="text" id="" name="" :value="form.recipient.taker_city"
                 @change="form.recipient.taker_city = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.recipient.taker_city.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Adres e-mail<i>*</i></label>
          <input type="text" id="" name="" :value="form.recipient.taker_email"
                 @change="form.recipient.taker_email = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.recipient.taker_email.$error && v$.recipient.taker_email.required.$invalid"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
          <span v-if="v$.recipient.taker_email.email.$invalid" class="signin_errorMsg signin_errorMsg--show">Pole jest niepoprawnym adresem E-mail</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Numer telefonu<i>*</i></label>
          <input type="text" id="" name="" :value="form.recipient.taker_phone"
                 @change="form.recipient.taker_phone = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit" v-no-letters/>
          <span v-if="v$.recipient.taker_phone.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300" v-if="countriesRequiredState.includes(form.package.country_code)">
          <label for="" class="form_label">Stan/Prowincja<i>*</i></label>
          <input type="text" id="" name="" :value="form.recipient.state"
                 @change="form.recipient.state = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.recipient.state.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>