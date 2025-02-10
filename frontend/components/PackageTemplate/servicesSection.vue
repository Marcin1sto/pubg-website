<template>
  <div class="form_card" id="uslugi">
    <div style="display: flex; justify-content: space-between; width: 100%">
      <div class="row row--alignStart row--baseline" style="flex-wrap: wrap">
        <h2 class="form_title">Usługi</h2>
      </div>
      <div>
        <div class="orderForm_stickyBarSwitchContainer">
          <label for="visibilitySwitch2" class="orderForm_stickyBarTxt">Wybierz</label>
          <label class="switch">
            <input id="visibilitySwitch2" type="checkbox" :checked="showServicesDetails"
                   @change.prevent="showServicesDetails = $event.target.checked">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
    </div>

    <div class="row row--orderForm" v-show="showServicesDetails">
      <div class="form_inputContainer300">
        <label for="" class="form_label">Ubezpieczenie
          <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                   @click.prevent="showInfoModalType = 'insurance'; showInfoModal = true"/>
        </label>
        <div class="form_inputWithUnit">
          <input type="text" id="" name="cover" class="form_inputTxt" :value="form.cover"
                 inputmode="numeric"
                 v-maska="'0.99'"
                 data-maska-tokens="0:\d:multiple|9:\d:optional"
                 @change="form.cover = $event.target.value == '' ? 0 : $event.target.value" v-no-letters/>
          <span class="form_unitInfo">zł</span>
        </div>
      </div>

      <div class="form_inputContainer300">
        <label for="" class="form_label">Pobranie
          <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                   @click.prevent="showInfoModalType = 'uptake'; showInfoModal = true"/>
        </label>
        <div class="form_inputWithUnit">
          <input type="text" id="" name="uptake" class="form_inputTxt" :value="form.uptake"
                 inputmode="numeric"
                 v-maska="'0.99'"
                 data-maska-tokens="0:\d:multiple|9:\d:optional"
                 @change="form.uptake = $event.target.value == '' ? 0 : $event.target.value" v-no-letters/>
          <span class="form_unitInfo">zł</span>
        </div>
      </div>

      <div class="row row--checkboxContainer"
           v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')">
        <input type="checkbox" id="usluga1" name="usluga1"
               @change="form.inpost_weekend = $event.target.checked"
               :checked="form.inpost_weekend"/>
        <label for="usluga1" class="form_checkboxLabel">Paczka w weekend (InPost)</label>
      </div>

      <div class="row row--checkboxContainer" v-show="isSelectedDeliveryType('pallet')">
        <input type="checkbox" id="usluga2" name="usluga2"
               @change="(event) => {form.delivery_private = event.target.checked}"
               :checked="form.delivery_private"/>
        <label for="usluga2" class="form_checkboxLabel">Adres prywatny</label>
      </div>

      <div class="row row--checkboxContainer" v-show="isSelectedDeliveryType('pallet')">
        <input type="checkbox" id="usluga3" name="usluga3"
               @change="form.return_pallet = $event.target.checked"
               :checked="form.return_pallet"/>
        <label for="usluga3" class="form_checkboxLabel">Zwrot palet</label>
      </div>

      <div class="row row--checkboxContainer" v-show="isSelectedDeliveryType('not_standard')">
        <input type="checkbox" id="usluga4" name="usluga4"
               @change="form.bringing = $event.target.checked"/>
        <label for="usluga4" class="form_checkboxLabel">Wniesienie</label>
      </div>

      <div class="row row--checkboxContainer" v-show="isSelectedDeliveryType('not_standard')">
        <input type="checkbox" id="usluga5" name="usluga5"
               @change="form.bringing_and_unpack = $event.target.checked"/>
        <label for="usluga5" class="form_checkboxLabel">Wniesienie i rozpakowanie</label>
      </div>
    </div>

    <p class="prices_infoTxt" style="margin-top: 5px">Jeżeli chcesz wybrać dedykowane usługi, wybierz rodzaj przesyłki.</p>
  </div>
</template>

<script setup lang="ts">
import usePackageTemplateStore from "~/stores/panel/usePackageTemplateStore";
import { vMaska } from "maska/vue"
import {MaskInput} from "maska";

const { form, showServicesDetails, showInfoModal, showInfoModalType } = storeToRefs(usePackageTemplateStore());
const { selectPackageDeliveryType, isSelectedDeliveryType } = usePackageTemplateStore();

new MaskInput(".maska");
</script>

<style scoped>

</style>