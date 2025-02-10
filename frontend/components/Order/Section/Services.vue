<script setup lang="ts">
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";
import {email, helpers, required, requiredIf} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import useHelpModalStore from "~/stores/panel/useHelpModalStore";

const { form } = storeToRefs(useOrderFormV2Store());
const { updateCourierSearchField, isSelectedDeliveryType, updateStatusForSection } = useOrderFormV2Store();
const { selectedHelpModalKey, showHelpModal } = storeToRefs(useHelpModalStore());

const customNipValidator = helpers.withMessage(
    "Nieprawidłowy numer NIP",
    (value) => {
      if (!value || value.trim() === '') return true;
      if (typeof value !== "string") return false;

      const nip = value.replace(/-/g, "");

      if (nip.length !== 10 || !/^\d{10}$/.test(nip)) {
        return false;
      }

      const weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];

      const checksum =
          nip
              .split("")
              .slice(0, 9)
              .reduce((acc, digit, index) => acc + parseInt(digit, 10) * weights[index], 0) % 11;

      return checksum === parseInt(nip[9], 10);
    }
);

const rules = computed(() => {
  return {
    services: {
      cover: {},
      uptake: {},
      inpost_weekend: {},
      delivery_private: {},
      taker_vat_number: {
        requiredIf: requiredIf(() =>
            form.value.services.delivery_private === false &&
            form.value.courier?.Courier?.private_delivery_fee === true
        ),
        customNipValidator: customNipValidator,
      },
    }
  }
})

const v$ = useVuelidate(rules, form.value);

watch(() => form.value.services.delivery_private,
    async (newValue) => {
      v$.value.services.$touch();
      if (newValue === true) {
        const errors = v$.value?.services?.taker_vat_number?.$errors;
        if (errors && errors.length) {
          v$.value.services.taker_vat_number.$reset();
        }

        form.value.services.taker_vat_number = null;
      }
    }, {deep: true});
</script>

