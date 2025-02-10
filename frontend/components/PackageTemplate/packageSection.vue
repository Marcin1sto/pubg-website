<template>
  <div class="form_card">
    <div style="display: flex; justify-content: space-between; width: 100%">
      <div class="row row--alignStart row--baseline">
        <h2 class="form_title">Przesyłka</h2>
      </div>
      <div>
        <div class="orderForm_stickyBarSwitchContainer">
          <label for="visibilitySwitch2" class="orderForm_stickyBarTxt">Wybierz</label>
          <label class="switch">
            <input id="visibilitySwitch2" type="checkbox" :checked="showPackageDetails"
                   @change.prevent="showPackageDetails = $event.target.checked">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
    </div>

    <div style="display: flex; flex-direction: row; gap: 20px" v-show="showPackageDetails">
      <div class="orderForm_col1">
        <div class="row">
          <h3 class="form_subtitle">Rodzaj przesyłki</h3>
        </div>

        <div class="row row--gap16">
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
        <span v-if="v$.type.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
      </div>

      <div style="display: flex; flex-direction: column; width: 100%">
        <div class="row row--orderForm">
          <div>
            <div class="row">
              <h3 class="form_subtitle">Parametry paczki</h3>
            </div>

            <div class="row row--alignStart row--gap16">
              <div class="form_inputContainer142">
                <label for="" class="form_label">Długość</label>

                <div class="form_inputWithUnit" :class="v$.side_x.$error ? 'form_inputWithUnit--error' : ''">
                  <input type="text" v-model="form.side_x" class="form_inputTxt"
                         @change="form.side_x = $event.target.value"
                         v-no-letters
                  />
                  <span class="form_unitInfo">cm</span>
                </div>
                <span v-if="v$.side_x.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>

              <div class="form_inputContainer142">
                <label for="" class="form_label">Szerokość</label>
                <div class="form_inputWithUnit" :class="v$.side_y.$error ? 'form_inputWithUnit--error' : ''">
                  <input type="text" v-model="form.side_y" class="form_inputTxt"
                         @change="form.side_y = $event.target.value"
                         v-no-letters
                  />
                  <span class="form_unitInfo">cm</span>
                </div>
                <span v-if="v$.side_y.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>

              <div class="form_inputContainer142">
                <label for="" class="form_label">Wysokość</label>
                <div class="form_inputWithUnit" :class="v$.side_z.$error ? 'form_inputWithUnit--error' : ''">
                  <input type="text" v-model="form.side_z" class="form_inputTxt"
                         @change="form.side_z = $event.target.value"
                         v-no-letters
                  />
                  <span class="form_unitInfo">cm</span>
                </div>
                <span v-if="v$.side_z.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>

              <div class="form_inputContainer142">
                <label for="" class="form_label">Waga</label>
                <div class="form_inputWithUnit" :class="v$.weight.$error ? 'form_inputWithUnit--error' : ''">
                  <input
                      type="text"
                      v-model="form.weight" class="form_inputTxt"
                      @change="form.weight = $event.target.value"
                      v-no-letters
                  />
                  <span class="form_unitInfo">kg</span>
                </div>
                <span v-if="v$.weight.maxValue.$invalid" class="signin_errorMsg signin_errorMsg--show">Maksymalna waga to {{
                    weightMaxValue
                  }}kg</span>
                <span v-if="v$.weight.maxValue.$invalid"
                      class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>
            </div>

            <div class="row row--alignStart row--gap16">
              <div class="form_inputContainer300" v-show="getSortablesByPackageTypeOptions.length > 0">
                <label for="" class="form_subtitle">Kształt i rodzaj opakowania
                  <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                           @click="showInfoModalType = 'package_type'; showInfoModal = true"/>
                </label>

                <InputFilterSelect
                    :container-class="v$.sortable_id.$error ? 'form_inputContainer300 form_inputContainer300--error' : 'form_inputContainer300'"
                    v-if="getSortablesByPackageTypeOptions.length > 0"
                    :options="getSortablesByPackageTypeOptions"
                    v-model="form.sortable"
                    :base-value="form.sortable"
                    @change="form.sortable = $event"
                />
                <span v-else>{{
                    getSortablesByPackageTypeOptions[0] ? getSortablesByPackageTypeOptions[0].name : ''
                  }}</span>
                <span v-if="v$.sortable_id.$error"
                      class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>

              <div class="form_inputContainer300">
                <label for="" class="form_subtitle">Zawartość przesyłki</label>
                <div class="form_inputWithUnit form_inputWithUnit--wrap"
                     :class="v$.package_content.$error ? 'form_inputWithUnit--error' : ''"
                >
                  <input type="text" id="package_content" name="package_content"
                         :value="form.package_content"
                         @change="form.package_content = $event.target.value"
                         class="form_inputTxt form_inputTxt--withoutUnit"/>
                </div>
                <span v-if="v$.package_content.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import usePackageTemplateStore from "~/stores/panel/usePackageTemplateStore";
import {useVuelidate} from "@vuelidate/core";
import {maxLength, maxValue} from "@vuelidate/validators";
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";

const { form, showPackageDetails, showInfoModal, showInfoModalType } = storeToRefs(usePackageTemplateStore());
const { selectPackageDeliveryType, isSelectedDeliveryType } = usePackageTemplateStore();
const weightMaxValue = computed(() => {
  switch (form.value.type) {
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
    sortable_id: {},
    type: {maxLength: maxLength(50)},
    weight: {maxLength: maxLength(100), maxValue: maxValue(weightMaxValue)},
    side_x: {maxLength: maxLength(100)},
    side_y: {maxLength: maxLength(100)},
    side_z: {maxLength: maxLength(100)},
    package_content: {maxLength: maxLength(200)}
  };
});
const v$ = useVuelidate(rules, form.value);

const getSortablesByPackageTypeOptions = computed(() => {
  if (!form.value.type) {
    return [];
  }

  if (form.value.type === 'pallet') {
    form.value.delivery_type = 'to_door';
    form.value.no_pickup = false;
  }

  if (form.value.type === 'envelope') {
    if (form.value.sortable == false) {
      form.value.sortable = null;
    }

    return [
      { code: true, name: 'Standardowa' },
    ]
  }

  if (form.value.type === 'not_standard') {
    form.value.delivery_type = 'to_door';
    form.value.no_pickup = false;

    if (form.value.sortable == true) {
      form.value.sortable = null;
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
</script>

<style scoped>

</style>