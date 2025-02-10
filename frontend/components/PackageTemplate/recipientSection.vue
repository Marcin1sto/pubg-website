<template>
  <div class="form_card">
    <div style="display: flex; justify-content: space-between; width: 100%">
      <div class="row row--alignStart row--baseline">
        <h2 class="form_title">Odbiorca</h2>
      </div>
      <div>
        <div class="orderForm_stickyBarSwitchContainer">
          <label for="visibilitySwitch2" class="orderForm_stickyBarTxt">Wybierz</label>
          <label class="switch">
            <input id="visibilitySwitch2" type="checkbox" :checked="showRecipientDetails"
                   @change.prevent="showRecipientDetails = $event.target.checked">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
    </div>

    <!--      TODO: form-->
  </div>
</template>

<script setup lang="ts">
import usePackageTemplateStore from "~/stores/panel/usePackageTemplateStore";
import {email, maxLength, required} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";

const { form, showRecipientDetails, showInfoModal, showInfoModalType } = storeToRefs(usePackageTemplateStore());

const rules = computed(() => {
  return {
    taker_city: {maxLength: maxLength(100)},
    taker_email: {email, maxLength: maxLength(100)},
    taker_house_no: {maxLength: maxLength(100)},
    taker_locum_no: {maxLength: maxLength(100)},
    taker_name: {maxLength: maxLength(100)},
    taker_phone: {maxLength: maxLength(100)},
    taker_postal: {maxLength: maxLength(100)},
    taker_street: {maxLength: maxLength(100)},
    taker_vat_company: {maxLength: maxLength(250)},
    taker_point: {maxLength: maxLength(255)},
    package_content: {maxLength: maxLength(200)}
  };
});
const v$ = useVuelidate(rules, form.value);

</script>
