<template>
  <div
      class="form_card"
      id="przesylka"
      v-on:mouseenter.stop="updateStatusForSection('packages', v$.$invalid)"
      v-on:mouseleave="updateStatusForSection('packages', v$.$invalid)"
  >
    <div class="row">
      <div class="row row--alignStart row--baseline">
        <h2 class="form_title">Przesyłka</h2>
      </div>
    </div>

    <OrderAutomationPackageTemplate/>

    <div class="form_firstSection form_firstSection--parcelType">
      <div class="orderForm_col1 orderForm_col1--parcelType">
        <div class="row">
          <h3 class="form_subtitle">Rodzaj przesyłki</h3>
        </div>

        <div class="row row--gap16 row--alignStart">
          <input type="radio" :id="'radio-package-1'+0" name="typPaczki" value="" class="form_radioInput"/>
          <label :for="'radio-package-1'+0"
                 class="form_parcelTypeRadioLabel"
                 @click.prevent="selectPackageDeliveryType('package')"
                 :style="isSelectedDeliveryType('package') ? 'border: 2px solid #4285F4;' : ''"
          >
            <NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>
            <span>Paczka</span>
          </label>

          <input type="radio" :id="'radio-envelope-2'+0" name="typPaczki" value="" class="form_radioInput"/>
          <label :for="'radio-envelope-2'+0"
                 class="form_parcelTypeRadioLabel"
                 @click.prevent="selectPackageDeliveryType('envelope')"
                 :style="isSelectedDeliveryType('envelope') ? 'border: 2px solid #4285F4;' : ''"
          >
            <NuxtImg src="icons/kopertaKalkulator.png" width="31px" height="19px" style="margin-bottom: 6px"/>
            <span>Koperta</span>
          </label>

          <input type="radio" :id="'radio-pallet-3'+0" name="typPaczki" value="" class="form_radioInput"/>
          <label :for="'radio-pallet-3'+0"
                 class="form_parcelTypeRadioLabel"
                 @click.prevent="selectPackageDeliveryType( 'pallet')"
                 :style="isSelectedDeliveryType('pallet') ? 'border: 2px solid #4285F4;' : ''"
          >
            <NuxtImg src="icons/paletaKalkulator.png" width="42px" height="23px"/>
            <span>Paleta</span>
          </label>

          <input type="radio" :id="'radio-nonstandard-4'+0" name="typPaczki" value="" class="form_radioInput"/>
          <label :for="'radio-nonstandard-4'+0"
                 class="form_parcelTypeRadioLabel"
                 @click.prevent="selectPackageDeliveryType( 'not_standard')"
                 :style="isSelectedDeliveryType('not_standard') ? 'border: 2px solid #4285F4;' : ''"
          >
            <NuxtImg src="icons/niestandardKalkulator.png" width="26px" height="26px"/>
            <span>Niestandardowa</span>
          </label>
        </div>
        <span v-if="v$.type.$error"
              class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
      </div>

      <div style="display: flex; flex-direction: column; width: 100%;">
        <div class="row">
          <div>
            <div class="row">
              <h3 class="form_subtitle">Parametry paczki</h3>
            </div>

            <div class="row row--alignStart row--gap16">
              <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                <label for="" class="form_label">Długość<i>*</i></label>

                <div class="form_inputWithUnit"
                     :class="v$.side_x.$error ? 'form_inputWithUnit--error' : ''">
                  <input type="text" v-model="form.package.side_x" class="form_inputTxt"
                         @change="updateCourierSearchField($event.target.value, 'side_x')"
                         v-no-letters
                  />
                  <span class="form_unitInfo">cm</span>
                </div>
                <span v-if="v$.side_x.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>

              <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                <label for="" class="form_label">Szerokość<i>*</i></label>
                <div class="form_inputWithUnit"
                     :class="v$.side_y.$error ? 'form_inputWithUnit--error' : ''">
                  <input type="text" v-model="form.package.side_y" class="form_inputTxt"
                         @change="updateCourierSearchField($event.target.value, 'side_y')"
                         v-no-letters
                  />
                  <span class="form_unitInfo">cm</span>
                </div>
                <span v-if="v$.side_y.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>

              <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                <label for="" class="form_label">Wysokość<i>*</i></label>
                <div class="form_inputWithUnit"
                     :class="v$.side_z.$error ? 'form_inputWithUnit--error' : ''">
                  <input type="text" v-model="form.package.side_z" class="form_inputTxt"
                         @change="updateCourierSearchField($event.target.value, 'side_z')"
                         v-no-letters
                  />
                  <span class="form_unitInfo">cm</span>
                </div>
                <span v-if="v$.side_z.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>

              <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                <label for="" class="form_label">Waga<i>*</i></label>
                <div class="form_inputWithUnit"
                     :class="v$.weight.$error ? 'form_inputWithUnit--error' : ''">
                  <input
                      type="text"
                      v-model="form.package.weight" class="form_inputTxt"
                      @change="updateCourierSearchField($event.target.value, 'weight');"
                      v-no-letters
                      v-replace-comma-to-dot
                  />
                  <span class="form_unitInfo">kg</span>
                </div>
                <span v-if="v$.weight.maxValue.$invalid" class="signin_errorMsg signin_errorMsg--show">Maksymalna waga to {{
                    weightMaxValue
                  }}kg</span>
                <span v-if="v$.weight.$error && !v$.weight.maxValue.$invalid"
                      class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>
            </div>

            <div class="row row--alignStart row--gap16">
              <div class="form_inputContainer300" v-show="getSortablesByPackageTypeOptions.length > 0">
                <label for="" class="form_subtitle form_subtitle--block">Kształt i rodzaj opakowania<i>*</i>
                  <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                           @click="selectedHelpModalKey = 'package_type'; showHelpModal = true"/>
                </label>

                <InputFilterSelect
                    :container-class="v$.sortable.$error ? 'form_inputContainer300 form_inputContainer300--error' : 'form_inputContainer300'"
                    v-if="getSortablesByPackageTypeOptions.length > 0"
                    :options="getSortablesByPackageTypeOptions"
                    v-model="form.package.sortable"
                    @change="updateSortable($event)"
                    :value="form.package.sortable"
                    :base-value="form.package.sortable"
                />
                <span v-if="v$.sortable.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>
              <div class="form_inputContainer300" v-show="getSortablesByPackageTypeOptions.length === 0">
                <span>{{ getSortablesByPackageTypeOptions.length > 0 ? getSortablesByPackageTypeOptions[0].name : '' }}</span>
              </div>

              <div class="form_inputContainer300">
                <label for="" class="form_subtitle">Zawartość przesyłki<i>*</i></label>
                <div class="form_inputWithUnit form_inputWithUnit--wrap"
                     :class="v$.package_content.$error ? 'form_inputWithUnit--error' : ''"
                >
                  <input type="text" id="package_content" name="package_content"
                         :value="form.package.package_content"
                         @change="form.package.package_content = $event.target.value"
                         class="form_inputTxt form_inputTxt--withoutUnit"/>
                </div>
                <span v-if="v$.package_content.$error"
                      class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>
            </div>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300 form_inputContainer300--gap16">
              <InputCountrySelector :disabled="true"
                                    @country-change="(event) => updateCourierSearchField(event, 'postal_sender_country')"/>

              <div class="form_inputContainer200 form_inputContainer200--postal">
                <label for="" class="form_label">Kod pocztowy nadawcy<i>*</i></label>
                <input type="text" id="" name=""
                       :value="form.sender.vat_postal"
                       v-maska="'##-###'"
                       @change="form.sender.vat_postal = $event.target.value"
                       class="form_inputTxt form_inputTxt--withoutUnit"/>
                <span v-if="vSender$.vat_postal.$error" class="signin_errorMsg signin_errorMsg--show">{{vSender$.vat_postal.$errors[0].$message}}</span>
                <span v-if="vSender$.vat_postal.postalRegex.$invalid" class="signin_errorMsg signin_errorMsg--show">Poprawny format dla kodu pocztowego to XX-XXX</span>
              </div>
            </div>

            <div class="form_inputContainer300 form_inputContainer300--gap16">
              <InputCountrySelector
                  :by-short-name="form.package.country_code"
                  @country-change="(event) => {updateCourierSearchField(event.shortName, 'country_code'); form.recipient.country = event.shortName}"/>

              <div class="form_inputContainer200 form_inputContainer200--postal">
                <label for="" class="form_label">Kod pocztowy odbiorcy<i>*</i></label>
                <input type="text" id="" name="" :value="form.recipient.taker_postal"
                       @change="form.recipient.taker_postal = $event.target.value; updateMapUrl"
                       class="form_inputTxt form_inputTxt--withoutUnit"/>
                <span v-if="vRecipient$.taker_postal.required.$invalid && vRecipient$.taker_postal.$error" class="signin_errorMsg signin_errorMsg--show">{{vRecipient$.taker_postal.$errors[0].$message}}</span>
                <span v-if="vRecipient$.taker_postal.postalRegex.$invalid"
                      class="signin_errorMsg signin_errorMsg--show">Poprawny format dla kodu pocztowego to XX-XXX</span>
              </div>
            </div>
          </div>

          <div class="row row--alignStart row--gap16">
            <div class="form_inputContainer300">
              <div class="row">
                <h3 class="form_subtitle">Sposób nadania<i>*</i>
