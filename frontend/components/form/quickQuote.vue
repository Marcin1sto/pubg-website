<script setup lang="ts">
import {required} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import useQuickValuationStore from "~/stores/useQuickValuationStore";
import {ref} from "vue";
import { vMaska } from "maska/vue"

const {fetchResults, setResults, setParamsForRequest, selectDeliveryType} = useQuickValuationStore();
const {results, results2, resultLoading, params} = storeToRefs(useQuickValuationStore());
const state = reactive(params);
const rules = computed(() => {
  return {
    deliveryType: {required},
    height: {required},
    width: {required},
    length: {required},
    weight: {required},
    senderCountry: {required},
    senderZipCode: {required},
    recipientCountry: {required},
    recipientZipCode: {required},
    price_for_bl_user: {required},
    delivery_type: {required},
  };
});

const resultsToShow = ref([] || {});
watch(() => results2, (newResults) => {
  resultsToShow.value = Object.keys(results2.value).map((key) => results2.value[key])
}, {deep: true});


const v$ = useVuelidate(rules, state);
const showMoreResults = ref(false);
const canFetchResults = ref(false);

watch(v$, () => {
  canFetchResults.value = v$.value.$silentErrors.length === 0
})

watch(canFetchResults, (newVal) => {
  if (newVal) {
    setParamsForRequest(state);
    fetchResults();
  }
})

const firstParams = {
  deliveryType: 'package',
  height: 10,
  width: 10,
  length: 10,
  weight: 1,
  senderCountry: 'PL',
  senderZipCode: '00-714',
  recipientCountry: 'PL',
  recipientZipCode: '00-714',
  price_for_bl_user: true,
  no_pickup: true
}

watch(state, (newVal) => {
  setParamsForRequest(newVal);

  if (canFetchResults.value) {
    fetchResults();
  }
}, {deep: true});

const showInfoModal = ref(false);
const showInfoModalType = ref('');

const contentTypes = {
  pricing: {
    title: 'Wycena przesyłki',
    content: 'Podano ceny netto (bez VAT) z wliczoną opłatą paliwową/drogową'
  },
  sizes: {
    title: 'Wymiary',
    content: 'Podaj rzeczywiste wymiary przesyłek w cm.'
  },
}

onMounted(() => {
  setParamsForRequest(firstParams)
  fetchResults();
});
</script>

<template>
  <form class="row calc" id="kalkulatorWyceny">
    <div class="row">
      <h2 class="calc_title">Nadaj swoją paczkę</h2>
    </div>
    <div class="form_quickQuoteWrapper">
      <div class="row">
        <div class="calc2_typesContaier">
          <div class="row">
            <h3 class="calc_subtitle">Rodzaj przesyłki</h3>
          </div>

