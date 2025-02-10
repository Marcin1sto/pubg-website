<template>
  <div class="container">
    <div class="prices_mainNavigation">
      <nuxt-link to="krajowe" class="calc_radioLabel calc_radioLabel--horizontalSmall"><NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>Krajowe</nuxt-link>
      <nuxt-link to="miedzynarodowe" class="calc_radioLabel calc_radioLabel--horizontalSmall"><NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>Międzynarodowe</nuxt-link>
      <nuxt-link to="paletowe" class="calc_radioLabel calc_radioLabel--horizontalSmall calc_radioLabel--active"><NuxtImg src="icons/paletaKalkulator.png" width="42px" height="23px"/>Paletowe</nuxt-link>
      <nuxt-link to="niestandardowe" class="calc_radioLabel calc_radioLabel--horizontalSmall"><NuxtImg src="icons/niestandardKalkulator.png" width="26px" height="26px"/>Niestandardowe</nuxt-link>
    </div>

    <div class="prices_banerContainer prices_banerContainer--marginBig">
      <div class="prices_columnTxt">
        <div class="row">
          <h1 class="prices_title">Cennik paletowy</h1>
        </div>
        <div class="row">
          <ul class="prices_list">
            <li class="prices_listItem">Wszystkie popularne <strong>rozmiary</strong> palet</li>
            <li class="prices_listItem"><strong>Duży wybór</strong> sprawdzonych przewoźników</li>
            <li class="prices_listItem"><strong>Dostawa</strong> zarówno w kraju jak i za granicą</li>
          </ul>
        </div>

        <div class="row">
          <a :href="mainPageUrl + '#kalkulatorWyceny'" class="heroTxtContainer_button">Nadaj paczkę</a>
        </div>

      </div>
      <div class="prices_columnImg">
        <nuxt-link-locale to="register" class="heroTxtContainer_promoContainer heroTxtContainer_promoContainer--priceList">
          <div class="row">
            <div class="heroTxtContainer_promoContainerHeader">
              <span class="heroTxtContainer_promoContainerTitle">Najlepsza oferta!</span>
            </div>
          </div>

          <div class="row">
            <div class="heroTxtContainer_promoContainerContent">
              <div class="row">
                <span class="heroTxtContainer_promoContainerTxt">Palety</span>
              </div>
              <div class="row row--centered" style="height: 60px; margin-bottom: 6px">
                <NuxtImg src="images/kurierzyV2/Geis.png" width="80px" height="60px"/>
              </div>
              <div class="row">
                <span class="heroTxtContainer_promoContainerPrice">od 80 zł!</span>
              </div>
              <div class="row row--centered">
                <span class="heroTxtContainer_promoContainerLink">Skorzystaj</span>
                <NuxtImg src="icons/arrowPromoLink.png" width="11px" height="17px" style="margin-left: 6px"/>
              </div>
            </div>
          </div>
        </nuxt-link-locale>
        <NuxtImg src="images/kurierzyCennikiUproszczone/palety.svg" width="510px" height="400px"/>
      </div>
    </div>

    <div class="row">
      <div style="display: flex; gap: 16px; flex-direction: column; margin: 16px 0">
        <div class="row row--submenu">
          <span @click="pallet120x80 = true; pallet120x100 = false; pallet120x120 = false; pallet80x60 = false; pallet60x40=false;" class="calc_radioLabel calc_radioLabel--horizontal  calc_radioLabel--200" :class="{ 'calc_radioLabel--active': pallet120x80}">
            <span style="text-align: center">EURO Paleta <br/><b>120cm x 80cm</b></span>
          </span>

          <span @click="pallet120x80 = false; pallet120x100 = true; pallet120x120 = false; pallet80x60 = false; pallet60x40=false;" class="calc_radioLabel calc_radioLabel--horizontal  calc_radioLabel--200" :class="{ 'calc_radioLabel--active': pallet120x100}">
            <span style="text-align: center">Paleta przemysłowa <br/><b>120cm x 100cm</b></span>
          </span>

          <span @click="pallet120x80 = false; pallet120x100 = false; pallet120x120 = true; pallet80x60 = false; pallet60x40=false;" class="calc_radioLabel calc_radioLabel--horizontal  calc_radioLabel--200" :class="{ 'calc_radioLabel--active': pallet120x120}">
            <span style="text-align: center">Paleta przemysłowa <br/><b>120cm x 120cm</b></span>
          </span>

          <span @click="pallet120x80 = false; pallet120x100 = false; pallet120x120 = false; pallet80x60 = true; pallet60x40=false;" class="calc_radioLabel calc_radioLabel--horizontal  calc_radioLabel--200" :class="{ 'calc_radioLabel--active': pallet80x60}">
            <span style="text-align: center">Półpaleta <br/><b>80cm x 60cm</b></span>
          </span>

          <span @click="pallet120x80 = false; pallet120x100 = false; pallet120x120 = false; pallet80x60 = false; pallet60x40=true;" class="calc_radioLabel calc_radioLabel--horizontal  calc_radioLabel--200" :class="{ 'calc_radioLabel--active': pallet60x40}">
            <span style="text-align: center">Ćwierćpaleta <br/><b>60cm x 40cm</b></span>
          </span>
        </div>
      </div>
    </div>

    <div class="row">
      <PriceListB2BLp120x80 v-show="pallet120x80 && !isC2C"/>
      <PriceListC2CLp120x80 v-show="pallet120x80 && isC2C"/>

      <PriceListB2BLp120x100 v-show="pallet120x100 && !isC2C"/>
      <PriceListC2CLp120x100 v-show="pallet120x100 && isC2C"/>

      <PriceListB2BLp120x120 v-show="pallet120x120 && !isC2C"/>
      <PriceListC2CLp120x120 v-show="pallet120x120 && isC2C"/>

      <PriceListB2BLp80x60 v-show="pallet80x60 && !isC2C"/>
      <PriceListC2CLp80x60 v-show="pallet80x60 && isC2C"/>

      <PriceListB2BLp60x40 v-show="pallet60x40 && !isC2C"/>
      <PriceListC2CLp60x40 v-show="pallet60x40 && isC2C"/>
    </div>

    <PriceListB2BSpecialInfo2 v-if="!isC2C"/>
    <PriceListC2CSpecialInfo2 v-if="isC2C"/>

    <Cta />
  </div>
</template>
<script setup lang="ts">
import useC2CStore from "~/stores/useC2CStore";

const mainPageUrl = window.location.origin + '/';

const pallet120x80 = ref(true);
const pallet120x100 = ref(false);
const pallet120x120 = ref(false);
const pallet80x60 = ref(false);
const pallet60x40 = ref(false);

const { isC2C } = storeToRefs(useC2CStore());

definePageMeta({
  middleware: 'default-layout',
})
</script>