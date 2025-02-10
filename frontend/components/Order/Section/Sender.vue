<script setup lang="ts">
import VueDatePicker from "@vuepic/vue-datepicker";
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";
import {useVuelidate} from "@vuelidate/core";
import {email, required} from "@vuelidate/validators";
import {vMaska} from "maska/vue"
import useHelpModalStore from "~/stores/panel/useHelpModalStore";

const {form, showAddressBookModal, showAddressBookModalType, pickupDateOptions, sectionsDone} = storeToRefs(useOrderFormV2Store());
const {
  updateStatusForSection,
  fetchPickupDateOptions,
  onDateChange,
  updatePickupReadyTime,
  calculateMinCloseTime,
  calculateMaxReadyTime,
  getSectionStatusByStatus
} = useOrderFormV2Store();
const {selectedHelpModalKey, showHelpModal} = storeToRefs(useHelpModalStore());

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
    sender: {
      name: {required},
      vat_street: {required},
      vat_house_no: {required},
      vat_locum_no: {},
      vat_postal: {required, postalRegex},
      vat_city: {required},
      email: {required, email},
      phone: {required},
      vat_company: {},
    },
  }
})
const v$ = useVuelidate(rules, form.value);

watch(() => form.value.sender, () => {
  v$.value.sender.$touch();
}, {deep: true});

onMounted(() => {
  fetchPickupDateOptions();
});

watch(() => form.value.courier, () => {
  if (form.value.courier) {
    fetchPickupDateOptions();
  }
});

watch(() => form.value.sender.vat_postal, () => {
  if (form.value.sender.postal_code) {
    fetchPickupDateOptions();
  }
});

const addWeekdays = (date, days) => {
  let result = new Date(date);
  let count = 0;

  while (count < days) {
    result.setDate(result.getDate() + 1);
    if (result.getDay() !== 0 && result.getDay() !== 6) {
      count++;
    }
  }

  return result;
}

const minOrderDate = computed(() => {
  if (pickupDateOptions.value?.min_date) {
    return pickupDateOptions.value.min_date;
  }

  const date = new Date();

  // Sformatuj datę do formatu YYYY-MM-DD
  let year = date.getFullYear();
  let month = (date.getMonth() + 1).toString().padStart(2, '0');
  let day = date.getDate().toString().padStart(2, '0');

  return `${year}-${month}-${day}`;
});

const maxOrderDate = computed(() => {
  let date;
  if (pickupDateOptions.value?.min_date) {
    date = pickupDateOptions.value.min_date;
  } else {
    date = new Date();
  }

  const newDate = addWeekdays(date, 3);

  // Sformatuj datę do formatu YYYY-MM-DD
  let year = newDate.getFullYear();
  let month = (newDate.getMonth() + 1).toString().padStart(2, '0');
  let day = newDate.getDate().toString().padStart(2, '0');

  return `${year}-${month}-${day}`;
});

const startTime = computed(() => {
  return pickupDateOptions.value?.start_time || { hours : 8, minutes : 0 };
});

const minTime = computed(() => {
  return pickupDateOptions.value?.min_time || { hours : 8, minutes : 0 };
});

const maxTime = computed(() => {
  return pickupDateOptions.value?.max_time || { hours : 17, minutes : 0 };
});

const minDiff = computed(() => {
  return pickupDateOptions.value?.min_diff || 120;
});

watch(() => v$.value.$invalid, (value) => {
  if (value) {
    sectionsDone.value.sender = getSectionStatusByStatus('error');
  }
})
</script>

