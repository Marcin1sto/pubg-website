<template>
  <div class="container">
    <div class="prices_mainNavigation">
      <nuxt-link to="krajowe" class="calc_radioLabel calc_radioLabel--horizontalSmall calc_radioLabel--active"><NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>Krajowe</nuxt-link>
      <nuxt-link to="miedzynarodowe" class="calc_radioLabel calc_radioLabel--horizontalSmall" v-if="!isC2C"><NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>Międzynarodowe</nuxt-link>
      <nuxt-link to="paletowe" class="calc_radioLabel calc_radioLabel--horizontalSmall" v-if="!isC2C"><NuxtImg src="icons/paletaKalkulator.png" width="42px" height="23px"/>Paletowe</nuxt-link>
      <nuxt-link to="niestandardowe" class="calc_radioLabel calc_radioLabel--horizontalSmall"><NuxtImg src="icons/niestandardKalkulator.png" width="26px" height="26px"/>Niestandardowe</nuxt-link>
    </div>

    <div class="prices_banerContainer prices_banerContainer--marginBig">
      <div class="prices_columnTxt">
        <div class="row">
          <h1 class="prices_title">Cennik krajowy</h1>
        </div>
        <div class="row">
          <ul class="prices_list">
            <li class="prices_listItem">Wszystkie popularne formy przesyłek: od <strong>koperty</strong> do palety <strong>1000</strong> kg</li>
            <li class="prices_listItem">Oferta <strong>wszystkich</strong> polskich kurierów/przewoźników</li>
            <li class="prices_listItem"><strong>Dostawa</strong> do drzwi i do punktów odbioru</li>
          </ul>
        </div>

        <div class="row">
          <a :href="mainPageUrl + '#kalkulatorWyceny'" class="heroTxtContainer_button">Nadaj paczkę</a>
        </div>

      </div>
      <div class="prices_columnImg">
        <!--        <NuxtImg src="images/kurierzyCennikiUproszczone/krajowe.svg" width="445px" height="356px"/>-->
        <nuxt-link-locale to="register" class="heroTxtContainer_promoContainer heroTxtContainer_promoContainer--priceList">
          <div class="row">
            <div class="heroTxtContainer_promoContainerHeader">
              <span class="heroTxtContainer_promoContainerTitle">Najlepsza oferta!</span>
            </div>
          </div>

          <div class="row">
            <div class="heroTxtContainer_promoContainerContent">
              <div class="row">
                <span class="heroTxtContainer_promoContainerTxt">Paczkomat<sup>&reg;</sup></span>
              </div>
              <div class="row row--centered" style="height: 60px; margin-bottom: 6px">
                <NuxtImg src="images/kurierzyV2/Inpost.png" width="80px" height="60px"/>
              </div>
              <div class="row">
                <span class="heroTxtContainer_promoContainerPrice">od 9,99 zł!</span>
              </div>
              <div class="row row--centered">
                <span class="heroTxtContainer_promoContainerLink">Skorzystaj</span>
                <NuxtImg src="icons/arrowPromoLink.png" width="11px" height="17px" style="margin-left: 6px"/>
              </div>
            </div>
          </div>
        </nuxt-link-locale>
        <NuxtImg src="images/kurierzyCennikiUproszczone/niestandardowe.png" width="420px" height="400px"/>
      </div>
    </div>

    <div class="row">
      <div style="display: flex; gap: 16px; flex-direction: column; margin-bottom: 32px">
        <div class="row row--gap16" style="min-width: 300px">
          <span @click="show2door = true" class="calc_radioLabel calc_radioLabel--horizontal" :class="{ 'calc_radioLabel--active': show2door}">
            <NuxtImg src="images/paczkomat.png" width="70px" height="50px"/>
            <span style="text-align: center">Dostawa <br/><b>do punktu</b></span>
          </span>

          <span @click="show2door = false" class="calc_radioLabel calc_radioLabel--horizontal" :class="{ 'calc_radioLabel--active': !show2door}">
            <NuxtImg src="images/dostawczak.png" width="70px" height="50px"/>
            <span style="text-align: center">Dostawa <br/><b>do drzwi</b></span>
          </span>
        </div>
      </div>
    </div>

    <PriceListB2BLocalToDoor v-show="show2door && !isC2C"/>
    <PriceListC2CLocalToDoor v-show="show2door && isC2C"/>

    <PriceListB2BLocalToPoint  v-show="!show2door && !isC2C"/>
    <PriceListC2CLocalToPoint  v-show="!show2door && isC2C"/>

    <PriceListB2BSpecialInfo1 v-if="!isC2C"/>
    <PriceListC2CSpecialInfo1 v-if="isC2C"/>

    <Cta />
  </div>
</template>
<script setup lang="ts">
import useC2CStore from "~/stores/useC2CStore";

const mainPageUrl = window.location.origin + '/';

const show2door = ref(true);

const { isC2C } = storeToRefs(useC2CStore());

definePageMeta({
  middleware: 'default-layout',
})
</script>