<template>
  <div class="form_card" id="uslugi"
       v-on:mouseenter.stop="updateStatusForSection('services', v$.$invalid)"
       v-on:mouseleave.stop="updateStatusForSection('services', v$.$invalid)">
    <div class="row">
      <h2 class="form_title">Usługi</h2>
    </div>

    <div class="row row--orderForm">
      <div class="form_inputContainer300">
        <label for="" class="form_label">Ubezpieczenie
          <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                   @click.prevent="selectedHelpModalKey = 'insurance'; showHelpModal = true"/>
        </label>
        <div class="form_inputWithUnit">
          <input type="text" id="" name="cover" class="form_inputTxt" :value="form.services.cover"
                 inputmode="numeric"
                 v-maska="'0.99'"
                 data-maska-tokens="0:\d:multiple|9:\d:optional"
                 @change="updateCourierSearchField($event.target.value == '' ? 0 : $event.target.value, 'cover'); form.services.cover = $event.target.value == '' ? 0 : $event.target.value" v-no-letters/>
          <span class="form_unitInfo">zł</span>
        </div>
      </div>

      <div class="form_inputContainer300">
        <label for="" class="form_label">Pobranie
          <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                   @click.prevent="selectedHelpModalKey = 'uptake'; showHelpModal = true"/>
        </label>
        <div class="form_inputWithUnit">
          <input type="text" id="" name="uptake" class="form_inputTxt" :value="form.services.uptake"
                 inputmode="numeric"
                 v-maska="'0.99'"
                 data-maska-tokens="0:\d:multiple|9:\d:optional"
                 @change="updateCourierSearchField($event.target.value == '' ? 0 : $event.target.value, 'uptake'); form.services.uptake = $event.target.value == '' ? 0 : $event.target.value" v-no-letters/>
          <span class="form_unitInfo">zł</span>
        </div>
      </div>

      <div class="row row--checkboxContainer"
           v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')">
        <input type="checkbox" id="usluga1" name="usluga1"
               @change="updateCourierSearchField($event.target.checked, 'inpost_weekend'); form.services.inpost_weekend = $event.target.checked"
               :checked="form.services.inpost_weekend"/>
        <label for="usluga1" class="form_checkboxLabel">Paczka w weekend (InPost)</label>
      </div>

      <div class="row row--checkboxContainer"
           v-show="isSelectedDeliveryType('package')">
        <input type="checkbox" id="usluga_fragile" name="usluga_fragile"
               @change="updateCourierSearchField($event.target.checked, 'fragile'); form.services.fragile = $event.target.checked"
               :checked="form.services.fragile"/>
        <label for="usluga_fragile" class="form_checkboxLabel">Ostrożnie (Pocztex)</label>
      </div>

      <div class="row row--gap16" v-show="isSelectedDeliveryType('pallet') && form.courier?.Courier?.private_delivery_fee === true">
        <div class="row row--checkboxContainer">
          <input
              type="radio"
              id ="usluga2_private"
              value="true"
              name="delivery_private"
              @change="updateCourierSearchField('true', 'delivery_private'); form.services.delivery_private = true"
              :checked="form.services.delivery_private === true"
          />
          <label for="usluga2_private" class="form_checkboxLabel">Adres prywatny</label>
        </div>

        <div class="row row--checkboxContainer">
          <input
              type="radio"
              id="usluga2_business"
              value="false"
              name="delivery_private"
              @change="updateCourierSearchField('false', 'delivery_private'); form.services.delivery_private = false; form.services.taker_vat_number = null"
              :checked="form.services.delivery_private === false"
          />
          <label for="usluga2_business" class="form_checkboxLabel">Adres firmowy
            <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                     @click.prevent="selectedHelpModalKey = 'delivery_private'; showHelpModal = true"/>
          </label>
        </div>

        <div class="row form_inputContainer300" v-show="form.services.delivery_private === false">
          <label for="" class="form_label">Numer NIP<i>*</i></label>
          <input type="text" id="" name="" :value="form.services.taker_vat_number"
                 @change="form.services.taker_vat_number = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.services.taker_vat_number.$error && v$.services.taker_vat_number.requiredIf.$invalid" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
          <span v-show="v$.services.taker_vat_number.$errors?.find(error => error.$validator == 'customNipValidator')" class="calc_errorMsg calc_errorMsg--show">{{ v$.services.taker_vat_number.customNipValidator.$message }}</span>
        </div>
      </div>

      <div class="row row--checkboxContainer" v-show="isSelectedDeliveryType('pallet')">
        <input type="checkbox" id="usluga3" name="usluga3"
               @change="updateCourierSearchField($event.target.checked, 'return_pallet'); form.services.return_pallet = $event.target.checked"
               :checked="form.services.return_pallet"/>
        <label for="usluga3" class="form_checkboxLabel">Zwrot palet</label>
      </div>

      <div class="row row--checkboxContainer" v-show="isSelectedDeliveryType('not_standard')">
        <input type="checkbox" id="usluga4" name="usluga4"
               @change="updateCourierSearchField($event.target.checked, 'bringing'); form.services.bringing = $event.target.checked"/>
        <label for="usluga4" class="form_checkboxLabel">Wniesienie</label>
      </div>

      <div class="row row--checkboxContainer" v-show="isSelectedDeliveryType('not_standard')">
        <input type="checkbox" id="usluga5" name="usluga5"
               @change="updateCourierSearchField($event.target.checked, 'bringing_and_unpack'); form.services.bringing_and_unpack = $event.target.checked"/>
        <label for="usluga5" class="form_checkboxLabel">Wniesienie i rozpakowanie</label>
      </div>
    </div>

    <!--        na razie nie usuwać z kodu zakomentowanego fragmentu, poczekajmy na decyzję Marcinów-->
    <!--        <div class="row">-->
    <!--          <span class="calc_showMore">Pokaż wszystkie usługi dodatkowe <NuxtImg src="icons/greyArrowDown.png"/></span>-->
    <!--        </div>-->
  </div>
</template>

<style scoped>

</style>