<!--          <div class="wide-item"-->
<!--               style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; padding-right: 20px; height: max-content; flex-wrap: wrap">-->
          <div class="calc2_types">
            <div style="height: max-content">
              <input type="radio" id="radio1" name="typPaczki" @click.prevent="selectDeliveryType('package')"
                     class="calc_radioInput"/>
              <label for="radio1" class="calc_radioLabel"
                     :style="state.deliveryType === 'package' ? 'border: 2px solid #4285F4;' : ''">
                <NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>
                <span>Paczka</span>
              </label>
            </div>

            <div style="height: max-content">
              <input type="radio" id="radio2" name="typPaczki" @click.prevent="selectDeliveryType('envelope')"
                     class="calc_radioInput"/>
              <label for="radio2" class="calc_radioLabel"
                     :style="state.deliveryType === 'envelope' ? 'border: 2px solid #4285F4;' : ''">
                <NuxtImg src="icons/kopertaKalkulator.png" width="31px" height="19px"/>
                <span>Koperta</span>
              </label>
            </div>

            <div style="height: max-content">
              <input type="radio" id="radio3" name="typPaczki" @click.prevent="selectDeliveryType('pallet')"
                     class="calc_radioInput"/>
              <label for="radio3" class="calc_radioLabel"
                     :style="state.deliveryType === 'pallet' ? 'border: 2px solid #4285F4;' : ''">
                <NuxtImg src="icons/paletaKalkulator.png" width="42px" height="23px"/>
                <span>Paleta</span>
              </label>
            </div>

            <div style="height: max-content">
              <input type="radio" id="radio4" name="typPaczki" @click.prevent="selectDeliveryType('not_standard')"
                     class="calc_radioInput"/>
              <label for="radio4" class="calc_radioLabel" :style="state.deliveryType === 'not_standard' ? 'border: 2px solid #4285F4;' : ''">
                <NuxtImg src="icons/niestandardKalkulator.png" width="26px" height="26px"/>
                <span>Niestandardowa</span>
              </label>
            </div>
          </div>
          <span v-if="v$.deliveryType.$error" class="calc_errorMsg calc_errorMsg--show">Wybierz typ przesyłki.</span>
        </div>

        <div class="calc_largeColumn">
          <div class="row">
            <h3 class="calc_subtitle">Wymiary
              <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px" @click.prevent="showInfoModalType = 'sizes'; showInfoModal = true"/>
            </h3>
          </div>

          <div class="row row--alignStart row--gap16">
            <div class="calc_inputContainer calc_inputContainer--quickQuote">
              <label for="" class="calc_label">Długość</label>
              <div class="calc_inputWithUnit" :class="v$.length.$error ? 'calc_inputWithUnit--error' : ''">
                <input type="text" id="" name="length" class="calc_inputTxt"
                       :class="v$.length.$error ? 'calc_inputTxt--error' : ''" @change="v$.length.$model = $event.target.value"/>
                <span class="calc_unitInfo" :class="v$.length.$error ? 'calc_unitInfo--error' : ''">cm</span>
              </div>

              <span v-if="v$.length.$error" class="calc_errorMsg calc_errorMsg--show">Podaj długość!</span>
            </div>

            <div class="calc_inputContainer calc_inputContainer--quickQuote">
              <label for="" class="calc_label">Szerokość</label>
              <div class="calc_inputWithUnit" :class="v$.width.$error ? 'calc_inputWithUnit--error' : ''">
                <input type="text" id="" name="width" class="calc_inputTxt"
                       :class="v$.width.$error ? 'calc_inputTxt--error' : ''" @change="v$.width.$model = $event.target.value"/>
                <span class="calc_unitInfo" :class="v$.width.$error ? 'calc_unitInfo--error' : ''">cm</span>
              </div>

              <span v-if="v$.width.$error" class="calc_errorMsg calc_errorMsg--show">Podaj szerokość!</span>
            </div>

            <div class="calc_inputContainer calc_inputContainer--quickQuote">
              <label for="" class="calc_label">Wysokość</label>
              <div class="calc_inputWithUnit" :class="v$.height.$error ? 'calc_inputWithUnit--error' : ''">
                <input type="text" id="" name="height" class="calc_inputTxt"
                       :class="v$.height.$error ? 'calc_inputTxt--error' : ''" @change="v$.height.$model = $event.target.value"/>
                <span class="calc_unitInfo" :class="v$.height.$error ? 'calc_unitInfo--error' : ''">cm</span>
              </div>

              <span v-if="v$.height.$error" class="calc_errorMsg calc_errorMsg--show">Podaj wysokość!</span>
            </div>

            <div class="calc_inputContainer calc_inputContainer--quickQuote">
              <label for="" class="calc_label">Waga</label>
              <div class="calc_inputWithUnit" :class="v$.weight.$error ? 'calc_inputWithUnit--error' : ''">
                <input type="text" id="" name="weight" class="calc_inputTxt"
                       :class="v$.weight.$error ? 'calc_inputTxt--error' : ''" @change="v$.weight.$model = $event.target.value"/>
                <span class="calc_unitInfo" :class="v$.weight.$error ? 'calc_unitInfo--error' : ''">kg</span>
              </div>

              <span v-if="v$.weight.$error" class="calc_errorMsg calc_errorMsg--show">Podaj wagę!</span>
            </div>
          </div>

          <div class="row row--gap16 row--address">
            <div class="calc_sender">
              <div class="row">
                <h3 class="calc_subtitle">Adres nadania</h3>
              </div>

              <div class="row row--alignStart row--gap16">
                <InputCountrySelector v-model="v$.senderCountry.$model" :disabled="true"
                                      @country-change="(event) => v$.senderCountry.$model = event"/>

                <div class="calc_inputContainer">
                  <label for="" class="calc_label">Kod pocztowy</label>
                  <div class="calc_inputWithUnit" :class="v$.senderZipCode.$error ? 'calc_inputWithUnit--error' : ''">
                    <input type="text" id="senderZipCode" name="senderZipCode" class="calc_inputTxt calc_inputTxt--withoutUnit"
                           v-maska="'##-###'"
                           v-model="v$.senderZipCode.$model"
                           :class="v$.senderZipCode.$error ? 'calc_inputTxt--error' : ''"/>
                  </div>
                  <span v-if="v$.senderZipCode.$error"
                        class="calc_errorMsg calc_errorMsg--show">Podaj kod pocztowy!</span>
                </div>
              </div>
            </div>

            <div>
              <div class="row">
                <h3 class="calc_subtitle">Adres doręczenia</h3>
              </div>

              <div class="row row--alignStart row--gap16">
                <InputCountrySelector v-model="v$.recipientCountry.$model"
                  by-short-name="PL"
                  @country-change="(event) => v$.recipientCountry.$model = event"/>

                <div class="calc_inputContainer">
                  <label for="" class="calc_label">Kod pocztowy</label>
                  <div class="calc_inputWithUnit" :class="v$.recipientZipCode.$error ? 'calc_inputWithUnit--error' : ''">
                    <input type="text" id="" name="recipientZipCode" class="calc_inputTxt calc_inputTxt--withoutUnit"
                           v-model="v$.recipientZipCode.$model"
                           :class="v$.recipientZipCode.$error ? 'calc_inputTxt--error' : ''"/>
                  </div>

                  <span v-if="v$.recipientZipCode.$error"
                        class="calc_errorMsg calc_errorMsg--show">Podaj kod pocztowy!</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="calc_col3" style="width: max-content">
          <div class="wide-item">
            <div class="row">
              <h3 class="calc_subtitle">Rodzaj dostawy</h3>
            </div>
            <div style="display: flex; gap: 16px; flex-direction: column">
              <div class="row row--gap16" style="min-width: 300px">
                <input type="radio" id="radio6" name="typDostawy" class="calc_radioInput" @click.prevent="state.delivery_type = 'to_point'"/>
                <label for="radio6" class="calc_radioLabel calc_radioLabel--deliveryType" :style="state.delivery_type  === 'to_point' ? 'border: 2px solid #4285F4;' : ''">
                  <NuxtImg src="images/paczkomat.png" width="70px" height="50px"/>
                  <span style="text-align: center">Dostawa <br/><b>do punktu</b></span>
                </label>

                <input type="radio" id="radio5" name="typDostawy" class="calc_radioInput" @click.prevent="state.delivery_type = 'to_door'"/>
                <label for="radio5" class="calc_radioLabel calc_radioLabel--deliveryType" :style="state.delivery_type  === 'to_door' ? 'border: 2px solid #4285F4;' : ''">
                  <NuxtImg src="images/dostawczak.png" width="70px" height="50px"/>
                  <span style="text-align: center">Dostawa <br/><b>do drzwi</b></span>
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="calc_largeColumn">
          <div class="quickQuote_resultContainer">
            <div style="width: 100%">
              <div class="row">
                <h3 class="calc_subtitle">Wycena przesyłki <span class="calc_subtitleSmall">(kwota bez VAT)</span>