<template>
  <div class="form_card" id="nadanie"
       v-on:mouseenter.stop="updateStatusForSection('sender', v$.$invalid)"
       v-on:mouseleave="updateStatusForSection('sender', v$.$invalid)">
    <div class="row">
      <h2 class="form_title">Nadanie</h2>
    </div>

    <div class="row row--orderForm">
      <div class="row row--alignStart row--baseline">
        <h3 class="form_subtitle">Dane nadawcy
          <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                   @click="selectedHelpModalKey = 'sender_details'; showHelpModal = true"/>
        </h3>
        <span class="form_infoTxt form_infoTxt--marginLeft">
          <button style="text-decoration: underline;"
                  @click.prevent="showAddressBookModal = true; showAddressBookModalType = 'sender'">Pobierz z książki adresowej</button></span>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Imię i nazwisko<i>*</i></label>
          <input type="text" id="" name="" :value="form.sender.name"
                 @change="form.sender.name = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.sender.name.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Nazwa firmy</label>
          <input type="text" id="" name="" :value="form.sender.vat_company"
                 @change="form.sender.vat_company = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.sender.vat_company.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Ulica<i>*</i></label>
          <input type="text" id="" name="" :value="form.sender.vat_street"
                 @change="form.sender.vat_street = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.sender.vat_street.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer142 form_inputContainer142--wideMobile">
          <label for="" class="form_label">Numer budynku<i>*</i></label>
          <input type="text" id="" name="" :value="form.sender.vat_house_no"
                 @change="form.sender.vat_house_no = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.sender.vat_house_no.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer142 form_inputContainer142--wideMobile">
          <label for="" class="form_label">Numer mieszkania</label>
          <input type="text" id="" name="" :value="form.sender.vat_locum_no"
                 @change="form.sender.vat_locum_no = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.sender.vat_locum_no.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <InputCountrySelector :disabled="true"/>

        <div class="form_inputContainer200 form_inputContainer200--postal">
          <label for="" class="form_label">Kod pocztowy<i>*</i></label>
          <input type="text" id="" name="" :value="form.sender.vat_postal"
                 v-maska="'##-###'"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.sender.vat_postal.$error"
                class="signin_errorMsg signin_errorMsg--show">{{ v$.sender.vat_postal.$errors[0].$message }}</span>
          <span v-if="v$.sender.vat_postal.postalRegex.$invalid" class="signin_errorMsg signin_errorMsg--show">Poprawny format dla kodu pocztowego to XX-XXX</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Miasto<i>*</i></label>
          <input type="text" id="" name="" :value="form.sender.vat_city"
                 @change="form.sender.vat_city = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.sender.vat_city.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Adres e-mail<i>*</i></label>
          <input type="text" id="" name="" :value="form.sender.email"
                 @change="form.sender.email = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.sender.email.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Numer telefonu<i>*</i></label>
          <input type="text" id="" name="" :value="form.sender.phone"
                 @change="form.sender.phone = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit" v-no-letters/>
          <span v-if="v$.sender.phone.$error"
                class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="form_deliveryContainer" v-if="form.package.no_pickup === false">
        <h3 class="form_subtitle">Data przyjazdu kuriera:</h3>
        <div class="row row--gap16 row--orderForm">
          <InputFilterDatepicker
              label="Data odbioru"
              :disable-year-select="false"
              :min-date="minOrderDate"
              :max-date="maxOrderDate"
              :disabled-week-days="[0, 6]"
              :max-time="{}"
              @change="onDateChange($event)"
              :value="form?.pickup?.pickup_date"
          />
          <div class="form_inputContainer200">
            <label class="form_label">Godzina odbioru od:</label>
            <VueDatePicker
                :min-time="form?.pickup?.pickup_date === minOrderDate ? startTime : minTime"
                :max-time="calculateMaxReadyTime(maxTime, minDiff)"
                :date-format="'HH:ii'"
                cancelText="Anuluj"
                selectText="Wybierz"
                :start-time="form?.pickup?.pickup_date === minOrderDate ? startTime : minTime"
                @update:model-value="updatePickupReadyTime($event, minDiff)"
                v-model="form.pickup.pickup_ready_time" time-picker/>
          </div>
          <div class="form_inputContainer200">
            <label class="form_label">Godzina odbioru do:</label>
            <VueDatePicker
                :min-time="calculateMinCloseTime(minOrderDate, startTime, minTime, minDiff)"
                :max-time="maxTime"
                :date-format="'HH:ii'"
                cancelText="Anuluj"
                selectText="Wybierz"
                :start-time="maxTime"
                @update:model-value="form.pickup.pickup_close_time = $event"
                v-model="form.pickup.pickup_close_time" time-picker/>
          </div>
        </div>
        <span class="form_label">Termin przyjazdu kuriera zależy od ich dostępności w danym rejonie.</span>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>