<!--                  <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"/>-->
                </h3>
              </div>

              <div class="row row--gap16 row--orderForm">
                <input type="radio" id="radio50" name="typeOfSending" class="form_radioInput"
                       @change="updatePickup(false)" :checked="form.package.no_pickup === false"/>
                <label for="radio50" class="form_radioLabelTile form_radioLabelTile--wideMobile">odbiór przez
                  kuriera</label>

                <input type="radio" id="radio51" name="typeOfSending" class="form_radioInput"
                       @change="updatePickup(true)"
                       v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                       :checked="form.package.no_pickup === true"/>
                <label for="radio51" class="form_radioLabelTile form_radioLabelTile--wideMobile"
                       v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                >dostarczę przesyłkę do punktu</label>
                <span
                    v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                    v-if="v$.no_pickup.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>
            </div>

            <div class="form_inputContainer300">
              <div class="row">
                <h3 class="form_subtitle">Sposób doręczenia<i>*</i></h3>
              </div>

              <div class="row row--gap16 row--orderForm">
                <input type="radio" id="radio40" name="typeDelivery" value="" class="form_radioInput"
                       @change="form.package.delivery_type = 'to_door'; showRecipientMap = false"
                       :checked="form.package.delivery_type === 'to_door'"/>
                <label for="radio40" class="form_radioLabelTile form_radioLabelTile--wideMobile">kurier</label>

                <input type="radio" id="radio41" name="typeDelivery" value="" class="form_radioInput"
                       v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                       @change="form.package.delivery_type = 'to_point'; showRecipientMap = true"
                       :checked="form.package.delivery_type === 'to_point'"/>
                <label for="radio41" class="form_radioLabelTile form_radioLabelTile--wideMobile"
                       v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                >punkt odbioru</label>
                <span
                    v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                    v-if="v$.delivery_type.$error"
                    class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>
            </div>
          </div>
        </div>

        <div class="row row--orderForm" v-for="(formPackage, index) in form.SearchParcel" :key="index">
          <div>
            <div class="row">
              <h3 class="form_subtitle">Parametry paczki</h3>
            </div>

            <div class="row row--alignStart row--gap16">
              <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                <label for="" class="form_label">Długość</label>
                <div class="form_inputWithUnit ">
                  <input type="text" v-model="formPackage.side_x" class="form_inputTxt"
                         @change="updatePackageField(index, 'side_x', $event.target.value)" v-no-letters/>
                  <span class="form_unitInfo">cm</span>
                </div>
              </div>

              <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                <label for="" class="form_label">Szerokość</label>
                <div class="form_inputWithUnit">
                  <input type="text" v-model="formPackage.side_y" class="form_inputTxt"
                         @change="updatePackageField(index, 'side_y', $event.target.value)" v-no-letters/>
                  <span class="form_unitInfo">cm</span>
                </div>
              </div>

              <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                <label for="" class="form_label">Wysokość</label>
                <div class="form_inputWithUnit">
                  <input type="text" v-model="formPackage.side_z" class="form_inputTxt"
                         @change="updatePackageField(index, 'side_z', $event.target.value)" v-no-letters/>
                  <span class="form_unitInfo">cm</span>
                </div>
              </div>

              <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                <label for="" class="form_label">Waga</label>
                <div class="form_inputWithUnit">
                  <input type="text" v-model="formPackage.weight" class="form_inputTxt"
                         @change="updatePackageField(index, 'weight', $event.target.value)"
                         v-no-letters
                         v-replace-comma-to-dot
                  />
                  <span class="form_unitInfo">kg</span>
                </div>
              </div>
            </div>

            <div class="row row--alignStart row--gap16" v-show="getSortablesByPackageTypeOptions.length >= 0">
              <div class="form_inputContainer300">
                <label for="" class="form_subtitle form_subtitle--block">Kształt i rodzaj opakowania<i>*</i>
                  <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                           @click="selectedHelpModalKey = 'package_type'; showHelpModal = true"/>
                </label>

                <InputFilterSelect
                    v-if="getSortablesByPackageTypeOptions.length >= 1"
                    :base-value="formPackage.sortable"
                    :model="formPackage.sortable"
                    :options="getSortablesByPackageTypeOptions"
                    @change="updatePackageField(index, 'sortable', $event)"
                />
                <span v-else>{{ getSortablesByPackageTypeOptions.length > 0 ? getSortablesByPackageTypeOptions[0].name : '' }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row row--orderForm">
      <button class="form_buttonSecondary" @click.prevent="addEmptyPackage()">Dodaj kolejną paczkę</button>
      <button class="form_buttonDanger" @click.prevent="deleteLastPackage()"
              v-show="form.SearchParcel.length > 0">Usuń paczkę z zamówienia
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";
import {useVuelidate} from "@vuelidate/core";
import {email, maxValue, requiredIf} from "@vuelidate/validators";
const { required } = useI18nValidators();
import {vMaska} from "maska/vue"
import {useI18nValidators} from "~/helpers/vuelidate-translations";
import useHelpModalStore from "~/stores/panel/useHelpModalStore";

const { selectedHelpModalKey, showHelpModal } = storeToRefs(useHelpModalStore());
const {
  addEmptyPackage,
  selectPackageDeliveryType,
  isSelectedDeliveryType,
  updatePackageField,
  deleteLastPackage,
  updateStatusForSection,
  updateSortable,
  updateCourierSearchField,
  updatePickup,
  fetchValuationResults,
  sectionIsComplete,
  updateMapUrl,
  getSectionStatusByStatus
} = useOrderFormV2Store();

const {
  form,
  sectionsDone,
  showRecipientMap,
} = storeToRefs(useOrderFormV2Store());

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

const weightMaxValue = computed(() => {
  switch (form.value.package.type) {
    case 'package':
      return 70.0;
    case 'envelope':
      return 70.0;
    case 'pallet':
      return 1000.0;
    case 'not_standard':
      return 1000.0;
    default:
      return 70.0;
  }
})

const rules = computed(() => {
  return {
    delivery_type: {required},
    no_pickup: {required},
    type: {required},
    weight: {required, maxValue: maxValue(weightMaxValue)},
    side_x: {required},
    side_y: {required},
    side_z: {required},
    sortable: {requiredIf: requiredIf(() => form.value.package.type === 'package' || form.value.package.type === 'envelope')},
    package_content: {required},
  }
})

const rulesSender = computed(() => {
  return {
    vat_postal: {required, postalRegex: postalRegex},
  }
})

const rulesRecipient = computed(() => {
  return {
    taker_postal: {required, postalRegex: postalRegex},
  }
})

const getSortablesByPackageTypeOptions = computed(() => {
  if (!form.value.package.type) {
    return [];
  }

  if (form.value.package.type === 'pallet') {
    form.value.package.delivery_type = 'to_door';
    form.value.package.no_pickup = false;
  }

  if (form.value.package.type === 'envelope') {
    if (form.value.package.sortable == false) {
      form.value.package.sortable = null;
    }

    return [
      { code: true, name: 'Standardowa' },
    ]
  }

  if (form.value.package.type === 'not_standard') {
    form.value.package.delivery_type = 'to_door';
    form.value.package.no_pickup = false;

    if (form.value.package.sortable == true) {
      form.value.package.sortable = null;
    }

    return [
      { code: false, name: 'Niestandardowa' },
    ]
  }

  return [
    { code: true, name: 'Standardowa' },
    { code: false, name: 'Niestandardowa' },
  ]
});

const v$ = useVuelidate(rules, form.value.package);
const vSender$ = useVuelidate(rulesSender, form.value.sender);
const vRecipient$ = useVuelidate(rulesRecipient, form.value.recipient);

watch(() => form.value?.package, async () => {
  v$.value.$touch();
  vSender$.value.$touch();
  vRecipient$.value.$touch();

  sectionIsComplete('packages', false);
  fetchIfValid();
}, {deep: true});

watch(() => form.value.sender.vat_postal, () => {
  vSender$.value.$touch();

  fetchIfValid();
}, {deep: true});

watch(() => form.value.recipient.taker_postal, () => {
  vRecipient$.value.$touch();

  fetchIfValid();
}, {deep: true});

const fetchIfValid = () => {
  if (!v$.value.$error && !vSender$.value.$error && !vRecipient$.value.$error && v$.value.$silentErrors.length === 0) {
    fetchValuationResults();
  }
}

watch(() => v$.value.$invalid, (value) => {
  if (value) {
    sectionsDone.value.packages = getSectionStatusByStatus('error');
  }
})

watch(() => vRecipient$.value.$invalid, (value) => {
  if (value) {
    sectionsDone.value.packages = getSectionStatusByStatus('error');
  } else {
    updateStatusForSection('packages', null);
  }
})

watch(() => vSender$.value.$invalid, (value) => {
  if (value) {
    sectionsDone.value.packages = getSectionStatusByStatus('error');
  } else {
    updateStatusForSection('packages', null);
  }
})
</script>

<style scoped>

</style>