<!--                  <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px" @click.prevent="showInfoModalType = 'pricing'; showInfoModal = true"/>-->
                </h3>
              </div>
              <div class="row row--gap16 calc_couriersRow">
                <div v-if="resultsToShow.length > 0" v-for="(result, index) in !showMoreResults ? resultsToShow.slice(0, 5) : resultsToShow" :key="index" style="position: relative">
                  <input type="radio" :id="'radio-' + index" name="kurier" value="" class="calc_courierRadio"/>
                  <label :for="'radio-' + index" class="calc_pricingRadioLabel">
                    <div class="calc_courierImgWrapper">
                      <NuxtImg :src="result.logo" width="50" height="" class="calc_courierImg"/>
                    </div>
                    <span class="calc_courierName">{{ result.name }}</span>
                    <span class="calc_courierPrice">{{ result.price.toFixed(2) }} zł</span>
                  </label>
                  <FormSpinerLoaderWithText :with-text="false" :loading="resultLoading" />
                </div>
                <div class="calc_noResults" v-else>
                  <span>Skontaktuj się z nami. </span> <a href="mailto:oferta@blpaczka.com" class="navigation_buttonSecondary">oferta@blpaczka.com</a>
                </div>
              </div>

              <div class="row" v-show="resultsToShow.length > 5">
                <span class="calc_showMore" @click="showMoreResults = !showMoreResults">Pokaż {{ !resultsToShow  ? 'mniej' : 'więcej' }} przewoźników
                  <NuxtImg src="icons/greyArrowDown.png" width="" height="" class="calc_courierImg"
                    :style=" !resultsToShow ? 'rotate: 180deg' : ''"/>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="row" style="margin-top: 50px; justify-content: space-between; align-items: center; gap: 16px">
          <div class="calc_infoTxt">
            Podano ceny netto (bez VAT) z wliczoną opłatą paliwową/drogową <br>
            Podane ceny obowiązują klientów korzystających z platformy <NuxtLink to="https://baselinker.com">BaseLinker</NuxtLink>.<br>
            Ceny dla klientów nadających przesyłki bezpośrednio w serwisie blpaczka.com są o 1 zł wyższe w przypadku paczek i o 10 zł wyższe dla palet.
          </div>
          <div style="display: flex; justify-content: flex-end">
            <div class="row row--column calc_addParcelRow">
              <nuxt-link-locale to="login" class="calc_button">Nadaj paczkę</nuxt-link-locale>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <Teleport to="body">
    <Modal :show="showInfoModal" @close="showInfoModal = false">
      <template #header>
        <h1 class="modal_title">{{ contentTypes[showInfoModalType].title }}</h1>
      </template>
      <template #body>
        <p class="modal_txt" v-html="contentTypes[showInfoModalType].content"></p>
      </template>
    </Modal>
  </Teleport>
</template>

<style scoped>
.form_grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  //gap: 0;
  column-gap: 0;
  row-gap: 0;

  @media screen and (max-width: 1024px) {
    grid-template-columns: 1fr;
  }
}

.wide-item {
  grid-column: span 2; /* element zajmuje dwie kolumny */
  width: max-content; /* szerokość max-content */
  white-space: nowrap; /* zapobiega zawijaniu tekstu */

  @media screen and (max-width: 1060px) {
    margin-bottom: 36px;
  }
}

.quickQuote_resultContainer {
  display: flex;
  width: 100%;
  align-items: center;
}

.background-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6); /* półprzezroczyste tło */
  z-index: 5; /* poniżej spinnera, ale nad innymi elementami */
  backdrop-filter: blur(1px);
}
</style>