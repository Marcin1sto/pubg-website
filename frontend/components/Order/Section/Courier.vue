<script setup lang="ts">
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";
import {useElementVisibility} from "@vueuse/core";
import useHelpModalStore from "~/stores/panel/useHelpModalStore";
import useUserStore from "~/stores/useUserStore";

const { form, valuationResults, valuation, visibleSection, valuationIsLoading } = storeToRefs(useOrderFormV2Store());
const { selectCourierPrice, updateStatusForSection } = useOrderFormV2Store();
const { selectedHelpModalKey, showHelpModal } = storeToRefs(useHelpModalStore());
const {userExternalData} = storeToRefs(useUserStore());

watch(valuationResults, () => {
  if (valuationResults.value?.data?.results && valuationResults.value.data.results.length > 0) {
    valuation.value.valuationResultsToShow = valuationResults.value?.data.results.slice(0, 5);
    valuation.value.valuationResultsWhole = valuationResults.value?.data.results;
  }
}, {deep: true});

const valuationVisible = ref(null)
const courierIsVisible = useElementVisibility(valuationVisible)

watch(() => courierIsVisible.value, () => {
  if (courierIsVisible.value) {
    visibleSection.value = visibleSection.value + ',courier';
    return;
  } else {
    visibleSection.value = visibleSection.value.replace(',courier', '');
  }
})

let isC2C = userExternalData.value.Broker.consumer_account;
</script>

<template>
  <div class="form_card" id="kurier" ref="valuationVisible"
       style="position: relative"
       v-on:mouseleave="updateStatusForSection('courier', null)"
       v-on:mouseenter.stop="updateStatusForSection('courier', null)">
    <div class="row">
      <h2 class="form_title">Kurier <span class="form_subtitleSmall">Podano ceny netto (bez VAT) z wliczoną opłatą paliwową/drogową<NuxtImg
          src="icons/tooltipIcon.png" width="11px" height="11px"
          style="margin-left: 5px; width: 11px; height: 11px;"
          @click.prevent="selectedHelpModalKey = 'courier'; showHelpModal = true"/></span></h2>
    </div>

    <div class="row row--noWarp">
      <div class="row row--gap16 orderForm_couriersRow"
           v-if="valuationResults?.data?.results && valuationResults.data.results.length > 0">
        <div v-for="(result, index) in valuation.valuationResultsWhole">
          <input type="radio" :id="'radio-'+index" name="kurier" value="" class="calc_courierRadio"/>
          <label :for="'radio-'+index" class="calc_pricingRadioLabel" @click="selectCourierPrice(result)"
                 :style="form?.courier?.Courier?.id === result.Courier.id ? 'border: 2px solid #4285F4;' : 'border: 2px solid #BDD4F2;'"
          >
            <div class="calc_courierImgWrapper">
              <NuxtImg :src="result.Courier.logo" width="50" height="" class="calc_courierImg"/>
            </div>
            <span class="calc_courierName">{{ result.Courier.name }}</span>

            <span v-if="!isC2C" class="calc_courierPrice calc_courierPrice--b2b" :style="form?.courier?.Courier?.id === result.Courier.id ? 'background-color: #4285F4; color: #ffffff' : 'background-color: #BDD4F2; color: #262B44;'">{{ result.Price.netto }} zł netto</span>
            <span v-if="!isC2C" class="calc_subtitleSmall calc_subtitleSmall--noMargin">({{ result.Price.value }} zł brutto)</span>

            <span v-if="isC2C" class="calc_courierPrice" :style="form?.courier?.Courier?.id === result.Courier.id ? 'background-color: #4285F4; color: #ffffff' : 'background-color: #BDD4F2; color: #262B44;'">{{ result.Price.value }} zł brutto</span>
          </label>
        </div>
      </div>
      <div class="row row--gap16 orderForm_couriersRow" v-else>
        <span v-if="valuationResults?.message">{{ valuationResults?.message }}</span>
        <span class="form_subtitle"
              v-else>Wypełnij wszystkie wymagane pola, aby zobaczyć dostępne oferty kuriera.</span>
      </div>
    </div>
    <FormSpinerLoaderWithText :with-text="false" :loading="valuationIsLoading"/>
  </div>
</template>

<style scoped>

</style>