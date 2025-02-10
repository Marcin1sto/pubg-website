<script setup lang="ts">
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";
import {useElementVisibility, useWindowScroll} from "@vueuse/core";

const { form, valuationResults, valuation, valuationIsLoading, visibleSection } = storeToRefs(useOrderFormV2Store());
const { selectCourierPrice } = useOrderFormV2Store();
const showTransition = ref(true);
const showStickValuation = ref(true);
const isBottomOfPage = ref(false)
const checkBottomOfPage = () => {
  isBottomOfPage.value = window.innerHeight + (window.scrollY + 100) >= document.body.offsetHeight
};
const {y} = useWindowScroll()
watch(y, () => {
  checkBottomOfPage();
});

watch(visibleSection, () => {
  if (visibleSection.value.includes(',summary') || visibleSection.value.includes(',courier')) {
    showTransition.value = false;
  } else {
    showTransition.value = true;
  }
})
</script>

<template>
  <Transition>
    <div class="orderForm_card orderForm_card--fixedOffer orderForm_card--hideMobile"
         v-show="showStickValuation & showTransition & !isBottomOfPage"
         v-if="valuationResults?.data?.results && valuationResults.data.results.length > 0">
      <div class="row row--noWarp">
        <div class="row row--gap16 row--alignStart calc_couriersRow">
          <div class="form_couriersWrapper">
            <div v-for="(result, index) in valuation.valuationResultsToShow">

              <input type="radio" :id="'radio-'+index+'fixedOffer'" name="kurier" value="" class="calc_courierRadio"/>
              <label :for="'radio-'+index+'fixedOffer'" class="calc_pricingRadioLabel" @click="selectCourierPrice(result)"
                     :style="form?.courier?.Courier?.id === result.Courier.id ? 'border: 2px solid #4285F4;' : 'border: 2px solid #BDD4F2;'"
              >
                <div class="calc_courierImgWrapper">
                  <NuxtImg :src="result.Courier.logo" width="50" height="" class="calc_courierImg"/>
                </div>
                <span class="calc_courierName">{{ result.Courier.name }}</span>
                <span class="calc_courierPrice" :style="form?.courier?.Courier?.id === result.Courier.id ? 'background-color: #4285F4; color: #ffffff' : 'background-color: #BDD4F2; color: #262B44;'">{{ result.Price.netto }} zł</span>
              </label>
            </div>
            <a href="#kurier" class="orderForm_stickyBarTxt">Pokaż wszystkich kurierów</a>
            <FormSpinerLoaderWithText :with-text="false" :loading="valuationIsLoading"/>
          </div>
        </div>
        <div class="orderForm_stickyBarSwitchContainerSmall">
          <div class="orderForm_stickyBarSwitchContainer">
            <label for="visibilitySwitch" class="orderForm_stickyBarTxt">Ukryj belkę</label>
            <label class="switch">
              <input id="visibilitySwitch" type="checkbox" :checked="showStickValuation" @change.prevent="showStickValuation = $event.target.checked">
              <span class="slider round"></span>
            </label>
          </div>
        </div>
      </div>
    </div>
  </Transition>

  <Transition>
    <div class="orderForm_stickyBarSwitchContainerSmall"
         v-show="!showStickValuation & showTransition & !isBottomOfPage"
         v-if="valuationResults?.data?.results && valuationResults.data.results.length > 0">
      <div class="orderForm_stickyBarSwitchContainer">
        <label for="visibilitySwitch2" class="orderForm_stickyBarTxt">Pokaż belkę</label>
        <label class="switch">
          <input id="visibilitySwitch2" type="checkbox" :checked="showStickValuation" @change.prevent="showStickValuation = $event.target.checked">
          <span class="slider round"></span>
        </label>
      </div>
    </div>
  </Transition>
</template>

<style scoped>

</style>